#!/bin/bash
cd /usr/share/nginx/
chmod 0777 -R storage
php artisan migrate --seed
/start.sh