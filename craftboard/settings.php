<!DOCTYPE html>
<html lang="en">

<head>
<?php
    require 'account-common.php';
    require 'adminrestrict.php';
    require 'lang.php';
    include 'common.php';
    include 'config.php';
    include 'database.php';
?>
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
    <div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
    <a href="/" class="navbar-brand mx-4 mb-3">
        <h3 class="text-primary"><i class="fa-solid fa-cube me-2"></i>CraftBoard</h3>
    </a>
    <div class="navbar-nav w-100">
    <a href="/" class="nav-item nav-link"><i class="fa fa-home me-2"></i><?php echo $lang['dashboard']; ?></a>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-server me-2"></i><?php echo $lang['servers']; ?></a>
            <div class="dropdown-menu bg-transparent border-0">
            <?php
                    if ($handle = opendir('./files/servers')) {

                        while (false !== ($entry = readdir($handle))) {
                    
                            if ($entry != "." && $entry != "..") {
                    
                                echo '<a href="server.php?server_name=' . $entry . '" class="dropdown-item">'. $entry .'</a>';
                            }
                        }
                    
                        closedir($handle);
                    }
            ?>
            </div>
        </div>
        <a href="templates.php" class="nav-item nav-link"><i class="fa-solid fa-folder me-2"></i><?php echo $lang['templates']; ?></a>
        <a href="backups.php" class="nav-item nav-link"><i class="fa-solid fa-floppy-disk me-2"></i><?php echo $lang['backups']; ?></a>
        <a href="settings.php" class="nav-item nav-link active"><i class="fa-solid fa-gear me-2"></i><?php echo $lang['settings']; ?></a>
        <a href="create.php" class="nav-item nav-link"><i class="fa fa-plus me-2"></i><?php echo $lang['createserver']; ?></a>
    </div>
    </nav>
    </div> 
        <div class="content">
            <?php
                include 'navbar.php';
            ?>
                <div class="container-fluid pt-4 px-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                        <h2 class="mb-4"><?php echo $lang['runners']; ?></h2>
                           <?php
                            foreach ($runners as &$i) {
                                $output=null;
                                $return=null;
                                exec('docker image inspect '.$i, $output, $return);
                            
                                if ($return != 0)
                                {
                                    echo '<br><button type="button" class="btn btn-outline-danger">'.$i.'</button><br>';
                                }
                                else
                                {
                                    echo '<br><a href="#" onClick="MyWindow=window.open(\'runner-manage.php?runner_action=inspect&runner_name='.$i.'\',\'MyWindow\',\'width=800,height=600\'); return false;"><button type="button" class="btn btn-outline-success">'.$i.'</button></a> <a href="runner-manage.php?runner_action=update&runner_name='.$i.'"><button type="button" class="btn btn-primary">'.$lang['update'].'</button></a><br>';
                                }
                           }
                           echo "<br>".$lang['updateinfomessage'];
                           ?>
                        </div>
                    </div>
            </div>
            <div class="container-fluid pt-4 px-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                        <h2 class="mb-4"><?php echo $lang['users']; ?></h2>
                        <table class="table table-bordered">
                        <tbody>
                           <?php
                            $sql = $database->prepare('SELECT username FROM users');
                            $result = $sql->execute();
                            while ($data = $result->fetchArray()) {
                                    if ($data['username' == "admin"]) {
                                        echo '<tr><td>'.$data['username'].'</td></tr>';
                                    }
                                    else {
                                        echo '<tr><td>'.$data['username'].'<a onclick="return confirm(\''.$lang['areyousure'].'\')" href="account-delete.php?username=' . $data['username'] . '"><button type="button" class="btn btn-sm btn-danger m-2"><i class="fa-solid fa-trash"></i></button></a></td></tr>';
                                    }
                            }
                           ?>
                           </tbody>
                           </table>
                           <br>
                           <br>
                        <h4 class="mb-4"><?php echo $lang['createnewuser']; ?></h4>
                        <form action="account-create.php" method="post">
                            <h6 class="mb-4"><?php echo $lang['username']; ?>:</h6>
                            <input type="text" class="form-control" id="username" name="username" required>
                            <br>
                            <h6 class="mb-4"><?php echo $lang['password']; ?>:</h6>
                            <input type="password" class="form-control" id="password" name="password" required><br>
                            <button type="submit" class="btn btn-primary"><?php echo $lang['create']; ?></button>
                        </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</body>
</html>