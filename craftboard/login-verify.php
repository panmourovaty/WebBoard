<?php      
    require('database.php');  
        $username = stripcslashes($_POST['username']);  
        $sql = $database->prepare('SELECT password FROM users WHERE username="'.$username.'"');         
        $result = $sql->execute();
        $data = $result->fetchArray();
        if (password_verify($_POST['password'], $data['password'])) 
        {
            $_SESSION['login'] = true;
            header('index.php');
        } 
        else
        {
            echo 'Invalid password.';
        }
?>