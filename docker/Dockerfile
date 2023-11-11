FROM wyveo/nginx-php-fpm:php74

# Install cron and other dependencies
RUN apt-get update \
    && apt-get install -y cron \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Add your cron job file
COPY cronjob /etc/cron.d/cronjob

# Give execution rights on the cron job
RUN chmod 0644 /etc/cron.d/cronjob

# Apply cron job
RUN crontab /etc/cron.d/cronjob

# Create the log file to be able to run tail
RUN touch /var/log/cron.log

# Your other commands and configurations go here

LABEL maintainer="nhatlong2356@gmail.com"
