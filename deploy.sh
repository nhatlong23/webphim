#!/usr/bin/env bash

DOCKER_COMPOSE_FILE="./docker-compose.yml"

if ! command -v docker compose &> /dev/null; then
    echo "Lỗi: Docker Compose không được cài đặt hoặc không tìm thấy."
    exit 1
fi

if [ ! -f "$DOCKER_COMPOSE_FILE" ]; then
    echo "Lỗi: File docker-compose.yml không tồn tại."
    exit 1
fi

docker compose down --volumes --remove-orphans
docker image prune -f
docker compose pull
docker compose up -d