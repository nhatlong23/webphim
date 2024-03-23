FROM wyveo/nginx-php-fpm:php74

WORKDIR /usr/share/nginx/html

COPY . /usr/share/nginx/html

RUN composer install --no-dev --optimize-autoloader

COPY ./docker/config/app.conf /etc/nginx/conf.d/default.conf

COPY .env.production .env

RUN php artisan key:generate
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

RUN chown -R www-data:www-data /var/www/html/phimmoi48h
RUN chmod -R 775 /var/www/html/phimmoi48h

LABEL maintainer="nhatlong2356@gmail.com"