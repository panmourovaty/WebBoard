#!/bin/sh
cd /var/www/app
mkdir -p files/servers files/backups files/templates
chown -R nobody files/
chmod -R 777 files/
chmod 777 /run/docker.sock
nginx -g 'daemon off;' &
P1=$!
php-fpm8.2 &
P2=$!
wait $P1 $P2
