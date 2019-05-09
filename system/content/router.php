<?php

  class Router {

    //Directories for the files
    private $model = "./catalog/model/";
    private $view = "./catalog/view/";
    private $template = "./catalog/view/templates/";
    private $controller = "./catalog/controller/";
    private $inc = "./catalog/view/inc/";

    //Check page
    private $pageroute;

    //Database
    private $database;

    //PageManager
    private $pagemanager;

    //Sets up variables
    function __construct() {
      global $database, $pagemanager;
      $this->database = $database;
      $this->pagemanager = $pagemanager;
    }

    //Gets the page route unless set manually
    function getPageRoute() {
      return isset($this->pageroute) ? $this->pageroute : PAGE_ROUTE;
    }

    //Can manually show a page if required.
    function showPage($page, $forcedError = null) {
      $page = filter_var($page, FILTER_SANITIZE_STRING);
      $this->pageroute = $page;
      ($forcedError != null) ? define('FORCED_ERROR', $forcedError) : null;
    }

    //Check page make sure its real and not member only
    function checkPage() {
      if(strpos(PAGE_ROUTE, "api") !== false) {
        $file = "system/" . PAGE_ROUTE . ".php";
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

    //Gets the model
    function getModel() {
      $page = $this->pagemanager->cachePages($this->getPageRoute());
      return (isset($page['model'])) ? ($this->model . $page['model']) : null;
    }

    //Get the view
    function getView() {
      $page = $this->pagemanager->cachePages($this->getPageRoute());
      return (isset($page['view'])) ? ($this->view . 'pages/' . $page['view']) : null;
    }

    //Gets the controller
    function getController() {
      $page = $this->pagemanager->cachePages($this->getPageRoute());
      return (isset($page['controller'])) ? ($this->controller . $page['controller']) : null;
    }

    //Gets the template
    function getTemplate() {
      $template_file = $this->pagemanager->cachePages($this->getPageRoute())['template'];
      return $this->template . $this->pagemanager->cacheTemplate($template_file)['file'];
    }

    //Gets current viewed page
    function getPage() {
      return $this->pagemanager->cachePages($this->getPageRoute());
    }

    //Gets an include
    function getIncludes($include) {
      return $this->inc . $this->pagemanager->cacheIncludes($include)['file'];
    }

    //Checks route and will perform action if required
    function checkRoute() {
      //Logout if required
      if(PAGE_ROUTE == "admin/logout") {
        if(isset($_SESSION['MEMBER'])) {
          $_SESSION['MEMBER'] = null;
          session_destroy();
        }
        die(Header("Location: /"));
      }

      /* LanSchool adsense bypass */
      if(PAGE_ROUTE == "discord") {
        die(Header("Location: https://discord.gg/62MCajz"));
      }

      if(PAGE_ROUTE == "youtube") {
        die(Header("Location: https://youtube.com/channel/UC4-2O0Qs_emz9EA396YX5VQ"));
      }

      if(PAGE_ROUTE == "merch") {
        die(Header("Location: https://shop.spreadshirt.co.uk/capecraft/all"));
      }

      if(PAGE_ROUTE == "donate") {
        die(Header("Location: https://capecraftserver.buycraft.net/"));
      }

      if(PAGE_ROUTE == "livestream") {
        die(Header("Location: https://mixer.com/capecraft"));
      }

      //Votes
      if(PAGE_ROUTE == "vote1") {
        die(Header("Location: https://www.planetminecraft.com/server/capecraft-minecraft-survival-at-its-best/vote"));
      }

      if(PAGE_ROUTE == "vote2") {
        die(Header("Location: http://minecraft-mp.com/server/189099/vote/"));
      }

      if(PAGE_ROUTE == "vote3") {
        die(Header("Location: http://minecraftservers.org/vote/488669"));
      }
    }
  }
