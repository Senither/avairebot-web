#!/bin/bash
mv .env.example .env # Temp fix until we have system env variables
rm -rf package-lock.json # package-lock.json interferes with yarn.lock on Heroku, removing as recommanded
composer install # Get PHP depedecies installed
php artisan key:generate # Temp fix until we have system env variables
php artisan migrate --seed # Migrate and seed db
