docker-compose down -v --remove-orphans
docker-compose pull
docker-compose build --pull
docker-compose up -d