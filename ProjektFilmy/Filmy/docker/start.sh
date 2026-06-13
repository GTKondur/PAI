#!/bin/sh
set -e

cd /var/www/html


chmod 777 /var/www/html/database 2>/dev/null  true
chmod 777 /var/www/html/database/database.sqlite 2>/dev/null 
 true


if [ ! -f .env ]; then
    cp .env.example .env
fi


sed -i 's/APP_ENV=local/APP_ENV=production/' .env
sed -i 's/APP_DEBUG=true/APP_DEBUG=false/' .env
sed -i 's|APP_URL=http://localhost|APP_URL=https://filmy-app.salmonfield-6bcf4751.polandcentral.azurecontainerapps.io|' .env


php artisan key:generate --force


php artisan migrate --force


php artisan config:cache
php artisan route:cache
php artisan view:cache


exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
