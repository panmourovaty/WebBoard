#!/bin/sh
case $1 in

  "backup")
    cd ./files/servers/$2
    tar --owner=0 --group=0 -I "zstd -T0 -8" -cf ../../backups/$2_$(date +%H:%M-%d-%m-%Y).tar.zst *
    ;;

  "deploy")
    mkdir -p ./files/servers/$2
    tar --no-same-owner --no-same-permissions -I zstd -xf ./files/templates/$3 -C ./files/servers/$2
    ;;

  *)
    echo "invalid action"
    ;;
esac
