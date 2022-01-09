up:
	docker-compose up -d
composer:
	composer install
env:
	cp .env.example .env
down:
	docker-compose down
migrations:
	docker exec -it cadastro_produtos php artisan migrate:fresh --seed
bash:
	docker exec -it cadastro_produtos /bin/bash
encryption_key:
	docker exec -it cadastro_produtos php artisan key:generate
run: up composer env migrations