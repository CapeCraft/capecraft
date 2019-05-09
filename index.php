<?php
  /*
  *   IMPORTANT STANDARDS TO FOLLOW
  *
  *   All PHP strings should be inside ' NOT ".
  *   " is only used with variables or echo.
  */
  //Important Variables
  define('DEVELOPMENT_MODE', false);

  date_default_timezone_set('UTC');

  //Session varibles
  if(!DEVELOPMENT_MODE) {
    ini_set('session.cookie_domain', '.capecraft.net');
  }

  //Starting a session
  session_start();

  //Setup the website with appropiate settings for the environment
  require('system/settings.php');
  $database = Settings::database();
  if(DEVELOPMENT_MODE)
  	Settings::devMode();

  //Check if the users page is a real page.
  require('system/content/pagemanager.php');
  $route = (isset($_GET['route'])) ? $_GET['route'] : 'home';
  $pagemanager = new PageManager($route);

  //Gets the page router and make sure there are no redirects
  require('system/content/router.php');
  $router = new Router();

  //Setup the content manager for assets
  require('system/content/contentmanager.php');
  $utils = new ContentManager();

  //Username and UUID Manager
  require('system/scripts/usernamehandler.php');
  Settings::setUUIDServer();
  $usernameHandler = new UsernameHandler();

  //Global script for commonly used functions.
  require('system/scripts/globalscript.php');
  $globalScript = new GlobalScript();

  $router->checkRoute();

  if(!$router->checkPage()) {
    http_response_code(404);
    $router->showPage("error", true);
  }

  //Checks the controller and model exsits (Must be used after checkPage/showPage)
  $existController = $router->getController();
  $existModel = $router->getModel();

  ($existController != null) ? require($existController) : null;
  ($existModel != null) ? require($existModel) : null;
  require($router->getTemplate());
