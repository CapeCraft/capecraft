<?php

  class Router {

    //Directories for the files
    private $model = "./assets/_server/content/model/";
    private $view = "./assets/_server/content/view/";
    private $template = "./assets/_server/content/view/templates/";
    private $controller = "./assets/_server/content/controller/";
    private $inc = "./assets/_server/content/view/inc/";

    //Check page
    private $pageroute;

    //Database
    private $database;

    //Router
    private $pagemanager;

    function __construct() {
      global $database, $pagemanager;
      $this->database = $database;
      $this->pagemanager = $pagemanager;
    }

    function getPageRoute() {
      return isset($this->pageroute) ? $this->pageroute : PAGE_ROUTE;
    }

    //Can manually show a page if required.
    function showPage($page, $pagecode = null) {
      $page = filter_var($page, FILTER_SANITIZE_STRING);
      $this->pageroute = $page;
      define('PAGE_CODE', $pagecode);
    }

    //Check page make sure its real and not member only
    function checkPage() {
      if(strpos(PAGE_ROUTE, "api") !== false) {        
        $file = "assets/_server/" . PAGE_ROUTE . ".php";
        if(file_exists($file)) {
          exit(require_once($file));
        } else {
          exit(Header("Location: /"));
        }
        die();
      }

      if($this->isMemberOnly() && !isset($_SESSION['MEMBER'])) {
        $this->showPage('admin/login');
      }
      return ($this->getPage() != null);
    }

    //Returns if member only
    function isMemberOnly() {
      return $this->pagemanager->cachePages($this->getPageRoute())['login'];
    }

    /* Respond with MVC */
    function getModel() {
      $model = $this->pagemanager->cachePages($this->getPageRoute())['model'];
      if(isset($model))
        return $this->model . $model;
      else
        return null;
    }

    function getView() {
      return $this->view . $this->pagemanager->cachePages($this->getPageRoute())['view'];
    }

    function getController() {
      $controller = $this->pagemanager->cachePages($this->getPageRoute())['controller'];
      if(isset($controller))
        return $this->controller . $controller;
      else
        return null;
    }

    function getTemplate() {
      $template_file = $this->pagemanager->cachePages($this->getPageRoute())['template'];
      return $this->template . $this->pagemanager->cacheTemplate($template_file)['file'];
    }

    function getPage() {
      return $template = $this->pagemanager->cachePages($this->getPageRoute());
    }

    function getIncludes($include) {
      return $this->inc . $this->pagemanager->cacheIncludes($include)['file'];
    }


    //Checks route and will perform action if required
    function checkRoute() {

      //Logout
      if($this->getPageRoute() == "logout") {
        $_SESSION['MEMBER'] = null;
        session_destroy();
        Header("Location: /admin");
      }

      //Discord URL
      if($this->getPageRoute() == "discord") {
        Header("Location: https://discord.gg/62MCajz");
      }

      //YouTube URL
      if($this->getPageRoute() == "youtube") {
        Header("Location: https://www.youtube.com/channel/UC4-2O0Qs_emz9EA396YX5VQ");
      }

      //Livestream
      if($this->getPageRoute() == "livestream") {
        Header("Location: https://www.youtube.com/watch?v=QNpm8Da0HQA");
      }

      //Votes
      if($this->getPageRoute() == "vote1") {
        Header("Location: http://minecraft-server-list.com/server/420883/vote/");
      }

      if($this->getPageRoute() == "vote2") {
        Header("Location: http://minecraft-mp.com/server/189099/vote/");
      }

      if($this->getPageRoute() == "vote3") {
        Header("Location: http://minecraftservers.org/vote/488669");
      }
    }

  }
