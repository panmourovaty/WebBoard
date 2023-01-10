<?php
require 'account-common.php';
rename("./files/backups/".$_POST["backupname"], "./files/templates/".$_POST["templatename"].'.tar.zst');
header('Location: /templates.php');
?>