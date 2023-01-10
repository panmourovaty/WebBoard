<?php
switch ($_GET["server_action"]) {
  case "stop":
      shell_exec('cd ./files/servers/'.$_GET["server_name"].' && docker-compose stop');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      break;
  case "start":
      shell_exec('cd ./files/servers/'.$_GET["server_name"].' && docker-compose up -d');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      break;
  case "restart":
      shell_exec('cd ./files/servers/'.$_GET["server_name"].' && docker-compose stop && docker-compose up -d');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      break;
  case "backup":
      shell_exec('./archive-toolbox.sh "backup" '.$_GET["server_name"]);
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      break;
  case "delete":
      shell_exec('cd ./files/servers/'.$_GET["server_name"].' && docker-compose down && cd .. && rm -rf ./'.$_GET["server_name"]);
      header('Location: /');
      break;
  case "edit":
      $file = fopen('./files/servers/'.$_GET['server_name'].'/docker-compose.yml',"w");
      fwrite($file, $_POST['newtext']);
      fclose($file);
      shell_exec('cd ./files/servers/'.$_GET["server_name"].' && docker-compose down && docker-compose up -d');
      sleep(1);
      echo "<script>closeWindow()</script>";
      break;
}
?>