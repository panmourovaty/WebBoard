<!DOCTYPE html>
<html lang="en">

<head>
<?php
    require 'account-common.php';
    require 'lang.php';
    include 'common.php';
    $server_info_json = shell_exec('docker inspect '.$_GET["server_name"]);
    $server_info = json_decode($server_info_json, true);
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
            <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="fa fa-server me-2"></i><?php echo $lang['servers']; ?></a>
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
                    <?php 
                        if ($server_info[0]['State']['Status'] == "running" || $server_info[0]['State']['Status'] == "starting") {
                            echo '<a href="server-manage.php?server_action=stop&server_name='.$_GET["server_name"].'"><button type="button" style="float: right;" class="btn btn-danger m-2">'.$lang['stop'].'</button></a><a href="server-manage.php?server_action=restart&server_name='.$_GET["server_name"].'"><button type="button" style="float: right;" class="btn btn-outline-danger m-2">'.$lang['restart'].'</button></a>';
                        }
                        else {
                            echo '<a href="server-manage.php?server_action=start&server_name='.$_GET["server_name"].'"><button type="button" style="float: right;" class="btn btn-success m-2">'.$lang['start'].'</button></a>';
                        }
                    ?>
                        <div class="col-sm-12 col-xl-6">
                            <div class="bg-light rounded h-100 p-6">
                                <h2 class="mb-4"><?php echo htmlspecialchars($_GET["server_name"]); ?></h2>
                                <br>
                                <?php echo $lang['status'].':';
                                if ($server_info[0]['State']['Status'] == "running" || $server_info[0]['State']['Status'] == "starting") {
                                    echo '<p style="color:green;">'.$server_info[0]['State']['Status'].'</p>';
                                }
                                else {
                                    echo '<p style="color:red;">'.$server_info[0]['State']['Status'].'</p>';
                                }
                                ?>
                                <br>
                                <?php echo $lang['laststart'].': '; 
                                $started_parsed = date_parse_from_format('Y-m-d\TH:i:s+',$server_info[0]['State']['StartedAt']); 
                                echo $started_parsed['hour'].': '.$started_parsed['minute'].'-'.$started_parsed['day'].".".$started_parsed['month']."-".$started_parsed['year'];?>
                                <br>
                                <?php echo $lang['created'].': ';
                                $created_parsed = date_parse_from_format('Y-m-d\TH:i:s+',$server_info[0]['Created']); 
                                echo $created_parsed['hour'].': '.$created_parsed['minute'].'-'.$created_parsed['day'].".".$created_parsed['month']."-".$created_parsed['year'];?>
                                <br>
                                <?php echo $lang['runner'].': '.$server_info[0]['Config']['Image']; ?>
                                <br>
                                <br>
                                <?php echo $lang['port'].': '.$server_info[0]['HostConfig']['PortBindings']['25565/tcp'][0]['HostPort']; ?>
                                <br>
                                <?php echo $lang['restartpolicy'].': '.$server_info[0]['HostConfig']['RestartPolicy']['Name']; ?>
                                <br>
                            </div>
                        </div>
                                <?php echo $lang['parameters']; ?>: <br>
                                <div><pre><p><?php print_r($server_info[0]['Config']['Env']); ?></p></pre></div>
                                <br>
                                <br>
                                <a href="#" onClick="MyWindow=window.open('server-console.php?server_name=<?php echo htmlspecialchars($_GET["server_name"]); ?>','MyWindow','width=800,height=600'); return false;"><button type="button" class="btn btn-sm btn-secondary m-2"><?php echo $lang['console']; ?></button></a>
                                <a href="#" onClick="MyWindow=window.open('filemanager.php?server_name=<?php echo $_GET["server_name"]; ?>&folder_path=#','MyWindow','width=800,height=1000'); return false;"><button type="button" class="btn btn-sm btn-secondary m-2"><?php echo $lang['filemanager']; ?></button></a>
                                <a href="#" onClick="MyWindow=window.open('server-edit.php?server_name=<?php echo $_GET["server_name"]; ?>','MyWindow','width=800,height=730'); return false;"><button type="button" class="btn btn-sm btn-secondary m-2"><?php echo $lang['edit']; ?></button></a>
                                <?php echo '<a onclick="return confirm(\'Are you sure?\')" href="server-manage.php?server_action=delete&server_name='.$_GET["server_name"].'"><button type="button" style="float: right;" class="btn btn-danger m-2">'.$lang['delete'].'</button></a>'; ?>    
                                <?php echo '<a href="server-manage.php?server_action=backup&server_name='.$_GET["server_name"].'"><button type="button" style="float: right;" class="btn btn-secondary m-2">'.$lang['makebackup'].'</button></a>'; ?>                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
