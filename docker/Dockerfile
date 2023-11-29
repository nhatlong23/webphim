FROM wyveo/nginx-php-fpm:php74

# Update package lists and upgrade packages
USER root
RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y sudo && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Add a new user 'longnguyen' and grant sudo privileges
RUN useradd -m -s /bin/bash longnguyen && \
    echo "longnguyen ALL=(ALL) NOPASSWD:ALL" > /etc/sudoers.d/longnguyen && \
    chmod 0440 /etc/sudoers.d/longnguyen

# Set the working directory
WORKDIR /var/www/html

# Set ownership of the working directory to 'longnguyen'
RUN chown -R longnguyen:longnguyen /var/www/html

USER longnguyen

LABEL maintainer="nhatlong2356@gmail.com"
