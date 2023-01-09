<!DOCTYPE html>
<html lang="en">

<head>
<?php
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
        <a href="/" class="nav-item nav-link"><i class="fa fa-home me-2"></i>Dashboard</a>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="fa fa-server me-2"></i>Servers</a>
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
        <a href="templates.php" class="nav-item nav-link"><i class="fa-solid fa-folder me-2"></i>Templates</a>
        <a href="backups.php" class="nav-item nav-link"><i class="fa-solid fa-floppy-disk me-2"></i>Backups</a>
        <a href="settings.php" class="nav-item nav-link"><i class="fa-solid fa-gear me-2"></i>Settings</a>
        <a href="create.php" class="nav-item nav-link"><i class="fa fa-plus me-2"></i>Create New Server</a>
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
                            echo '<a href="server-manage.php?server_action=restart&server_name='.$_GET["server_name"].'"><button type="button" style="float: right;" class="btn btn-outline-danger m-2">Restart</button></a><a href="server-manage.php?server_action=stop&server_name='.$_GET["server_name"].'"><button type="button" style="float: right;" class="btn btn-danger m-2">Stop</button></a>';
                        }
                        else {
                            echo '<a href="server-manage.php?server_action=start&server_name='.$_GET["server_name"].'"><button type="button" style="float: right;" class="btn btn-success m-2">Start</button>';
                        }
                    ?>
                        <div class="col-sm-12 col-xl-6">
                            <div class="bg-light rounded h-100 p-4">
                                <h2 class="mb-4"><?php echo htmlspecialchars($_GET["server_name"]); ?></h2>
                                <br>
                                Status: <?php
                                if ($server_info[0]['State']['Status'] == "running" || $server_info[0]['State']['Status'] == "starting") {
                                    echo '<p style="color:green;">'.$server_info[0]['State']['Status'].'</p>';
                                }
                                else {
                                    echo '<p style="color:red;">'.$server_info[0]['State']['Status'].'</p>';
                                }
                                ?>
                                <br>
                                Last start: <?php 
                                $started_parsed = date_parse_from_format('Y-m-d\TH:i:s+',$server_info[0]['State']['StartedAt']); 
                                echo $started_parsed['hour'].':'.$started_parsed['minute'].'-'.$started_parsed['day'].".".$started_parsed['month']."-".$started_parsed['year'];?>
                                <br>
                                Created: <?php 
                                $created_parsed = date_parse_from_format('Y-m-d\TH:i:s+',$server_info[0]['Created']); 
                                echo $created_parsed['hour'].':'.$created_parsed['minute'].'-'.$created_parsed['day'].".".$created_parsed['month']."-".$created_parsed['year'];?>
                                <br>
                                Runner: <?php echo $server_info[0]['Config']['Image']; ?>
                                <br>
                                <br>
                                Port: <?php echo $server_info[0]['HostConfig']['PortBindings']['25565/tcp'][0]['HostPort']; ?>
                                <br>
                                Restart policy: <?php echo $server_info[0]['HostConfig']['RestartPolicy']['Name']; ?>
                                <br>
                                Connection string:
                                <br>
                                <textarea class="form-control" style="resize: none" rows="1" readonly><?php echo $_SERVER['SERVER_ADDR'].':'.$server_info[0]['HostConfig']['PortBindings']['25565/tcp'][0]['HostPort']; ?></textarea>
                            </div>
                        </div>
                                Options: <br>
                                <pre><?php print_r($server_info[0]['Config']['Env']); ?></pre>
                                <br>
                                <br>
                                <a href="#" onClick="MyWindow=window.open('server-console.php?server_name=<?php echo htmlspecialchars($_GET["server_name"]); ?>','MyWindow','width=800,height=600'); return false;"><button type="button" class="btn btn-sm btn-secondary m-2">Console</button></a>
                                <?php echo '<a href="server-manage.php?server_action=backup&server_name='.$_GET["server_name"].'"><button type="button" style="float: right;" class="btn btn-secondary m-2">Make Backup</button></a>'; ?>
                                <a href="#" onClick="MyWindow=window.open('tinyfilemanager.php?p=<?php echo $_GET["server_name"].'/server'; ?>','MyWindow','width=1280,height=720'); return false;"><button type="button" class="btn btn-sm btn-secondary m-2">File Manager</button></a>
                                <?php echo '<a onclick="return confirm(\'Are you sure?\')" href="server-manage.php?server_action=delete&server_name='.$_GET["server_name"].'"><button type="button" style="float: right;" class="btn btn-danger m-2">Delete</button></a>'; ?>                                
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>