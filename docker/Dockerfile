# Sử dụng một hình ảnh có sẵn cho PHP 7.4 và Nginx
FROM wyveo/nginx-php-fpm:php74

# Thiết lập thư mục làm việc
WORKDIR /var/www/html/phimmoi48h

# Cài đặt các gói cần thiết
RUN apt-get update && apt-get install -y \
    git \
    net-tools

# Clone mã nguồn từ GitHub
RUN git clone https://github.com/nhatlong23/webphim.git .

COPY . ./
# Sao chép tệp .env.example và đặt tên là .env
COPY .env* ./

# Cài đặt Composer dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-scripts

# Thiết lập quyền cho thư mục Laravel
RUN chown -R www-data:www-data /var/www/html/phimmoi48h

# Sao chép các tệp và thư mục Laravel
COPY . /var/www/html/phimmoi48h

# Sinh khóa ứng dụng của Laravel
RUN php artisan key:generate

# Chạy migrations và seeders nếu cần
# RUN php artisan migrate --seed

# Expose cổng 80 cho ứng dụng Laravel
EXPOSE 80

# Nhãn thông tin người duy trì hình ảnh
LABEL maintainer="nhatlong2356@gmail.com"
