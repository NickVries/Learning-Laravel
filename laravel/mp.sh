#!/usr/bin/env bash
set -eo pipefail

function fixPermissions {
  docker-compose exec laraduck chown -R www-data:www-data ./storage/ ./bootstrap/cache/
}

function ownAllTheThings {
  docker-compose exec laraduck chown -R $(id -u):$(id -g) .
}

if [ $# -gt 0 ]; then
  # Start services.
  if [ "$1" == "up" ]; then
    docker-compose up -d

  # Run a composer command on the app service.
  elif [ "$1" == "composer" ]; then
    shift 1
    docker-compose run laraduck composer $@
    ownAllTheThings
    fixPermissions

  # Run an artisan command on the app service.
  elif [ "$1" == "artisan" ]; then
    shift 1
    docker-compose run --rm laraduck php artisan $@
    ownAllTheThings
    fixPermissions

  # Run php artisan tinker as root.
  elif [ "$1" == "tinker" ] || [ "$1" == "psysh" ]; then
    docker-compose run --rm laraduck php artisan tinker
    ownAllTheThings
    fixPermissions

  elif [ "$1" == "mysql" ]; then
    docker-compose exec mysql mysql -uroot -proot

  else
    docker-compose $@
  fi

else
  docker-compose ps
fi
