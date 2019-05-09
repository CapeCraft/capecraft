<?php

  class UsernameHandler {

    //Reconnects the database instance
    private $database;

    function __construct() {
      global $database;
      $this->database = $database;
    }

    //Get random IP For load balancing
    function getIP() {
      return (time() & 1) ? "removed" : "removed";      
    }

    /* Gets the Response from the API */
    function getResponse($var, $uuid = true) {
      if(DEVELOPMENT_MODE) {
        $json = file_get_contents($uuid ? UUID_SERVER . $var : NAME_SERVER . $var);
        return json_decode($json, true);
      } else {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_URL => ($uuid ? UUID_SERVER . $var : NAME_SERVER . $var),
          CURLOPT_INTERFACE => $this->getIP()
        ));
        $json = curl_exec($curl);
        $response = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
        curl_close($curl);

        return json_decode($json, true);
      }
    }

   /*
    * Will get the name for a use from a uuid
    * @uuid = uuid of the player
    * @force = should the cache be forcablly refeshed.
    */
    function getName($uuid, $force = false) {
      $uuid = str_replace('-', '', $uuid);
      //Checks the UUID cache for the uuid
      $result = $this->database->get('uuidcache', '*', [ 'uuid' => $uuid ]);

      //Will update the UUID cache if it's empty
      if($result === false) {
        $json = $this->getResponse($uuid, false);
        $data = Array('uuid' => $uuid,
          'username' => $json['name'],
          'lastchecked' => time()
        );
        $this->database->insert('uuidcache', $data);
        return $json['name'];
      }

      /*
      * Checks if the username has not been updated for one minute.
      * If it hasn't it will get a new useranme from the api, update the database and return it.
      */
      $currentTime = time();
      $lastchecked = $result['lastchecked'];

      if((($currentTime - $lastchecked) >= 60) || $force) {
        $json = $this->getResponse($uuid, false);
        if(isset($json['name'])) {
          $data = Array('username' => $json['name'], 'lastchecked' => $currentTime + rand(1, 100));
          $this->database->update('uuidcache', $data, [ 'uuid' => $uuid ]);
          return $json['name'];
        }
        return null;
      } else {
        //Else will return the cached username.
        return $result['username'];
      }
    }

    //Gets the UUID from a username
    function getUUID($username) {
      //Gets the username from the UUID cache
      $result = $this->database->get('uuidcache', '*', [ 'username' => $username ]);

      //Will update the cache if its empty
      if($result === false) {
        $json = $this->getResponse($username);

        $data = Array('uuid' => isset($json['id']) ? $json['id'] : "INVALID_USERNAME",
          'username' => $username,
          'lastchecked' => time()
        );
        $this->database->insert('uuidcache', $data);
        return isset($json['id']) ? $json['id'] : null;
      }

      /*
      * Tries the find the username in the database cache else will grab it from the API
      * If it finds it in the database will check the username is a real minecraft username.
      * if the uuid is INVALID_USERNAME then that means it's not a valid username.
      */
      $currentTime = time();
      $lastchecked = $result['lastchecked'];

        //Sees if the cache is over 5 minutes old
      if(($currentTime - $lastchecked) >= 300) {
        $json = $this->getResponse($username);

        //If username returns error then it's not valid.
        if(!isset($json['id'])) {
          $data = Array(
            'uuid' => "INVALID_USERNAME",
            'lastchecked' => time()
          );
          $this->database->update('uuidcache', $data, [ 'username' => $username ]);
          return null;
        }

        //Update the UUID in the database
        $data = Array(
          'uuid' => $json['id'],
          'lastchecked' => time()
        );
        $this->database->update('uuidcache', $data, [ 'username' => $username ]);

        //Returns the UUID
        return $json['id'];
      //Else if the UUID doesn't need updating
      } else {
        return ($result['uuid'] == "INVALID_USERNAME") ? null : $result['uuid'];
      }
    }

    /*
    * Checks if the username is real or not
    */
    function checkName($username) {
      return ($this->getUUID($username) == null) ? false : true;
    }
  }
