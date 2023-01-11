<?php
require 'account-common.php';
include 'config.php';

mkdir('./files/servers/'.$_POST['servername'], 0777);
mkdir('./files/servers/'.$_POST['servername'].'/server', 0777);

$file = fopen('./files/servers/'.$_POST['servername'].'/server/server.properties',"w");
fwrite($file, $_POST['serverproperties']);
fclose($file);

$composefile = <<<EOD
---
version: "3"
services:
  minecraft-server:
    image:
    container_name: 
    ports:
    volumes:
      - ./server:/opt/server
    environment:
    - RAM_ALLOCATED=2G
    restart: on-failure
    stdin_open: true
...
EOD;
$composefileparsed = yaml_parse($composefile);

switch ($_POST['servertype']) {
    case 'vannila':
        file_put_contents('./files/servers/'.$_POST['servername'].'/server/server.jar', file_get_contents('https://api.purpurmc.org/v2/purpur/'.$_POST['serverversion'].'/latest/download'))
        break;
    case 'vannilaold':
        echo "i equals 1";
        break;
    case 'fabric':
        echo "i equals 2";
        break;
    case 'custom':
        echo "i equals 2";
        break;
}

$composefileparsed['services']['minecraft-server']['container_name'] = $_POST['servername'];
$composefileparsed['services']['minecraft-server']['ports'][0] = $_POST['serverport'].':25565';

function userunner($runner)
{
    $composefileparsed['services']['minecraft-server']['image'] = $runner;
}

switch ($_POST['servertype']) {
    case 'vannila':
        switch ($_POST['serverversion']) {
            case '1.19.3':
                userunner('craftboard/runner-alpaquita-liberica-17');
                break;
            case '1.16.5':
                userunner('craftboard/runner-alpaquita-liberica-17');
                break;
        }
        break;
    case 'vannilaold':
        echo "i equals 1";
        break;
    case 'fabric':
        echo "i equals 2";
        break;
    case 'custom':
        echo "i equals 2";
        break;
}

$file = fopen('./files/servers/'.$_POST['servername'].'/docker-compose.yml',"w");
fwrite($file, yaml_emit($composefileparsed));
fclose($file);

shell_exec('./create-int.sh '.$workfolder.' '.$_POST["servername"]);
header('Location: /server.php?server_name='.$_POST["servername"]);
?>