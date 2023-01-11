<?php
    require 'account-common.php';
    require 'database.php';
    require 'adminrestrict.php';
    if ($_POST['username'] == "admin") {
        exit();
    }
    $query = $database->exec('DELETE FROM users WHERE username="'.$_POST['username'].'"');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>