<?php
switch ($_GET["server_action"]) {
  case "stop":
      shell_exec('cd ./files/servers/'.$_GET["server_name"].' && docker-compose down');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      break;
  case "start":
      shell_exec('cd ./files/servers/'.$_GET["server_name"].' && docker-compose up -d');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      break;
  case "backup":
      shell_exec('cd ./files/servers/'.$_GET["server_name"].' && zip -r ../../backups/'.$_GET["server_name"].'-$(date +%M-%H-%d-%m-%Y).zip .');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      break;
  case "delete":
      shell_exec('cd ./files/servers/'.$_GET["server_name"].' && docker-compose down && cd .. && rm -rf ./'.$_GET["server_name"]);
      header('Location: /');
      break;
}
?>