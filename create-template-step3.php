<?php
include 'config.php';
try {
$phar = new PharData('./files/templates/'.htmlspecialchars($_POST["templatename"]));
$phar->extractTo('./files/servers/'.htmlspecialchars($_POST["servername"]));
} catch (Exception $e) {
    // handle errors
}

$output = shell_exec('./create.sh '.$workfolder.' '.htmlspecialchars($_POST["servername"]));
echo "<pre>$output</pre>";
sleep(2);
header('Location: /server.php?server_name='.$_POST["servername"]);
?>