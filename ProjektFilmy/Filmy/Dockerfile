FROM php:8.2-fpm-alpine

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

RUN docker-php-ext-install pdo pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN COMPOSER_MEMORY_LIMIT=-1 composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-scripts

RUN php artisan package:discover --ansi 2>/dev/null || true

RUN npm ci && npm run build

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80

CMD ["/start.sh"]
