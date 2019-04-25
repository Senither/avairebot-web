# This is buildpack-run.sh
yarn prod
# Remove package-lock as this is already done 
rm -rf package-lock.json

composer install

php artisan key:generate

php artisan migrate --seed
