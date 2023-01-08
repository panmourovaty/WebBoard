<?php
unlink("./files/backups/". htmlspecialchars($_GET["backup_name"]) );
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>