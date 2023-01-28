<?php
require 'account-common.php';
if (str_contains($_GET['folder_path'], '..') || str_contains($_GET['folder_path'], '../')) {
    echo "Invalid request";
    http_response_code(404);
    exit();
}
switch ($_GET["filemanager_action"]) {
    case "delete":
        unlink('./files/servers/'.$_GET['server_name'].'/server'.$_GET['folder_path'].'/'.$_GET['file_name']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        break;
    case "changesettings":
        $_SESSION['filemanager_columns'] = $_POST['filemanager_columns'];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        break;
}
?>