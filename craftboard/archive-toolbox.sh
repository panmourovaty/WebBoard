#!/bin/sh
case $1 in

  "backup")
    cd ./files/servers/$2
    tar --zstd -cf ../../backups/$2_$(date +%H:%M-%d-%m-%Y).tar.zst ./*
    ;;

  "deploy")
    mkdir -p ./files/servers/$2
    tar -I zstd -xf ./files/templates/$3 -C ./files/servers/$2
    ;;

  *)
    echo "invalid action"
    ;;
esac
