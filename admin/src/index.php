<?php

  Namespace CapeCraft;

  use \CapeCraft\System\Settings;
  use \CapeCraft\Routes\WebRoutes;
  use \CapeCraft\Routes\Middleware;
  use \Dotenv\Dotenv;
  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  require '../vendor/autoload.php';

  class CapeCraft {
    /**
     * Loads all the important essential variables
     * @return Void
     */
    private function loadEssentials() {
      spl_autoload_register('self::classAutoloader');
      define('DEVELOPMENT_MODE', filter_var(getenv('DEV_MODE'), FILTER_VALIDATE_BOOLEAN));
      Settings::devMode();
      $dotenv = Dotenv::create(__DIR__, '../.env');
      $dotenv->load();
    }
    /**
     * This will require a class automatically
     * @param  Class $class The needed class
     */
    public static function classAutoloader($class) {
      $class = str_replace("CapeCraft\\", "", $class);
      $class = str_replace("\\", "/", $class);
      $class = "./".$class.".php";
      require_once($class);
    }
    /**
     * Starts the CapeCraft API Service
     * @return Void
     */
    public static function start() {
      self::loadEssentials();
      if(DEVELOPMENT_MODE) {
        $config = [
          'settings' => [
            'displayErrorDetails' => true
          ]
        ];
      } else {
        $config = [];
      }
      $app = new \Slim\App($config);
      Middleware::start($app);
      WebRoutes::start($app);
      $app->run();
    }
  }

  /**
   * Starts Everything
   * @var CapeCraft
   */
  CapeCraft::start();
