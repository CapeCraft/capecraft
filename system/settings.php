<?php
  use Medoo\Medoo;

  class Settings {

    function devMode() {
      ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);
    }

    function database() {
      require('db/Medoo.php');

      //Development Database
      $dev = array(
        'database_type' => 'mysql',
        'database_name' => 'capecraft',
        'server' => 'localhost',
        'username' => 'root',
        'password' => 'removed'
      );

      $production = array(
        'database_type' => 'mysql',
        'database_name' => 'capecraft',
        'server' => 'localhost',
        'username' => 'database',
        'password' => 'removed'
      );

      return new Medoo(DEVELOPMENT_MODE ? $dev : $production);
    }

    /*
    * Define the UUID server has it might be down
    * Implement a UUID server auto checker later on.
    * Will need to implement a way for the server to supply to correct information
    * for when it needs a uuid as they may use different protocol
    * This api is importqant as the website will not fucntion without it.
    * Might need a Mojang direct API getter as complete failback
    */
    static function setUUIDServer() {
      $server = "https://api.mojang.com/users/profiles/minecraft/";
      define('UUID_SERVER', $server);

      $server = "https://sessionserver.mojang.com/session/minecraft/profile/";
      define('NAME_SERVER', $server);
    }

    /*
    Google Recaptcha

    Defaulty show client key.
    If development mode false ? return real key : return dev key
    */

    static function googleRecaptcha($secret = false) {
      if($secret)
        return !DEVELOPMENT_MODE ? "removed-vUFqXU" : "removed";
      else
        return !DEVELOPMENT_MODE ? "removed" : "removed";
    }

    static function cloudflareAPI() {
      return "removed";
    }

  }
