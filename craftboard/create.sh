#!/bin/sh
cd $1/files/servers/$2
TRUEPATH = cat ./files/truepath
FIXPATH="$TRUEPATH/servers/$2/server"
sed -i -e "s/container_name.*/container_name: $2/g" docker-compose.yml
sed -i -e "s/- 25565:25565/- $3:25565/g" docker-compose.yml
sed -i -e "s|- ./server:/opt/server|- $FIXPATH:/opt/server|g" docker-compose.yml
chmod -R 777 server
chown -R nobody:nobody server
docker-compose up -d
