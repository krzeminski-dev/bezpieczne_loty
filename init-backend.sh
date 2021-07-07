#!/bin/bash

docker exec projekt-php composer install
docker exec projekt-php ./bin/console doctrine:migrations:migrate -n
docker exec projekt-php ./bin/console app:load:countries
docker exec projekt-php ./bin/console app:load:routes 2000