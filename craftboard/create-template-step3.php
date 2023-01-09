<?php
include 'config.php';

shell_exec('./archive-toolbox.sh "deploy" '.$_POST["servername"].' '.$_POST["templatename"]);

$output = shell_exec('./create.sh '.$workfolder.' '.$_POST["servername"].' '.$_POST["serverport"]);
echo "<pre>$output</pre>";
sleep(2);
header('Location: /server.php?server_name='.$_POST["servername"]);
?>