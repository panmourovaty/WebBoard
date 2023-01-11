<?php
if ($_SESSION['username'] != "admin") {
    echo '<h1>This page is for Administrators only</h1>';
    exit();
}
?>