bash#!/bin/sh
set -e

cd /var/www/html

# Utwórz plik .env jeśli nie istnieje
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Ustaw zmienne dla produkcji
sed -i 's/APP_ENV=local/APP_ENV=production/' .env
sed -i 's/APP_DEBUG=true/APP_DEBUG=false/' .env
sed -i 's|APP_URL=http://localhost|APP_URL=https://filmy-app.salmonfield-6bcf4751.polandcentral.azurecontainerapps.io|' .env

# Generuj klucz aplikacji
php artisan key:generate --force

# Uruchom migracje
php artisan migrate --force

# Zoptymalizuj
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Uruchom supervisor (nginx + php-fpm)
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
