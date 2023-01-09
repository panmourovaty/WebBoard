<?php
    include 'common.php';
    echo '<div class="bg-light h-100 p-4">';
    echo "<title>".$_GET["server_name"]." logs</title>";
    $output = nl2br(shell_exec('docker logs '.$_GET["server_name"]));
    echo "<p style=\"font-family:Heebo\">".$output."</p>";
    echo "<p style=\"color:blue; font-family:Heebo\">Refresh by F5 or by executing command</p>";
    echo '<form action="server-sendtostdin.php" method="post" autocomplete="off">
    <input class="form-control" style="width: 70%; display: inline;" "type="text" id="command" name="command" >
    <input type="hidden" id="servername" name="servername" value='. $_GET["server_name"] .'>
    <input class="btn btn-lg btn-primary" type="submit" value="Execute Command">
    </form><br>';
    echo '</div>';
    echo "<script>window.scrollTo(0, document.body.scrollHeight);</script>";
?>