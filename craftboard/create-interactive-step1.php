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
            <form action="create-interactive-step2.php" method="post">
            <div class="container-fluid pt-4 px-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4"><?php echo $lang['servername']; ?>:</h6>
                            <input type="text" class="form-control" id="servername" name="servername" required>
                            <br>
                            <h6 class="mb-4"><?php echo $lang['serverport']; ?>:</h6>
                            <div class="input-group mb-3">
                                <span class="input-group-text">TCP</span>
                                <input type="text" class="form-control" id="serverport" name="serverport" required>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="container-fluid pt-4 px-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                        
                            <h6 class="mb-4"><?php echo $lang['servertype']; ?></h6>
                            <select  onchange="versionselect()" class="form-select mb-3" name="servertype" id="servertype">
                            <option value="vannila" selected>Vannila (Purpur)</option>
                            <option value="vannilaold">Vannila - old (official)</option>
                            <option value="fabric">Modded (Fabric)</option>
                            <option value="forge">Modded (Forge)</option>
                            <option value="custom">Custom JAR</option>
                            </select>
                            <br>
                            <div id="p1"></div>                   
                        </div>
                    </div>
            </div>
            <div class="container-fluid pt-4 px-4">
                <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">server.properties</h6>
                            <div style="width: 600px; height: 700px;">
                            <?php
                            $EDITOR_BASETEXT = file_get_contents('https://server.properties/');
                            $EDITOR_TEXTTYPE = "properties";
                            require 'editor.php';
                            ?>
                            <script>
                            function loadacetoform() {
                                document.getElementById("serverproperties").value = editor.getValue();
                            }
                            </script>
                            <textarea name="serverproperties" id="serverproperties" hidden></textarea>
                            <p><?php echo $lang['dontchangeportmessage']; ?></p>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="container-fluid pt-4 px-4">
                <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <button onClick="loadacetoform()" type="submit" class="btn btn-primary"><?php echo $lang['createserver']; ?></button>
                        </div>
                    </div>
            </div>                  
            </form>
        </div>
    </div>
    <script>
function versionselect() {
if(document.getElementById('servertype').value != "custom"){
        if(document.getElementById('servertype').value == "vannila") {
            document.getElementById("p1").innerHTML = '<h6 class="mb-4"><?php echo $lang['serverversion']; ?></h6><select class="form-select mb-3" name="serverversion" id="serverversion" required><option value="1.19.3">1.19.3</option> <option value="1.16.5">1.16.5</option></select>';
        }
        if(document.getElementById('servertype').value == "fabric") {
            document.getElementById("p1").innerHTML = '<h6 class="mb-4"><?php echo $lang['serverversion']; ?></h6><select class="form-select mb-3" name="serverversion" id="serverversion" required><option value="1.19.3">1.19.3</option> <option value="1.16.5">1.16.5</option></select>';
        }
        if(document.getElementById('servertype').value == "forge") {
            document.getElementById("p1").innerHTML = '<h6 class="mb-4"><?php echo $lang['serverversion']; ?></h6><select class="form-select mb-3" name="serverversion" id="serverversion" required><option value="1.19.3">1.19.3</option> <option value="1.16.5">1.16.5</option> <option value="1.12.2">1.12.2</option> <option value="1.7.10">1.7.10</option></select>';
        }
        if(document.getElementById('servertype').value == "vannilaold") {
            document.getElementById("p1").innerHTML = '<h6 class="mb-4"><?php echo $lang['serverversion']; ?></h6><select class="form-select mb-3" name="serverversion" id="serverversion" required><option value="1.12.2">1.12.2</option> <option value="1.7.10">1.7.10</option> <option value="1.4.7">1.4.7</option></select>'
        }
}
else { 
    document.getElementById("p1").innerHTML = '<div class="input-group mb-3"><span class="input-group-text">HTTPS</span><input type="text" class="form-control" id="customjar" name="customjar" required></div>';
}
}
versionselect();
</script>
</body>
</html>