<?php
switch ($_GET["image_action"]) {
  case "update":
      shell_exec('docker pull '.$_GET["image_name"]);
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      break;
}
?>
