FROM composer:2.2 as builder

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts

FROM wyveo/nginx-php-fpm:php74

WORKDIR /var/www/html/phimmoi48h

COPY . .

RUN rm -f .env && cp .env.production .env \
    && chown -R www-data:www-data /var/www/html/phimmoi48h \
    && chmod -R 775 /var/www/html/phimmoi48h \
    && php artisan key:generate \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

EXPOSE 80

LABEL maintainer="nhatlong2356@gmail.com"