<?php

  class PageManager {
    
    function __construct($route) {
      $route = filter_var($route, FILTER_SANITIZE_STRING);
      $route = trim($route);
      $route = strip_tags($route);
      $route = strtolower($route);

      if(substr($route, -1) == "/")
        $route = substr(($route), 0, -1);
              
      if(!preg_match('/^[a-zA-Z0-9\/-]+$/', $route)) {
        define('PAGE_ROUTE', '404');
      } else {
        define('PAGE_ROUTE', $route);
      }
    }
    
    /* START CACHING */    
    function cacheTemplate($templateID) {
      global $database;
      if(!isset($_SESSION['CACHE']['PAGE'][$templateID]) || DEVELOPMENT_MODE) {
        $template = $database->where('templateID', $templateID)->getOne('templates');
        $_SESSION['CACHE']['PAGE'][$templateID] = $template;
      }
      return $_SESSION['CACHE']['PAGE'][$templateID];      
    }        
    
    function cachePages($route) {
      global $database;
      if(!isset($_SESSION['CACHE']['PAGE'][$route]) || DEVELOPMENT_MODE) {
        $page = $database->where('route', $route)->getOne('pages');
        $_SESSION['CACHE']['PAGE'][$route] = $page;
      }
      return $_SESSION['CACHE']['PAGE'][$route];      
    }
    
    function cacheIncludes($include) {
      global $database;
      if(!isset($_SESSION['CACHE']['PAGE'][$include]) || DEVELOPMENT_MODE) {
        $inc = $database->where('name', $include)->getOne('includes');
        $_SESSION['CACHE']['PAGE'][$include] = $inc;
      }
      return $_SESSION['CACHE']['PAGE'][$include];       
    }
  }