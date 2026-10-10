# Planejamento de sprints — Sagio modernizado

Backlog proposto para cadastrar no Trello. Cada item pode ser um cartão, com checklist de aceite. As sprints são uma proposta inicial, pois nenhum quadro Trello foi anexado.

## Sprint 0 — Base e arquitetura

### API
1. **API-01 — Definir arquitetura e contrato REST**
   - Aceite: endpoints, DTOs, status HTTP, convenções de erro e CORS documentados.
2. **API-02 — Preparar projeto Spring Boot e Java 21**
   - Aceite: aplicação inicia localmente e endpoint de saúde responde.
3. **API-03 — Provisionar PostgreSQL local e variáveis de ambiente**
   - Aceite: aplicação conecta sem credenciais hardcoded.
4. **UI-01 — Inicializar Next.js, React, TypeScript e Tailwind**
   - Aceite: `npm run dev`, typecheck e build funcionam.
5. **UI-02 — Organizar tokens visuais e componentes compartilhados**
   - Aceite: header, footer, botões, cards e estilos responsivos reutilizáveis.

## Sprint 1 — Estrutura principal

### API
6. **API-04 — Criar migração Flyway para leads**
   - Aceite: schema versionado, constraints para campos obrigatórios e índice temporal.
7. **API-05 — Implementar DTOs e validação de entrada**
   - Aceite: e-mail, telefone, quantidade, data e consentimento validados.
8. **API-06 — Implementar POST /api/leads**
   - Aceite: cria registro e responde HTTP 201 sem retornar dados sensíveis além do necessário.
9. **UI-03 — Migrar página inicial**
   - Aceite: hero, experiências, CTA e contato adaptados para desktop e celular.
10. **UI-04 — Migrar navegação e rodapé**
    - Aceite: links válidos, menu móvel acessível e contatos preservados.

## Sprint 2 — Funcionalidades e integração

### API
11. **API-07 — Publicar catálogo GET /api/passeios**
    - Aceite: resposta JSON consistente e sem dados pessoais.
12. **API-08 — Configurar CORS por ambiente e tratamento global de erros**
    - Aceite: origens configuráveis e erros sem stack trace exposto.
13. **API-09 — Documentar API com OpenAPI/Swagger**
    - Aceite: endpoints, modelos e respostas documentados.
14. **UI-05 — Migrar catálogo de passeios**
    - Aceite: cards, imagens, categorias e CTA funcionam em layouts responsivos.
15. **UI-06 — Migrar página de embarcações premium**
    - Aceite: frota e formulário de orçamento apresentados com conteúdo revisável.
16. **UI-07 — Integrar formulário com API**
    - Aceite: validação client-side, loading, sucesso e falha com mensagens acessíveis.
17. **UI-08 — Implementar consentimento LGPD no formulário**
    - Aceite: não envia sem consentimento explícito; política vinculada.

## Sprint 3 — Qualidade e publicação

### API
18. **API-10 — Criar testes de validação e persistência**
    - Aceite: testes cobrem e-mail inválido, consentimento ausente e caminho válido.
19. **API-11 — Containerizar e preparar deploy**
    - Aceite: imagem Docker construída e variáveis documentadas.
20. **API-12 — Revisão de segurança e observabilidade**
    - Aceite: nenhum segredo no Git, health check e logs configurados; plano de rate limiting definido.

### UI
21. **UI-09 — Migrar página de política e conteúdo institucional**
    - Aceite: política navegável e conteúdo aprovado pela empresa antes da produção.
22. **UI-10 — Melhorar acessibilidade e SEO técnico**
    - Aceite: títulos semânticos, labels, foco visível, metadados e links externos seguros.
23. **UI-11 — Criar testes de formulário e build de produção**
    - Aceite: validações principais testadas; typecheck e build passam.
24. **UI-12 — Preparar deploy e variáveis por ambiente**
    - Aceite: instruções Vercel documentadas, URL de API configurável e checklist de smoke test.

## Definition of Done

- Código revisado e versionado; sem segredos ou dados reais.
- Testes aplicáveis executados e resultados anexados ao cartão.
- Responsividade, acessibilidade básica e tratamento de erro verificados.
- Documentação atualizada; critérios de aceite cumpridos.
- Publicação só após validação da empresa em staging.
