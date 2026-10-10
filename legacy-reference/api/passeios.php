<?php
// Configuração de cabeçalhos para aceitar JSON e requisições CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Se for requisição OPTIONS (Preflight do CORS), encerra aqui
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Configuração de conexão com o Banco de Dados (PostgreSQL na nuvem / Neon.tech)
$host = getenv('DB_HOST') ?: 'seu_host_aqui.neon.tech';
$port = getenv('DB_PORT') ?: '5432';
$dbname = getenv('DB_NAME') ?: 'sagio_db';
$user = getenv('DB_USER') ?: 'seu_usuario';
$password = getenv('DB_PASSWORD') ?: 'sua_senha';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Erro de conexão com o banco de dados: " . $e->getMessage()]);
    exit();
}

$method = $_SERVER['REQUEST_METHOD'];

// ==========================================
// MÉTODO GET: Listar passeios / leads cadastrados
// ==========================================
if ($method === 'GET') {
    try {
        $stmt = $pdo->query("SELECT id, nome, email, telefone, passeio, data_passeio, created_at FROM agendamentos ORDER BY id DESC");
        $passeios = $stmt->fetchAll();
        
        http_response_code(200);
        echo json_encode([
            "status" => "success",
            "data" => $passeios
        ]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => "Erro ao buscar dados: " . $e->getMessage()]);
    }
    exit();
}

// ==========================================
// MÉTODO POST: Cadastrar novo lead / agendamento
// ==========================================
if ($method === 'POST') {
    // Lê o conteúdo JSON enviado no corpo da requisição
    $inputData = json_decode(file_get_contents("php://input"), true);

    // Validação básica dos campos obrigatórios
    if (empty($inputData['nome']) || empty($inputData['email']) || empty($inputData['passeio'])) {
        http_response_code(400);
        echo json_encode(["error" => "Os campos nome, email e passeio são obrigatórios."]);
        exit();
    }

    $nome = trim($inputData['nome']);
    $email = filter_var($inputData['email'], FILTER_SANITIZE_EMAIL);
    $telefone = trim($inputData['telefone'] ?? '');
    $passeio = trim($inputData['passeio']);
    $data_passeio = trim($inputData['data_passeio'] ?? date('Y-m-d'));

    try {
        $sql = "INSERT INTO agendamentos (nome, email, telefone, passeio, data_passeio, created_at) 
                VALUES (:nome, :email, :telefone, :passeio, :data_passeio, NOW())";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':telefone' => $telefone,
            ':passeio' => $passeio,
            ':data_passeio' => $data_passeio
        ]);

        $lastId = $pdo->lastInsertId();

        http_response_code(201);
        echo json_encode([
            "status" => "success",
            "message" => "Agendamento realizado com sucesso!",
            "id" => $lastId
        ]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => "Erro ao salvar no banco de dados: " . $e->getMessage()]);
    }
    exit();
}

// Caso seja outro método HTTP não suportado
http_response_code(405);
echo json_encode(["error" => "Método não permitido."]);
?>