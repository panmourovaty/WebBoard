#!/bin/sh
cd $1/files/servers/$2
TRUEPATH=$(cat /var/www/app/files/truepath)
FIXPATH="$TRUEPATH/servers/$2/server"
sed -i -e "s|- ./server:/opt/server|- $FIXPATH:/opt/server|g" docker-compose.yml
chmod -R 777 server
chown -R nobody:nobody server
docker-compose up -d
