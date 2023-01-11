<?php
require 'account-common.php';
include 'config.php';

shell_exec('./archive-toolbox.sh "deploy" '.$_POST["servername"].' '.$_POST["templatename"]);

shell_exec('./create.sh '.$workfolder.' '.$_POST["servername"].' '.$_POST["serverport"]);
header('Location: /server.php?server_name='.$_POST["servername"]);
?>