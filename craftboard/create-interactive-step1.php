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
                        <form action="create-interactive-step2.php.php" method="post">
                            <h6 class="mb-4"><?php echo $lang['servertype']; ?></h6>
                            <select class="form-select mb-3" name="serversoftware" id="serversoftware">
                            <option value="vannila" selected>Vannila (Purpur)</option>
                            <option value="vannilaold">Vannila - old (official)</option>
                            <option value="fabric">Modded (Fabric)</option>
                            <option value="custom">Custom JAR</option>
                            </select>

                            <script>
                            if(document.getElementById('servertype').value != "custom"){
                            document.write('<h6 class="mb-4"><?php echo $lang['serverversion']; ?></h6>');
                            document.write('<select class="form-select mb-3" name="serverversion" id="serverversion" required>');
                                if(document.getElementById('servertype').value == "vannila") {
                                    document.write('<option value="1.19.3">1.19.3</option>');
                                    document.write('<option value="1.16.5">1.16.5</option>');
                                }
                                if(document.getElementById('servertype').value == "fabric") {
                                    document.write('<option value="1.19.3">1.19.3</option>');
                                    document.write('<option value="1.16.5">1.16.5</option>');
                                }
                                if(document.getElementById('servertype').value == "vannilaold") {
                                    document.write('<option value="1.12.2">1.12.2</option>');
                                    document.write('<option value="1.7.10">1.7.10</option>');
                                    document.write('<option value="1.4.7">1.4.7</option>');
                                    document.write('<option value="b1.7.3">Beta 1.7.3</option>');
                                }
                            document.write('</select>');
                            }
                            else {
                                <div class="input-group mb-3"><span class="input-group-text">HTTPS</span><input type="text" class="form-control" id="customjar" name="customjar" required></div>
                            }
                            </script>
                            <br>
                            <h6 class="mb-4">server.properties</h6>
                            <br>
                            <textarea style="width:800px; height: 600px;" class="form-control" type="text" id="newtext" name="newtext" ><?php echo file_get_contents('https://server.properties/'); ?></textarea>
                            <br>
                            <button style="float: right;" type="submit" class="btn btn-primary"><?php echo $lang['createserver']; ?></button>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</body>
</html>