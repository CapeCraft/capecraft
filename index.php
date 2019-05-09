<?php
  /*
  *   IMPORTANT STANDARDS TO FOLLOW
  *
  *   All PHP strings should be inside ' NOT ".
  *   " is only used with variables or echo.
  */
  //Important Variables
  define('DEVELOPMENT_MODE', false);

  //Session varibles
  $sessionDomain = DEVELOPMENT_MODE ? '.fasttortoise.co.uk' : '.capecraft.net';
  ini_set('session.cookie_domain', $sessionDomain);

  session_start();

  if(isset($_SESSION['MEMBER']['timezone'])) {
    date_default_timezone_set($_SESSION['MEMBER']['timezone']);
  }

  //Setup the website with appropiate settings for the environment
  require('assets/_server/classes/settings.php');
  $settings = new Settings();
  $database = $settings->database();

  //Seup the content manager for assets
  require('assets/_server/classes/contentmanager.php');
  $utils = new ContentManager();

  //Check if the users page is a real page.
  require('assets/_server/classes/pagemanager.php');
  $route = (isset($_GET['route'])) ? $_GET['route'] : 'home';
  $pagemanager = new PageManager($route);

  //Gets the page router
  require('assets/_server/classes/router.php');
  $router = new Router();

  //Username and UUID Manager
  require('assets/_server/scripts/usernamehandler.php');
  $usernameHandler = new UsernameHandler($database);

  //Server Info manager
  require('assets/_server/scripts/serverinfo.php');
  $serverInfo = new ServerInfo();

  //Global script for commonly used functions.
  require('assets/_server/scripts/globalscript.php');
  $globalScript = new GlobalScript();

  //Model      = Model get all the information required eg works out the info ( eg checkUsername() ) what not
  //View       = Puts all the information in to the template ready for output. eg <h1><php echo $name; ></h1>
  //Controller = Handles post requests and shizzle eg if(isset($_POST)) do_form();

  //Checks route for any matches
  $router->checkRoute();

  //Check if page exists
  if(!$router->checkPage())
    $router->showPage('error', '404');

  //Show the model, view and controller (MVC) or CMV (View is in template shut up) in php ¯\_(ツ)_/¯
  ($router->getController() != null) ? require_once($router->getController()) : null;
  ($router->getModel() != null) ? require_once($router->getModel()) : null;
  require_once($router->getTemplate());
