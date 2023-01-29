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
    case "deletefolder":
        shell_exec('rm -rf ./files/servers/'.$_GET['server_name'].'/server'.$_GET['folder_path'].'/'.$_GET['file_name']);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        break;
    case "changesettings":
        $_SESSION['filemanager_columns'] = $_POST['filemanager_columns'];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        break;
    case "upload":
        $_SESSION['filemanager_columns'] = $_POST['filemanager_columns'];
        $target_dir = './files/servers/'.$_GET['server_name'].'/server'.$_GET['folder_path'].'/';
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;

        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "<br>Sorry, your file was not uploaded.";
        } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {
        echo "<br>Sorry, there was an error uploading your file.";
        }
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        break;
}
?>