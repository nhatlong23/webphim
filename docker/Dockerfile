FROM composer:2.2 as builder

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts

FROM wyveo/nginx-php-fpm:php74

WORKDIR /var/www/html/phimmoi48h

COPY --from=builder /app/vendor ./vendor
COPY . .

RUN chown -R www-data:www-data /var/www/html/phimmoi48h \
    && rm -rf .env \
    && cp .env.production .env \
    && touch /var/www/html/phimmoi48h/storage/logs/laravel.log \
    && chmod -R 775 /var/www/html/phimmoi48h/storage \
    && chmod -R 775 /var/www/html/phimmoi48h/storage/logs \
    && chmod -R 775 /var/www/html/phimmoi48h/storage/framework/sessions \
    && chmod -R 775 /var/www/html/phimmoi48h/storage/framework/views

EXPOSE 80

LABEL maintainer="nhatlong2356@gmail.com"