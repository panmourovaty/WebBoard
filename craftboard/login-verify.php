<?php      
    require('database.php');  
        $username = stripcslashes($_POST['username'];);  
      
        $sql = 'SELECT password FROM users WHERE username="'.$username.'" ';
        $result = $db->query($sql);

        if (password_verify($_POST['password'];, $result)) 
        {
            echo 'Password is valid!';
        } 
        else
        {
            echo 'Invalid password.';
        }
?>  