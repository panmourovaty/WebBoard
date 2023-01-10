<?php
if (file_exists("files/craftboard.db")) 
{
    $database = new SQLite3('files/craftboard.db');
} 
else 
{
    copy('craftboard-example.db', 'files/craftboard.db')
    $database = new SQLite3('files/craftboard.db');
}
?>