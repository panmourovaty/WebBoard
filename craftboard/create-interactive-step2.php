<?php
require 'account-common.php';
include 'config.php';

mkdir('./files/servers/'.$_POST['servername'], 0777);
mkdir('./files/servers/'.$_POST['servername'].'/server', 0777);

$file = fopen('./files/servers/'.$_POST['servername'].'/server/server.properties',"w");
fwrite($file, $_POST['serverproperties']);
fclose($file);

$composefileparsed = yaml_parse($composefile);

switch ($_POST['servertype']) {
    case 'vannila':
        file_put_contents('./files/servers/'.$_POST['servername'].'/server/server.jar', file_get_contents('https://serverjars.com/api/fetchJar/servers/purpur/'.$_POST['serverversion']));
        break;
    case 'vannilaold':
        file_put_contents('./files/servers/'.$_POST['servername'].'/server/server.jar', file_get_contents('https://serverjars.com/api/fetchJar/vanilla/vanilla/'.$_POST['serverversion']));
        break;
    case 'fabric':
        file_put_contents('./files/servers/'.$_POST['servername'].'/server/server.jar', file_get_contents('https://serverjars.com/api/fetchJar/modded/fabric/'.$_POST['serverversion']));
        break;
    case 'forge':
        file_put_contents('./files/servers/'.$_POST['servername'].'/server/server.jar', file_get_contents('https://serverjars.com/api/fetchJar/modded/mohist/'.$_POST['serverversion']));
        break;
    case 'custom':
        file_put_contents('./files/servers/'.$_POST['servername'].'/server/server.jar', file_get_contents($_POST['customjar']));
        break;
}

function userunner($runner)
{
    $composefileparsed['services']['minecraft-server']['image'] = $runner;
}

switch ($_POST['servertype']) {
    case 'vannila':
        switch ($_POST['serverversion']) {
            case '1.19.3':
                $userunner = 'craftboard/runner-alpaquita-liberica-17';
                break;
            case '1.16.5':
                $userunner = 'craftboard/runner-alpaquita-liberica-11';
                break;
        }
        break;
    case 'vannilaold':
        switch ($_POST['serverversion']) {
            case '1.12.2':
                $userunner = 'craftboard/runner-alpaquita-liberica-8';
                break;
            case '1.7.10':
                $userunner = 'craftboard/runner-alpaquita-liberica-8';
                break;
            case '1.4.7':
                $userunner = 'craftboard/runner-alpaquita-liberica-8';
                break;
        }
        break;
    case 'fabric':
        switch ($_POST['serverversion']) {
            case '1.19.3':
                $userunner = 'craftboard/runner-alpaquita-liberica-17';
                break;
            case '1.16.5':
                $userunner = 'craftboard/runner-alpaquita-liberica-11';
                break;
        }
        break;
    case 'forge':
        switch ($_POST['serverversion']) {
            case '1.19.3':
                $userunner = 'craftboard/runner-alpaquita-liberica-17';
                break;
            case '1.16.5':
                $userunner = 'craftboard/runner-alpaquita-liberica-11';
                break;
            case '1.12.2':
                $userunner = 'craftboard/runner-alpaquita-liberica-8';
                break;
            case '1.7.10':
                $userunner = 'craftboard/runner-alpaquita-liberica-8';
                break;
    }
    case 'custom':
        $userunner = 'craftboard/runner-alpaquita-liberica-17';
        break;
}

$composefile = '
version: "3"
services:
  minecraft-server:
    image: '.$userunner.'
    container_name: '.$_POST['servername'].'
    ports:
      - '.$_POST['serverport'].':25565
    volumes:
      - ./server:/opt/server
    environment:
    - RAM_ALLOCATED=2G
    restart: on-failure
    stdin_open: true';

file_put_contents('./files/servers/'.$_POST['servername'].'/docker-compose.yml', $composefile);

shell_exec('./create-int.sh '.$workfolder.' '.$_POST["servername"]);
header('Location: /server.php?server_name='.$_POST["servername"]);
?>