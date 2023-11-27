FROM wyveo/nginx-php-fpm:php74

# Update package lists and upgrade packages
RUN apt-get update && apt-get upgrade -y

# Add a new user 'longnguyen'
RUN useradd -m -s /bin/bash longnguyen

# Set the working directory
WORKDIR /var/www/html

# Set ownership of the working directory to 'longnguyen'
RUN chown -R longnguyen:longnguyen /var/www/html

USER longnguyen

LABEL maintainer="nhatlong2356@gmail.com"
