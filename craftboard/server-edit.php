<?php
require 'account-common.php';
include 'common.php';
require 'lang.php';
echo "<title>".$lang['editing'].' '.$_GET["server_name"]."</title>";
?>
<form action="server-manage.php?server_action=edit&server_name=<?php echo $_GET["server_name"]; ?>" method="post">
<textarea style="width:800px; height: 600px;" class="form-control" type="text" id="newtext" name="newtext" ><?php echo file_get_contents('./files/servers/'.$_GET['server_name'].'/docker-compose.yml'); ?></textarea>
<input style="float: right;" class="btn btn-lg btn-success" type="submit" value="<?php echo $lang['apply']; ?>"/><button style="float: right;" class="btn btn-lg btn-destructive" onClick="window.close()">Cancel</button>
</form>