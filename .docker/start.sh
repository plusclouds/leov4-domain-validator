#!/bin/bash
mkdir -p /var/www/storage/framework/sessions
mkdir -p /var/www/storage/framework/cache
mkdir -p /var/www/storage/framework/views
chown 755 /var/www/storage -R

php /var/www/artisan cache:clear
php /var/www/artisan config:clear
php /var/www/artisan view:clear

php /var/www/artisan config:cache

echo "Starting services"
service php8.2-fpm start
nginx -g "daemon off;"
