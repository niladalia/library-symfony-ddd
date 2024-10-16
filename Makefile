build-project:
	docker compose up --build -d
	docker exec -it librarify_php composer install
	make prepare-test-db
	#make build-consumers

start:
	docker compose up -d

stop:
	docker compose stop

down:
	docker compose down --rmi all

run-migrations:
	docker exec -it librarify_php php bin/console doctrine:migrations:migrate

prepare-test-db:
	docker exec -i librarify_php php bin/console --env=test d:d:d  --force --if-exists
	docker exec -i librarify_php php bin/console --env=test d:d:c --if-not-exists
	docker exec -i librarify_php php bin/console --env=test d:s:c

run-tests:
	docker exec -it librarify_php ./vendor/bin/phpunit
	docker exec -it librarify_php ./vendor/bin/behat

ping-mysql:
	@docker exec librarify_db mysqladmin --user=root --password=chopin --host "127.0.0.1" ping --silent

ping-rabbitmq:
	@docker exec rabbitmq rabbitmqctl ping --silent

build-consumers:
	docker exec -i librarify_php supervisord -c /etc/supervisor/supervisord.conf
	make start-consumers

start-consumers:
	docker exec -i librarify_php supervisorctl -c /etc/supervisor/supervisord.conf start messenger-consume-create:*
	docker exec -i librarify_php supervisorctl -c /etc/supervisor/supervisord.conf start messenger-consume-update:*
	docker exec -i librarify_php supervisorctl -c /etc/supervisor/supervisord.conf start messenger-consume-delete:*

stop-consumers:
	docker exec -i librarify_php  supervisorctl -c /etc/supervisor/supervisord.conf stop messenger-consume-create:*
	docker exec -i librarify_php  supervisorctl -c /etc/supervisor/supervisord.conf stop messenger-consume-update:*
	docker exec -i librarify_php  supervisorctl -c /etc/supervisor/supervisord.conf stop messenger-consume-delete:*
