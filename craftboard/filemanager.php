<?php
require 'account-common.php';
include 'common.php';
require 'lang.php';
?>
<form action="filemanager-manage.php?filemanager_action=changesettings" method="post">
<h6 class="mb-4"><?php echo $lang['columns']; ?>:</h6>
<input type="number" id="filemanager_columns" name="filemanager_columns" min="1" max="20">
<button type="submit" class="btn btn-primary"><?php echo $lang['save']; ?></button>
</form>
<?php
if (str_contains($_GET['folder_path'], '..') || str_contains($_GET['folder_path'], '../')) {
    echo "Invalid request";
    http_response_code(404);
    exit();
}
$n = "1";
if (isset($_SESSION['filemanager_columns'])) {
    $m = $_SESSION['filemanager_columns'];
}
else {
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
echo '<table class="table table-borderless"><tbody><tr>';
if ($handle = opendir('./files/servers/'.$_GET['server_name'].'/server'.$_GET['folder_path'])) {
    while (false !== ($entry = readdir($handle))) {              
        if ($entry != "." && $entry != "..") {   
            if (is_dir('./files/servers/'.$_GET['server_name'].'/server/'.$_GET['folder_path'].'/'.$entry) == true){
                echo '<td><a href="filemanager.php?server_name='.$_GET['server_name'].'&folder_path='.$_GET['folder_path'].'/'.$entry.'"><b><i class="fa-solid fa-folder fa-4x"></i><br>'.$entry.'</b></a></td>';
            }              
            else {
                switch ($entry) {
                    case str_ends_with($entry, 'jar'):
                        echo '<td style="color:#dc3545;"><i class="fa-brands fa-java fa-4x"></i><br>'.$entry;
                        break;
                    case str_ends_with($entry, 'json') || str_ends_with($entry, 'yml') || str_ends_with($entry, 'yaml') || str_ends_with($entry, 'properties') || str_ends_with($entry, 'conf') || str_ends_with($entry, 'txt'):
                        echo '<td><a style="color:#6c757d;" href="#" onClick="MyWindow=window.open(\'filemanager-edit.php?server_name='.$_GET['server_name'].'&folder_path='.$_GET['folder_path'].'&file_name='.$entry.'\',\'MyWindow\',\'width=800,height=800\'); return false;"><i class="fa-solid fa-file-lines fa-4x"></i><br>'.$entry.'</a>';
                        break;
                    default:
                        echo '<td><a style="color:#6c757d;" href="#" onClick="MyWindow=window.open(\'filemanager-edit.php?server_name='.$_GET['server_name'].'&folder_path='.$_GET['folder_path'].'&file_name='.$entry.'\',\'MyWindow\',\'width=800,height=800\'); return false;"><i class="fa-solid fa-file fa-4x"></i><br>'.$entry.'</a>';
                        break;
                }
                echo '&nbsp;[&nbsp;<a style="color:#198754;" href="./files/servers/'.$_GET['server_name'].'/server/'.$_GET['folder_path'].'/'.$entry.'" download><i class="fa-solid fa-file-arrow-down"></i></a>&nbsp;|&nbsp;';
                echo '<a style="color:#dc3545;" onclick="return confirm(\'Are you sure?\')" href="filemanager-manage.php?filemanager_action=delete&server_name='.$_GET['server_name'].'&folder_path='.$_GET['folder_path'].'&file_name='.$entry.'"><i class="fa-solid fa-file-circle-xmark"></i></a>&nbsp;]</td>';
            }
            if ($n == $m) {
                echo '</tr>';
                echo '<tr>';
                $n = "0";
            }
            else {
                $n++;
            }
        }
    }                 
    closedir($handle);
}
echo '</tr></tbody></table>';
?>