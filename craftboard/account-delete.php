<?php
    require 'account-common.php';
    require 'database.php';
    require 'adminrestrict.php';
    if ($_GET['username'] == "admin") {
        exit();
    }
    $query = $database->exec('DELETE FROM users WHERE username="'.$_GET['username'].'"');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>