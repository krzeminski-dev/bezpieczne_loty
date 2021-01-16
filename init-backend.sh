#!/bin/bash

docker exec projekt-php composer install
docker exec projekt-php ./bin/console doctrine:migrations:migrate -n