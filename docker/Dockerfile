FROM wyveo/nginx-php-fpm:php74

WORKDIR /var/www/html/phimmoi48h

RUN apt-get update && apt-get install -y \
    git \
    net-tools \
    vim

RUN git clone https://github.com/nhatlong23/webphim.git .

COPY . ./

RUN [ -e .env.example ] && cp .env.production .env || true

RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts

RUN chown -R www-data:www-data /var/www/html/phimmoi48h

COPY . /var/www/html/phimmoi48h

RUN chmod -R 777 /var/www/html/phimmoi48h/storage
RUN chmod 777 /var/www/html/phimmoi48h/storage/logs/laravel.log

RUN php artisan key:generate

# Chạy migrations và seeders nếu cần
# RUN php artisan migrate --seed

EXPOSE 80

LABEL maintainer="nhatlong2356@gmail.com"
