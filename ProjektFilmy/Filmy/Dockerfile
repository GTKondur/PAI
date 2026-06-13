FROM php:8.2-fpm-alpine

# Zainstaluj zależności systemowe
RUN apk add --no-cache \
    nginx \
    nodejs \
    npm \
    sqlite \
    sqlite-dev \
    curl \
    zip \
    unzip \
    git \
    supervisor

# Zainstaluj rozszerzenia PHP
RUN docker-php-ext-install pdo pdo_sqlite

# Zainstaluj Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Ustaw katalog roboczy
WORKDIR /var/www/html

# Skopiuj pliki projektu
COPY . .

# Zainstaluj zależności PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Zainstaluj zależności Node i zbuduj frontend
RUN npm ci && npm run build

# Skonfiguruj uprawnienia
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Utwórz plik SQLite
RUN mkdir -p /var/www/html/database && \
    touch /var/www/html/database/database.sqlite && \
    chown www-data:www-data /var/www/html/database/database.sqlite

# Konfiguracja Nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Konfiguracja Supervisor (zarządza nginx + php-fpm razem)
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Skrypt startowy
COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80

CMD ["/start.sh"]