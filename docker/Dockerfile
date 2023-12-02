# Sử dụng multi-stage build để giảm kích thước của image cuối cùng
FROM composer:2 as composer

# Stage 1: Build image với Composer
FROM wyveo/nginx-php-fpm:php74 as builder

WORKDIR /var/www/html/phimmoi48h

RUN apt-get update && apt-get install -y \
    git \
    net-tools \
    vim

COPY --from=composer /usr/bin/composer /usr/bin/composer

# Clone mã nguồn từ GitHub và chỉ copy những file cần thiết
RUN git clone --depth 1 https://github.com/nhatlong23/webphim.git .

# Cài đặt Composer dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts

# Chạy các lệnh cần thiết
RUN chown -R www-data:www-data /var/www/html/phimmoi48h \
    && chmod -R 777 storage \
    # && chmod 777 storage/logs/laravel.log \
    && php artisan key:generate

# Stage 2: Tạo image cuối cùng
FROM wyveo/nginx-php-fpm:php74

WORKDIR /var/www/html/phimmoi48h

# Copy từ image builder
COPY --from=builder /var/www/html/phimmoi48h /var/www/html/phimmoi48h

EXPOSE 80

LABEL maintainer="nhatlong2356@gmail.com"
