#!/bin/bash

if [ ! -f .env ]; then
    echo "Membuat file .env dari .env.example..."
    cp .env.example .env
fi

echo "Menginstall composer dependencies..."
composer install --no-interaction

echo "Generate APP_KEY..."
php artisan key:generate --no-interaction

if [ ! -f database/database.sqlite ]; then
    echo "Membuat file database.sqlite..."
    mkdir -p database
    touch database/database.sqlite
fi

echo "Menjalankan migrasi database..."
php artisan migrate --force

echo "Menjalankan server Laravel..."
exec "$@"