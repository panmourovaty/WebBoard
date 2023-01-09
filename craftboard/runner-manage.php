<?php
switch ($_GET["runner_action"]) {
  case "update":
      shell_exec('docker pull '.$_GET["runner_name"]);
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      break;
}
?>
