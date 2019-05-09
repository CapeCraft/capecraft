<?php

  class RememberMe {

    private $database;
    private $cookieName;

    function __construct($database) {
      global $database;
      $this->database = $database;
      $this->cookieName = "mccapes_login";
    }

    //Removes cookie for client machine
    function grabCookie() {
      if(isset($_COOKIE[$this->cookieName])) {
        $sessionID = filter_var($_COOKIE[$this->cookieName], FILTER_SANITIZE_STRING);
        //Check the cookie is safe.
        if(strlen($sessionID) == 32) {
          if(!preg_match('/[^A-Za-z0-9]/', $sessionID)) {
            return $sessionID;
          }
        }
      }
      return null;
    }

    //Checks the cookie for logging in
    function checkCookie() {
      global $usernameHandler;

      $sessionID = $this->grabCookie();
      die($sessionID);

      if($sessionID != null) {
        //Get the user id from cookie
        $userinfo = $this->database->where('sessionkey', $sessionID)->getOne('rememberme');
        if($this->database->count == 1) {
          //Get the userinfo from cookie
          $userID = $userinfo['uuid'];
          $userinfo = $this->database->where('uuid', $userID)->getOne('users');
          if($this->database->count == 1) {
            //Set the session
            $_SESSION['MEMBER']['uuid'] = $userinfo['uuid'];
            $_SESSION['MEMBER']['username'] = $usernameHandler->getName($_SESSION['MEMBER']['uuid']);
            $_SESSION['MEMBER']['email'] = $userinfo['email'];
            $_SESSION['MEMBER']['loggedin'] = true;
            $_SESSION['MEMBER']['admin'] = false;
            $_SESSION['MEMBER']['admin'] = ($_SESSION['MEMBER']['uuid'] == "ba4161c03a42496c8ae07d13372f3371");
          }
        }
      }
    }

    //Creates a cookie on remember me press.
    function createCookie($session) {
      global $sessionDomain;
      //Random Token
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $token = '';
      for ($i = 0; $i < 32; $i++)
          $token .= $characters[rand(0, $charactersLength - 1)];

      //Create Cookie in database

      $this->database->where('uuid', $session)->get('rememberme');
      if($this->database->count > 0) {
        $this->database->where('uuid', $session);
        $this->database->delete('rememberme');
      }

      $data = array("sessionkey" => $token, "uuid" => $session, "created" => time());
      $this->database->insert("rememberme", $data);

      setcookie($this->cookieName, $token, time() + (86400 * 30), "/", $sessionDomain);
    }

    //Delete the cookie
    function deleteCookie($session) {
      $this->database->where('uuid', $session);
      $this->database->delete('rememberme');
      unset($_COOKIE[$this->cookieName]);
      setcookie($this->cookieName, '', time() - 3600);
    }

  }
