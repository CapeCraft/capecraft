<?php
  Namespace CapeCraft\System;

  use \CapeCraft\System\MedooCustom;

  class Database {

    private static $INSTANCE;
    private $database;

    /**
     * Creates the new instance
     */
    public function __construct() {
      $this->database = new MedooCustom([
        'database_type' => $_ENV['DB_TYPE'],
        'database_name' => $_ENV['DB_NAME'],
        'server' => $_ENV['DB_HOST'],
        'username' => $_ENV['DB_USERNAME'],
        'password' => $_ENV['DB_PASSWORD'],
      ]);
    }

    /**
     * Returns a single instance of the database
     * @return Meedo The DB Instance
     */
    public static function getInstance() {
      return self::$INSTANCE->database;
    }

    public static function createInstance() {
      self::$INSTANCE = new Database();
    }
  }
