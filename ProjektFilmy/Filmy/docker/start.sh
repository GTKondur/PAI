#!/bin/sh
set -e

cd /var/www/html

mkdir -p /tmp/database
touch /tmp/database/database.sqlite
chmod 777 /tmp/database/database.sqlite
chmod 777 /tmp/database


cp .env.example .env

sed -i 's/APP_ENV=local/APP_ENV=production/' .env
sed -i 's/APP_DEBUG=true/APP_DEBUG=false/' .env
sed -i 's|APP_URL=http://localhost|APP_URL=https://filmy-app.salmonfield-6bcf4751.polandcentral.azurecontainerapps.io|' .env
sed -i 's|DB_CONNECTION=sqlite|DB_CONNECTION=sqlite|' .env

echo "DB_DATABASE=/tmp/database/database.sqlite" >> .env

php artisan key:generate --force

php artisan migrate --force

php artisan config:cache
php artisan route:cache
php artisan view:cache

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf 
