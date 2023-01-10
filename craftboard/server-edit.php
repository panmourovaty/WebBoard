<?php
include 'common.php';
echo "<title>Editing ".$_GET["server_name"]."</title>";
?>
<form action="server-manage.php?server_action=edit&server_name=<?php echo $_GET["server_name"]; ?>" method="post">
<textarea style="width:800px; height: 600px;" class="form-control" type="text" id="newtext" name="newtext" ><?php echo file_get_contents('./files/servers/'.$_GET['server_name'].'/docker-compose.yml'); ?></textarea><br>
<input class="btn btn-lg btn-success" type="submit" value="Apply"/><button class="btn btn-lg btn-destructive" onClick="closeWindow()">Cancel</button>
</form>