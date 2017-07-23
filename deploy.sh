#!/bin/bash

docker-compose run app chmod 775 -R storage
docker-compose run app chown :www-data -R storage

docker-compose run app composer install
