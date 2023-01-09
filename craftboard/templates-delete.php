<?php
unlink("./files/templates/". htmlspecialchars($_GET["template_name"]) );
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>