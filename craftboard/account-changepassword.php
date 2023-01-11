<?php     
    require 'account-common.php';
    require 'database.php';
        $sql = $database->prepare('SELECT password FROM users WHERE username="'.$_SESSION['username'].'"');         
        $result = $sql->execute();
        $data = $result->fetchArray();
        if (password_verify($_POST['oldpassword'], $data['password'])) 
        {
            $query = $database->exec('UPDATE users SET password='.password_hash($_POST['newpassword'], PASSWORD_ARGON2ID).' WHERE user="'.$_SESSION['username'].'"');
            header('Location: logout.php');
        } 
        else
        {
            echo 'Invalid old password.';
        }
?>