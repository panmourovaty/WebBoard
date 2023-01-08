#!/bin/sh
cd $1/files/servers/$2
sed -i -e "s/container_name.*/container_name: $2/g" docker-compose.yml
chmod -R 777 server
chown -R nobody:nobody server
docker-compose up -d
