# This is buildpack-run.sh
# Remove package-lock as this is already done 
npm install --global cross-env

yarn prod

rm -rf package-lock.json

composer install

php artisan key:generate

php artisan migrate --seed
