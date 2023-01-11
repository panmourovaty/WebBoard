<!DOCTYPE html>
<html lang="en">

<head>
<?php
    require 'account-common.php';
    require 'lang.php';
    include 'common.php';
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
        <a href="settings.php" class="nav-item nav-link"><i class="fa-solid fa-gear me-2"></i><?php echo $lang['settings']; ?></a>
        <a href="create.php" class="nav-item nav-link active"><i class="fa fa-plus me-2"></i><?php echo $lang['createserver']; ?></a>
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
                    <h4 class="mb-4"><?php echo $lang['creatingserverfrom'].': '.$_GET["template_name"]; ?></h4>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <form action="create-template-step3.php" method="post">
                            <h6 class="mb-4"><?php echo $lang['servername']; ?>:</h6>
                            <input type="text" class="form-control" id="servername" name="servername" required>
                            <br>
                            <h6 class="mb-4"><?php echo $lang['serverport']; ?>:</h6>
                            <div class="input-group mb-3">
                                <span class="input-group-text">TCP</span>
                                <input type="text" class="form-control" id="serverport" name="serverport" required>
                            </div>
                            <input type="hidden" id="templatename" name="templatename" value=<?php echo htmlspecialchars($_GET["template_name"]); ?>>
                            <button type="submit" class="btn btn-primary"><?php echo $lang['create']; ?></button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>