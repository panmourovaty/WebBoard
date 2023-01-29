<?php
require 'account-common.php';
$target_dir = "./files/templates/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;

if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

if($imageFileType != "zst" ) {
  echo "Sorry, only .tar.zst templates are allowed.";
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
?>