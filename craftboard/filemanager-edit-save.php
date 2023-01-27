<?php
require 'account-common.php';
if (str_contains($_GET['folder_path'], '..') || str_contains($_GET['folder_path'], '../')) {
    echo "Invalid request";
    http_response_code(404);
    exit();
}
if (str_contains($_GET['file_name'], '..')) {
    echo "Invalid request";
    http_response_code(404);
    exit();
}
$file = fopen('./files/servers/'.$_GET['server_name'].'/server'.$_GET['folder_path'].'/'.$_GET['file_name'],"w");
fwrite($file, $_POST['newtext']);
fclose($file);
echo "<script>window.close()</script>";
?>