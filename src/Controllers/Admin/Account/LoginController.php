<?php

  Namespace CapeCraft\Controllers\Account;

  use \CapeCraft\Controllers\Controller;
  use \CapeCraft\Helpers\MojangAPI;
  use \CapeCraft\System\Database as DB;

  class LoginController extends Controller {

    public static function getLogin($request, $response, $args) {
      return self::getView()->render($response, 'pages/account/login.twig');
    }

    public static function doLogin($request, $response, $args) {
      /**
       * Make sure a the username and password values are sent in a POST request
       */
      if(!isset($request->getParsedBody()['username']) || !isset($request->getParsedBody()['password'])) {
        return self::getView()->render($response, 'pages/account/login.twig',
          ['success' => false, 'msg' => 'Username or password incorrect, have you registered?']
        );
      }

      //Sets the $username and $password variables
      $username = filter_var($request->getParsedBody()['username'], FILTER_SANITIZE_STRING);
      $password = $request->getParsedBody()['password'];

      //Trys to get a UUID from the username
      $uuid = MojangAPI::getUUID($username);
      if($uuid == null) {
        return self::getView()->render($response, 'pages/account/login.twig',
          ['success' => false, 'msg' => 'Username or password incorrect, have you registered?']
        );
      }

      //Checks if the user exists
      $userExist = DB::getInstance()->has('users', [ 'uuid' => $uuid ]);
      if(!$userExist) {
        return self::getView()->render($response, 'pages/account/login.twig',
          ['success' => false, 'msg' => 'Username or password incorrect, have you registered?']
        );
      }

      //Trys to get the user if they exist from the database
      $userInfo = DB::getInstance()->get('users', '*', [ 'uuid' => $uuid ]);

      //Verifys the users password
      if(!password_verify($password, $userInfo['password'])) {
        return self::getView()->render($response, 'pages/account/login.twig',
          ['success' => false, 'msg' => 'Username or password incorrect, have you registered?']
        );
      }

      $_SESSION['MEMBER']['uuid'] = $uuid;
      $_SESSION['MEMBER']['username'] = $username;

      return $response->withRedirect('/', 301);
    }

  }
