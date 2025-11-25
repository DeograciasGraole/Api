#!/usr/bin/env bash
set -e

echo "Installing composer dependencies..."
composer install --no-dev --working-dir=/var/www/html

echo "Caching config and routes..."
php artisan config:cache
php artisan route:cache

echo "Migrating and seeding database..."
php artisan migrate --seed --force

echo "Deployment complete!"
