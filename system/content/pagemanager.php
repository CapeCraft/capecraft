<?php

  class PageManager {

    //Sanitises then defined the page route.
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

    //Gets info from the database and caches it in a session variable
    function cacheTemplate($templateID) {
      global $database;
      if(!isset($_SESSION['CACHE']['TEMPLATES'][$templateID]) || DEVELOPMENT_MODE) {
        $templates = $database->select('templates', '*');
        foreach($templates as $template)
          $_SESSION['CACHE']['TEMPLATES'][$template['templateID']] = $template;
      }
      return isset($_SESSION['CACHE']['TEMPLATES'][$templateID]) ? $_SESSION['CACHE']['TEMPLATES'][$templateID] : null;
    }

    //Gets info from the database and caches it in a session variable
    function cachePages($route) {
      global $database;
      if(!isset($_SESSION['CACHE']['PAGES'][$route]) || DEVELOPMENT_MODE) {
        $pages = $database->select('pages', '*');
        foreach($pages as $page)
          $_SESSION['CACHE']['PAGES'][$page['route']] = $page;
      }
      return isset($_SESSION['CACHE']['PAGES'][$route]) ? $_SESSION['CACHE']['PAGES'][$route] : null;
    }

    //Gets info from the database and caches it in a session variable
    function cacheIncludes($include) {
      global $database;
      if(!isset($_SESSION['CACHE']['INCLUDES'][$include]) || DEVELOPMENT_MODE) {
        $incs = $database->select('includes', '*');
        foreach($incs as $inc)
          $_SESSION['CACHE']['INCLUDES'][$inc['name']] = $inc;
      }
      return isset($_SESSION['CACHE']['INCLUDES'][$include]) ? $_SESSION['CACHE']['INCLUDES'][$include] : null;
    }
  }
