docker-up:
	docker-compose up -d
docker-down:
	docker-compose down -v --remove-orphans
docker-restart:
	docker-down
	docker-up
dev-init:
	docker-down
	docker-compose pull
	docker-compose build --pull
	docker-compose -f docker-compose.yml -f docker-compose.dev.yml up -d
init:
	docker-down
	docker-compose pull
	docker-compose build --pull
	docker-up
stop:
	docker-down