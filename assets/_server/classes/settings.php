<?php

  class Settings {

    function __construct() {
      $this->showErrors();
      $this->setUUIDServer();
    }

    /* Show PHP errors id DEV_MODE on */
    function showErrors() {
      if(DEVELOPMENT_MODE) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
      }
    }

    /*
    * Define the UUID server has it might be down
    * Implement a UUID server auto checker later on.
    * Will need to implement a way for the server to supply to correct information
    * for when it needs a uuid as they may use different protocol
    * This api is importqant as the website will not fucntion without it.
    * Might need a Mojang direct API getter as complete failback
    */
    function setUUIDServer() {
      $server = "https://api.mojang.com/users/profiles/minecraft/";
      define('UUID_SERVER', $server);

      $server = "https://sessionserver.mojang.com/session/minecraft/profile/";
      define('NAME_SERVER', $server);
    }

    /* Database Settings */
    function database() {
      require('assets/_server/classes/db.php');

      if(DEVELOPMENT_MODE)
        $db = new MysqliDb(Array('host' => 'localhost', 'username' => 'root', 'password' => 'removed', 'db'=> 'removed'));
      else
        $db = new MysqliDb(Array('host' => 'localhost', 'username' => 'database','password' => 'removed', 'db'=> 'removed'));

      return $db;
    }

    /*
    Google Recaptcha

    Defaulty show client key.
    If development mode false ? return real key : return dev key
    */

    function googleRecaptcha($secret = false) {
      if($secret)
        return !DEVELOPMENT_MODE ? "removed" : "removed";
      else
        return !DEVELOPMENT_MODE ? "removed" : "removed";
    }
}
