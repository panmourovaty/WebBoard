<?php     
    require 'account-common.php';
    require 'database.php';
    require 'adminrestrict.php'
    $query = $database->exec('INSERT INTO users (username, password) VALUES ("'.password_hash($_POST['password'], PASSWORD_ARGON2ID).'", "'.$_POST['username'].'")');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>