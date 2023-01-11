<?php
    require 'account-common.php';
    require 'database.php';
    require 'adminrestrict.php';
    $query = $database->exec('DELETE FROM users WHERE username="'.$_POST['username'].'"');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>