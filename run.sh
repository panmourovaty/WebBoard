#!/bin/sh
cd /var/www/app
nginx -g 'daemon off;' &
P1=$!
php-fpm8.2 &
P2=$!
wait $P1 $P2
