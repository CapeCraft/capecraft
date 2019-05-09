<?php

	use xPaw\MinecraftPing;
	use xPaw\MinecraftPingException;

  class ServerInfo {

    //Reconnects the database instance
    private $database;
    private $query;

    function __construct() {
      $this->database = MysqliDb::getInstance();
    }

    function getInfo() {
      $this->database->where('setting', 'serverinfo');
      $result = $this->database->getOne('siteinfo');
      $result = json_decode($result['value'], true);

      if((time() - $result['checked']) >= 300) {

        require('./assets/_server/classes/serverping/MinecraftPing.php');
        require('./assets/_server/classes/serverping/MinecraftPingException.php');
        $query = new MinecraftPing('play.capecraft.net', 25565);

        $response = $query->Query();
        $json = array("checked" => time(),
                      "server" => base64_encode(json_encode(array("players" => $response['players']))));
        $json = json_encode($json);

        $this->database->where('setting', 'serverinfo')->update('siteinfo', array('value' => $json));

        return array("players" => $response['players']);
      } else {
        return json_decode(base64_decode($result['server']), true);
      }
    }
  }
