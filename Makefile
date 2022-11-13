start:
	docker compose up -d

bash:
	docker compose run backendapp /bin/bash

consume:
	docker compose exec -d backendapp /var/www/html/bin/console messenger:consume async

stop:
	docker compose stop
