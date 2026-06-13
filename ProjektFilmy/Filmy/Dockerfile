FROM php:8.2-fpm-alpine

# Zainstaluj zależności systemowe
RUN apk add --no-cache \
    nginx \
    nodejs \
    npm \
    curl \
    zip \
    unzip \
    git \
    supervisor \
    mysql-client

# Zainstaluj rozszerzenia PHP
RUN docker-php-ext-install pdo pdo_mysql

# Zainstaluj Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Ustaw katalog roboczy
WORKDIR /var/www/html

# Skopiuj pliki projektu
COPY . .

# Skopiuj .env
COPY .env.example .env

# Zainstaluj zależności PHP
RUN COMPOSER_MEMORY_LIMIT=-1 composer install --no-dev --optimize-autoloader --no-interaction --verbose 2>&1 || (echo "COMPOSER FAILED" && cat /tmp/composer* 2>/dev/null && exit 1)

# Zainstaluj zależności Node i zbuduj frontend
RUN npm ci && npm run build

# Skonfiguruj uprawnienia
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Konfiguracja Nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Konfiguracja Supervisor
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Skrypt startowy
COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80
CMD ["/start.sh"]
