# Plano de publicação

## Repositórios

Recomendação: monorepo `sagio-modernizado` com diretórios `ui/` e `api/`, mantendo CI separado para cada pasta. Alternativamente, dividir em dois repositórios se houver equipes e ciclos de release distintos.

## UI — Vercel

- Root directory: `ui`
- Build: `npm run build`
- Install: `npm install`
- Environment: `NEXT_PUBLIC_API_URL=https://SEU-DOMINIO-API/api`

## API — Render / container

- Build via `api/Dockerfile`
- Health endpoint: `/actuator/health`
- Configurar `SPRING_DATASOURCE_URL`, `SPRING_DATASOURCE_USERNAME`, `SPRING_DATASOURCE_PASSWORD`, `CORS_ALLOWED_ORIGINS`
- Banco PostgreSQL gerenciado com backups e TLS

## Antes de liberar

- Executar testes UI e API no pipeline
- Conferir domínio e CORS de produção
- Validar formulários e gravação real de leads em staging
- Confirmar política de privacidade, base legal, retenção e canal de direitos LGPD
- Revisar todos os textos comerciais e informações de embarcações
- Ativar monitoramento, limites de requisição, alertas e backups
