docker-up:
	docker-compose up -d
docker-down:
	docker-compose down --remove-orphans
docker-restart:
	docker-down
	docker-up