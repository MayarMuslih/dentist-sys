#!/usr/bin/env bash
# exit on error
set -e

echo "Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "Installing Node dependencies and building assets..."
npm install
npm run build

echo "Optimizing Laravel configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Running migrations..."
php artisan migrate --force

echo "Build completed successfully!"
