docker-up:
	docker-compose up -d
docker-down:
	docker-compose down -v --remove-orphans
docker-restart:
	docker-down
	docker-up
init:
	docker-down
	docker-compose pull
	docker-compose build --pull
	docker-up
stop:
	docker-down