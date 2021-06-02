#!/bin/bash
cd /usr/share/nginx/
chmod 0777 -R storage
cp .env.example .env
php artisan migrate --seed
/start.sh