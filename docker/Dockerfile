FROM composer:2.2 as builder

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts

FROM wyveo/nginx-php-fpm:php74

WORKDIR /var/www/html/phimmoi48h

COPY --from=builder /app/vendor ./vendor
COPY . .

RUN apt-get update && apt-get install -y \
    net-tools \
    vim

RUN chown -R www-data:www-data /var/www/html/phimmoi48h \
    && rm -rf .env \
    && cp .env.production .env \
    && touch /var/www/html/phimmoi48h/storage/logs/laravel.log \
    && chmod -R 777 /var/www/html/phimmoi48h/storage \
    && chmod -R 777 /var/www/html/phimmoi48h/storage/logs/laravel.log \
    && chmod -R 777 /var/www/html/phimmoi48h/storage/framework/cache \
    && chmod -R 777 /var/www/html/phimmoi48h/storage/framework/sessions \
    && chmod -R 777 /var/www/html/phimmoi48h/storage/framework/views 

EXPOSE 80

LABEL maintainer="nhatlong2356@gmail.com"