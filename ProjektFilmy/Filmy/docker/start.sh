#!/bin/sh
set -e

cd /var/www/html

# Generuj klucz aplikacji jeśli nie istnieje
php artisan key:generate --force

# Uruchom migracje
php artisan migrate --force

# Wyczyść i zoptymalizuj cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Uruchom supervisor (nginx + php-fpm)
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf