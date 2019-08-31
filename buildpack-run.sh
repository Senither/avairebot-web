# Doing this temporarly b/c of system env variables missing
mv .env.example .env
# Remove package-lock as this is already done, Heroku can't decide at the node stage that yarn.local should be used instead.
rm -rf package-lock.json
# Installing the depedecies after PHP has been installed
composer install
# Generate artisan key
php artisan key:generate
# Migrate seed
php artisan migrate --seed
