#!/usr/bin/env bash

# Di chuyển đến thư mục của script
cd "$(dirname $BASH_SOURCE)"

# Dừng và gỡ container hiện tại
docker-compose stop
docker-compose rm -f

# Pull images mới nhất từ Docker Hub
docker-compose pull

# Khởi động các container
docker-compose up -d

# Di chuyển trở lại thư mục làm việc trước đó
cd - > /dev/null
