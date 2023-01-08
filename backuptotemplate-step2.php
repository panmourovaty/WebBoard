<?php
rename("./files/backups/".$_POST["backupname"], "./files/templates/".$_POST["templatename"].'.zip');
header('Location: /templates.php');
?>