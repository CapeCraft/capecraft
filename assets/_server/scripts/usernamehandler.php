<?php

  class UsernameHandler {

    //Reconnects the database instance
    private $database;
    private $date;

    function __construct() {
      $this->database = MysqliDb::getInstance();
      $this->date = new DateTime();
    }

    function getIP() {
      $time = $this->date->getTimestamp();
      return ($time & 1) ? "removed" : "removed";
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

        if($response == "429") {
          die("We're sorry. We seem to be experiencing some load issues. Try again soon");
        }

        return json_decode($json, true);
      }
    }

    /*
    * Will get the players name from a UUID
    */
    function getName($uuid, $force = false) {
      //Checks the UUID cache for the uuid
      $this->database->where('uuid', $uuid);
      $result = $this->database->getOne('uuidcache');

      //Will update the UUID cache if it's empty
      if($this->database->count == 0) {
        $json = $this->getResponse($uuid, false);
        $data = Array('uuid' => $uuid,
          'username' => $json['name'],
          'lastchecked' => $this->date->getTimestamp()
        );
        $this->database->insert('uuidcache', $data);
        return $json['name'];
      }

      /*
      * Checks if the username has not been updated for a hour.
      * If it hasn't it will get a new useranme from the api, update the database and return it.
      */
      $currentTime = $this->date->getTimestamp();
      $lastchecked = $result['lastchecked'];

      if((($currentTime - $lastchecked) >= 3600) || $force) {
        $json = $this->getResponse($uuid, false);
        if(isset($json['name'])) {
          $this->database->where('uuid', $uuid);
          $this->database->update('uuidcache', Array('username' => $json['name'], 'lastchecked' => $currentTime + rand(1, 100)));
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
      $this->database->where('username', $username);
      $result = $this->database->getOne('uuidcache');

      //Will update the cache if its empty
      if($this->database->count == 0) {
        $json = $this->getResponse($username);

        $data = Array('uuid' => isset($json['id']) ? $json['id'] : "INVALID_USERNAME",
          'username' => $username,
          'lastchecked' => $this->date->getTimestamp()
        );
        $this->database->insert('uuidcache', $data);
        return isset($json['id']) ? $json['id'] : null;
      }

      /*
      * Tries the find the username in the database cache else will grab it from the API
      * If it finds it in the database will check the username is a real minecraft username.
      * if the uuid is INVALID_USERNAME then that means it's not a valid username.
      */
      $currentTime = $this->date->getTimestamp();
      $lastchecked = $result['lastchecked'];

        //Sees if the cache is over an hour old
      if(($currentTime - $lastchecked) >= 3600) {
        $json = $this->getResponse($username);

        //If username returns error then it's not valid.
        if(!isset($json['id'])) {
          $this->database->where('username', $username);
          $data = Array(
            'uuid' => "INVALID_USERNAME",
            'lastchecked' => $this->date->getTimestamp()
          );
          $this->database->update('uuidcache', $data);
          return null;
        }

        //Update the UUID in the database
        $this->database->where('username', $username);
        $data = Array(
          'uuid' => $json['id'],
          'lastchecked' => $this->date->getTimestamp()
        );
        $this->database->update('uuidcache', $data);

        //Returns the UUID
        return $json['id'];
      //Else if the UUID doesn't need updating
      } else {
        return $result['uuid'];
      }
    }

    /*
    * Checks if the username is real or not
    */
    function checkName($username) {
      if($this->getUUID($username) == null)
        return false;
      else
        return true;
    }
  }
