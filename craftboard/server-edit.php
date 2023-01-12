<?php
require 'account-common.php';
include 'common.php';
require 'lang.php';
echo "<title>".$lang['editing'].' '.$_GET["server_name"]."</title>";
$EDITOR_BASETEXT = file_get_contents('./files/servers/'.$_GET['server_name'].'/docker-compose.yml');
require 'editor.php';
?>
<script>
function loadacetoform() {
    document.getElementById("newtext").value = editor.getValue();
}
</script>
<form action="server-manage.php?server_action=edit&server_name=<?php echo $_GET["server_name"]; ?>" method="post">
<input name="newtext" type="newtext" id="newtext" hidden></input>
<input style="float: right;" class="btn btn-lg btn-success" type="submit" value="<?php echo $lang['apply']; ?>"/><button style="float: right;" class="btn btn-lg btn-destructive" onClick="window.close()">Cancel</button>
</form>