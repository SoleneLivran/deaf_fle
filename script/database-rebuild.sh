#!/bin/bash
bin/console doctrine:database:drop --force --env=test
bin/console doctrine:database:create --no-interaction --env=test
bin/console doctrine:migrations:migrate --no-interaction --env=test
bin/console doctrine:fixtures:load --no-interaction --env=test