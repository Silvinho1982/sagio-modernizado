# Sagio Turismo — modernização full-stack

Modernização inicial do site HTML/CSS/JS enviado, com UI Next.js/React/TypeScript/Tailwind e API REST em Java 21 + Spring Boot + PostgreSQL. As imagens existentes foram reaproveitadas.

## Estrutura

- `ui/`: Next.js App Router, TypeScript, Tailwind, formulários validados com Zod, páginas inicial/passeios/premium/política.
- `api/`: Spring Boot, REST, validação, JPA, PostgreSQL, Flyway, OpenAPI/Swagger e testes.
- `docs/`: backlog de tarefas por sprint para UI e API, critérios de aceite e plano de publicação.
- `docker-compose.yml`: PostgreSQL local para desenvolvimento.

## Requisitos

- Node.js 20.9+ e npm
- Java 21 e Maven 3.9+
- Docker (opcional, para PostgreSQL)

## Executar localmente

### 1. Banco

Na raiz: `docker compose up -d db`. O banco local será `sagio`, usuário `sagio`, senha `sagio_dev` (somente desenvolvimento).

### 2. API

```bash
cd api
# Linux/macOS
export SPRING_DATASOURCE_URL=jdbc:postgresql://localhost:5432/sagio
export SPRING_DATASOURCE_USERNAME=sagio
export SPRING_DATASOURCE_PASSWORD=sagio_dev
mvn spring-boot:run
```

No PowerShell, use `$env:SPRING_DATASOURCE_URL=...`, `$env:SPRING_DATASOURCE_USERNAME=...`, `$env:SPRING_DATASOURCE_PASSWORD=...`. Documentação: `http://localhost:8080/swagger-ui.html`; saúde: `http://localhost:8080/actuator/health`.

### 3. UI

```bash
cd ui
cp .env.example .env.local # no Windows, copie manualmente
npm install
npm run dev
```

Acesse `http://localhost:3000`. Configure `NEXT_PUBLIC_API_URL=http://localhost:8080/api` em `.env.local`.

### 4. Testes

```bash
cd ui && npm test && npm run typecheck && npm run build
cd ../api && mvn test
```

## Endpoints atuais

- `GET /actuator/health`: verificação de saúde.
- `GET /api/passeios`: catálogo público básico.
- `POST /api/leads`: registra uma solicitação após validar os dados e o consentimento LGPD.

Exemplo de `POST /api/leads`:

```json
{
  "nome": "Maria Silva",
  "email": "maria@example.com",
  "telefone": "86999999999",
  "passeio": "Passeio pelo Delta do Parnaíba",
  "dataPasseio": "2027-01-15",
  "quantidadePessoas": 2,
  "consentimentoLgpd": true
}
```

**Privacidade:** a API não expõe endpoint público para listar leads. Não coloque credenciais reais no repositório. O consentimento é obrigatório para este fluxo; antes de produção, valide a base legal e o texto de privacidade com a empresa.

## Observações importantes da migração

1. Este pacote é uma base funcional de modernização, não uma declaração de produção validada. Execute testes em ambiente local/staging antes de substituir o site ativo.
2. O conteúdo comercial foi condensado em algumas páginas; revise preços, capacidades, horários, condições de embarque, contatos e políticas antes da publicação.
3. A conexão com banco de produção deve usar variáveis de ambiente do provedor, TLS e uma senha exclusiva.
4. Configure domínio, HTTPS, logs, monitoramento, backups e proteção contra abuso/rate limiting antes de produção.
5. A criação de repositório remoto exige autenticação na sua conta. O pacote não contém token ou credenciais e não publica sozinho.

## GitHub/GitLab: versionar e conectar remoto

Crie um repositório vazio chamado `sagio-modernizado` no GitHub ou GitLab. Na pasta deste projeto: 

```bash
git init
git add .
git commit -m "feat: moderniza Sagio com Next.js e Spring Boot"
git branch -M main
git remote add origin https://github.com/SEU_USUARIO/sagio-modernizado.git
git push -u origin main
```

Substitua `SEU_USUARIO` pelo usuário correto e use a URL do repositório que você criou. Não reutilizei automaticamente o remoto encontrado no arquivo original, pois ele pode apontar para o projeto antigo.

## Sprints e tarefas

Veja `docs/SPRINTS.md` para 10 tarefas de API e 10 de UI, distribuídas em quatro sprints, com critérios de aceite.
