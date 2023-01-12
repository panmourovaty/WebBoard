<?php
$ACEVERSION = "1.14.0";
echo'
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu+Mono">
<div style="position: relative; width: 640px; height: 500px;">
<div style="position: relative; width: 640px; height: 480px;" id="editor">'.$EDITOR_BASETEXT.'</div>
<br>
  <select onchange="keybindings()" name="keybindings" id="keybindings">
    <option value="vscode" selected>VScode</option>
    <option value="vim">VIM</option>
    <option value="emacs">Emacs</option>
</select>
<input onchange="fontsize()" type="number" id="fontsize" name="fontsize" min="1" max="100" value="14"></input>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/'.$ACEVERSION.'/ace.min.js" type="text/javascript" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/'.$ACEVERSION.'/theme-sqlserver.min.js" type="text/javascript" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/'.$ACEVERSION.'/keybinding-vim.min.js" type="text/javascript" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/'.$ACEVERSION.'/keybinding-emacs.min.js" type="text/javascript" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/'.$ACEVERSION.'/keybinding-vscode.min.js" type="text/javascript" charset="utf-8"></script>
<script>
var editor = ace.edit("editor");
editor.setTheme("ace/theme/sqlserver");
editor.setKeyboardHandler("ace/keyboard/vscode");
editor.setOptions({
  fontFamily: "Ubuntu Mono",
  fontSize: "14"
});
    
function keybindings() {
  editor.setKeyboardHandler("ace/keyboard/" + document.getElementById("keybindings").value);
}
function fontsize() {
  editor.setOptions({
    fontSize: document.getElementById("fontsize").value
  });
}
</script>';
?>