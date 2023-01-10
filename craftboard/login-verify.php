<?php      
    require('database.php');  
        $username = stripcslashes($_POST['username']);  
        $sql = $database->prepare('SELECT password FROM users WHERE username="'.$username.'"');         
        $result = $sql->execute();
        $data = $result->fetchArray();
        if (password_verify($_POST['password'], $data['password'])) 
        {
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;
            header('Location: index.php');
        } 
        else
        {
            echo 'Invalid password.';
        }
?>