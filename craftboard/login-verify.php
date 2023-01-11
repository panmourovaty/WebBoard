<?php      
    require 'database.php';
    require 'lang.php';
        $username = stripcslashes($_POST['username']);
        $language = stripcslashes($_POST['lang']); 
        $sql = $database->prepare('SELECT password FROM users WHERE username="'.$username.'"');         
        $result = $sql->execute();
        $data = $result->fetchArray();
        if (password_verify($_POST['password'], $data['password'])) 
        {
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['lang'] = $language;
            header('Location: index.php');
        } 
        else
        {
            echo $lang['wrongpassword'];
        }
?>