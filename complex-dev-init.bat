docker-compose down -v --remove-orphans
docker-compose pull
docker-compose build --pull
docker compose -f docker-compose.yml -f docker-compose.dev.yml up -d