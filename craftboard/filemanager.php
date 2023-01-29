<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require 'account-common.php';
    include 'common.php';
    require 'lang.php';
    if (str_contains($_GET['folder_path'], '..') || str_contains($_GET['folder_path'], '../')) {
        echo "Invalid request";
        http_response_code(404);
        exit();
    }
    $n = "1";
    if (isset($_SESSION['filemanager_columns'])) {
        $m = $_SESSION['filemanager_columns'];
    } else {
        $m = "4";
    }
    echo '
<style>
th, td {
    padding: 10px;
    text-align: center; 
    vertical-align: middle;
}
</style>';
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

                                        echo '<a href="server.php?server_name=' . $entry . '" class="dropdown-item">' . $entry . '</a>';
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
                        <div class="col-sm-12 col-xl-6">
                            <div class="bg-light rounded h-100 p-6">
                                <h4 class="mb-4"><?php echo $_GET['server_name']; ?></h4>
                                <form action="filemanager-manage.php?filemanager_action=changesettings" method="post">
                                    <p><?php echo $lang['columns']; ?>:</p><input type="number" id="filemanager_columns" name="filemanager_columns" class="form-control" min="1" max="8" value="<?php echo $m; ?>">
                                    <br>
                                    <button type="submit" class="btn btn-primary"><?php echo $lang['save']; ?></button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <?php
            echo '&nbsp;&nbsp; '.$_GET['folder_path'].'<br>';
            echo '<div><table class="table table-borderless"><tbody><tr>';
            if ($handle = opendir('./files/servers/' . $_GET['server_name'] . '/server' . $_GET['folder_path'])) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                        if (is_dir('./files/servers/' . $_GET['server_name'] . '/server/' . $_GET['folder_path'] . '/' . $entry) == true) {
                            echo '<td><a href="filemanager.php?server_name=' . $_GET['server_name'] . '&folder_path=' . $_GET['folder_path'] . '/' . $entry . '"><b><i class="fa-solid fa-folder fa-4x"></i><br>' . $entry . '</b></a>';
                            echo '&nbsp;<a onclick="return confirm(\'Are you sure?\')" href="filemanager-manage.php?filemanager_action=deletefolder&server_name=' . $_GET['server_name'] . '&folder_path=' . $_GET['folder_path'] . '&file_name=' . $entry . '"><button type="button" class="btn btn-sm btn-danger m-2"><i class="fa-solid fa-trash"></i></button></a></td>';
                        } else {
                            switch ($entry) {
                                case str_ends_with($entry, 'jar'):
                                    echo '<td style="color:#dc3545;"><i class="fa-brands fa-java fa-4x"></i><br>' . $entry;
                                    break;
                                case str_ends_with($entry, 'json') || str_ends_with($entry, 'yml') || str_ends_with($entry, 'yaml') || str_ends_with($entry, 'properties') || str_ends_with($entry, 'conf') || str_ends_with($entry, 'txt'):
                                    echo '<td><a style="color:#6c757d;" href="#" onClick="MyWindow=window.open(\'filemanager-edit.php?server_name=' . $_GET['server_name'] . '&folder_path=' . $_GET['folder_path'] . '&file_name=' . $entry . '\',\'MyWindow\',\'width=800,height=800\'); return false;"><i class="fa-solid fa-file-lines fa-4x"></i><br>' . $entry . '</a>';
                                    break;
                                default:
                                    echo '<td><a style="color:#6c757d;" href="#" onClick="MyWindow=window.open(\'filemanager-edit.php?server_name=' . $_GET['server_name'] . '&folder_path=' . $_GET['folder_path'] . '&file_name=' . $entry . '\',\'MyWindow\',\'width=800,height=800\'); return false;"><i class="fa-solid fa-file fa-4x"></i><br>' . $entry . '</a>';
                                    break;
                            }
                            echo '&nbsp;<a onclick="return confirm(\'Are you sure?\')" href="filemanager-manage.php?filemanager_action=delete&server_name=' . $_GET['server_name'] . '&folder_path=' . $_GET['folder_path'] . '&file_name=' . $entry . '"><button type="button" class="btn btn-sm btn-danger m-2"><i class="fa-solid fa-trash"></i></button></a></td>';
                        }
                        if ($n == $m) {
                            echo '</tr>';
                            echo '<tr>';
                            $n = "1";
                        } else {
                            $n++;
                        }
                    }
                }
                closedir($handle);
            }
            echo '</tr></tbody></table></div>';
            ?>
        </div>
    </div>
</body>

</html>