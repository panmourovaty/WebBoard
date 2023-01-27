<?php
require 'account-common.php';
include 'common.php';
require 'lang.php';
if (str_contains($_GET['folder_path'], '..') || str_contains($_GET['folder_path'], '../')) {
    echo "Invalid request";
    http_response_code(404);
    exit();
}
echo "<title>".$lang['editing'].' '.$_GET["server_name"]."</title>";
$EDITOR_BASETEXT = file_get_contents('./files/servers/'.$_GET['server_name'].'/server'.$_GET['folder_path'].'/'.$_GET['file_name']);
$EDITOR_TEXTTYPE = "plain";
require 'editor.php';
?>
<script>
function loadacetoform() {
    document.getElementById("newtext").value = editor.getValue();
}
</script>
<form action="filemanager-edit-save.php?server_name=<?php echo $_GET["server_name"]; ?>&folder_path=<?php echo $_GET["folder_path"]; ?>&file_name=<?php echo $_GET["file_name"]; ?>" method="post">
<textarea name="newtext" id="newtext" hidden></textarea>
<input onClick="loadacetoform()" style="float: right;" class="btn btn-lg btn-success" type="submit" value="<?php echo $lang['save']; ?>"/><button style="float: right;" class="btn btn-lg btn-destructive" onClick="window.close()">Cancel</button>
</form>