<?php
if ($_SESSION['username'] != "admin") {
    echo 'This page is for Administrator only';
    exit();
}
?>