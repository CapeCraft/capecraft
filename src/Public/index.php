<<<<<<< current
<?php

  Namespace CapeCraft;

  use \CapeCraft\Controllers\Controller;
  use \CapeCraft\System\Settings;
  use \CapeCraft\Routes\WebRoutes;
  use \CapeCraft\System\Database as DB;
  use \Dotenv\Dotenv;
  use \Slim\Views\Twig;
  use \Slim\Http\Environment;
  use \Slim\Views\TwigExtension;
  use \Slim\Http\Uri;
  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  require '../../vendor/autoload.php';

  class CapeCraft {
    /**
     * Loads all the important essential variables
     * @return Void
     */
    private function loadEssentials() {
      session_start();
      date_default_timezone_set('UTC');
      spl_autoload_register('self::classAutoloader');

      $dotenv = Dotenv::create(__DIR__, '../.env');
      $dotenv->load();

      DB::createInstance();

      define('DEVELOPMENT_MODE', filter_var(getenv('DEV_MODE'), FILTER_VALIDATE_BOOLEAN));
      Settings::devMode();
    }

    /**
     * This will require a class automatically
     * @param  Class $class The needed class
     */
    private static function classAutoloader($class) {
      $class = str_replace("CapeCraft\\", "", $class);
      $class = str_replace("\\", "/", $class);
      $class = "../".$class.".php";
      require_once($class);
    }

    /**
     * Register the Twig template environment
     * @param  Container $container The Slim Container
     * @return View
     */
    private static function reigisterTwig($container) {
      $view = new Twig('../View', [
        'cache' => (DEVELOPMENT_MODE) ? false : '../View/Cache'
      ]);

      // Instantiate and add Slim specific extension
      $router = $container->get('router');
      $uri = Uri::createFromEnvironment(new Environment($_SERVER));
      $view->addExtension(new TwigExtension($router, $uri));

      $view->getEnvironment()->addGlobal('user', $_SESSION['MEMBER']);

      return $view;
    }

    /**
     * Starts the CapeCraft API Service
     * @return Void
     */
    public static function start() {
      //Load Essential variables
      self::loadEssentials();
      $container = new \Slim\Container;
      if(DEVELOPMENT_MODE) {
        $settings = $container->get('settings');
        $settings->replace([
            'displayErrorDetails' => true,
        ]);
      }

      //Loads the slim application
      $container['view'] = self::reigisterTwig($container);
      $app = new \Slim\App($container);
      Controller::createInstance($app);
      WebRoutes::start($app);
      $app->run();
    }
  }

  /**
   * Starts Everything
   * @var CapeCraft
   */
  CapeCraft::start();
=======
<?php

  Namespace CapeCraft;

  use \CapeCraft\Controllers\Controller;
  use \CapeCraft\System\Settings;
  use \CapeCraft\Routes\WebRoutes;
  use \CapeCraft\System\Database as DB;
  use \Dotenv\Dotenv;
  use \Slim\Views\Twig;
  use \Slim\Http\Environment;
  use \Slim\Views\TwigExtension;
  use \Slim\Http\Uri;
  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;

  require '../../vendor/autoload.php';

  class CapeCraft {
    /**
     * Loads all the important essential variables
     * @return Void
     */
    private function loadEssentials() {
      session_start();
      date_default_timezone_set('UTC');
      spl_autoload_register('self::classAutoloader');

      $dotenv = Dotenv::create(__DIR__, '../.env');
      $dotenv->load();

      DB::createInstance();

      define('DEVELOPMENT_MODE', filter_var(getenv('DEV_MODE'), FILTER_VALIDATE_BOOLEAN));
      Settings::devMode();
    }

    /**
     * This will require a class automatically
     * @param  Class $class The needed class
     */
    private static function classAutoloader($class) {
      $class = str_replace("CapeCraft\\", "", $class);
      $class = str_replace("\\", "/", $class);
      $class = "../".$class.".php";
      require_once($class);
    }

    /**
     * Register the Twig template environment
     * @param  Container $container The Slim Container
     * @return View
     */
    private static function reigisterTwig($container) {
      $view = new Twig('../View', [
        'cache' => (DEVELOPMENT_MODE) ? false : '../View/Cache'
      ]);

      // Instantiate and add Slim specific extension
      $router = $container->get('router');
      $uri = Uri::createFromEnvironment(new Environment($_SERVER));
      $view->addExtension(new TwigExtension($router, $uri));

      if(isset($_SESSION['MEMBER'])) {
        $view->getEnvironment()->addGlobal('user', $_SESSION['MEMBER']);
      }

      return $view;
    }

    /**
     * Starts the CapeCraft API Service
     * @return Void
     */
    public static function start() {
      //Load Essential variables
      self::loadEssentials();
      $container = new \Slim\Container;
      if(DEVELOPMENT_MODE) {
        $settings = $container->get('settings');
        $settings->replace([
            'displayErrorDetails' => true,
        ]);
      }

      //Loads the slim application
      $container['view'] = self::reigisterTwig($container);
      $app = new \Slim\App($container);
      Controller::createInstance($app);
      WebRoutes::start($app);
      $app->run();
    }
  }

  /**
   * Starts Everything
   * @var CapeCraft
   */
  CapeCraft::start();
>>>>>>> before discard
