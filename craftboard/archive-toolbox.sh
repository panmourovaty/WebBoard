#!/bin/sh
case $1 in

  "backup")
    cd ./files/servers/$2
    tar --zstd -cf ../../backups/$2_$(date +%H:%M-%d-%m-%Y).tar.zst .
    ;;

  "deploy")
    STATEMENTS
    ;;

  *)
    echo "invalid action"
    ;;
esac
