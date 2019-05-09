<?php
use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;

function getInfo() {
  global $database;
  $result = $database->select('siteinfo', '*', ['setting' => 'serverinfo'])[0];
  $result = json_decode($result['value'], true);

  if((time() - $result['checked']) >= 300) {

    require('system/scripts/serverping/MinecraftPing.php');
    require('system/scripts/serverping/MinecraftPingException.php');
    $query = new MinecraftPing('play.capecraft.net', 25565);

    $response = $query->Query();
    $json = array("checked" => time(),
                  "server" => base64_encode(json_encode(array("players" => $response['players']))));
    $json = json_encode($json);

    $database->update('siteinfo', ['setting' => 'serverinfo'], array('value' => $json));

    return array("players" => $response['players']);
  } else {
    return base64_decode($result['server']);
  }
}

$serverData = getInfo();
$usersOnline = isset($serverData['players']['sample']);
