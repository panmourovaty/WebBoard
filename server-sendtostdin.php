<?php
shell_exec('echo "'.$_POST["command"].'" | socat EXEC:"docker attach '.$_POST["servername"].'",pty STDIN');
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>