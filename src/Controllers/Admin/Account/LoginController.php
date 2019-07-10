<?php

  Namespace CapeCraft\Controllers\Admin\Account;

  use \CapeCraft\Controllers\Controller;
  use \CapeCraft\Helpers\MojangAPI;
  use \CapeCraft\System\Database as DB;

  class LoginController extends Controller {

    /**
     * Gets the page for the login
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
    public static function getLogin($request, $response, $args) {
      return self::getView()->render($response, 'Pages/admin/account/login.twig');
    }

    /**
     * Handle the login request
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Response           Returns the response
     */
    public static function doLogin($request, $response, $args) {
      /**
       * Make sure a the username and password values are sent in a POST request
       */
      if(!isset($request->getParsedBody()['username']) || !isset($request->getParsedBody()['password'])) {
        return self::getView()->render($response, 'Pages/admin/account/login.twig',
          ['success' => false, 'msg' => 'Username or password incorrect, have you registered?']
        );
      }

      //Sets the $username and $password variables
      $username = filter_var($request->getParsedBody()['username'], FILTER_SANITIZE_STRING);
      $password = $request->getParsedBody()['password'];

      //Trys to get a UUID from the username
      $uuid = MojangAPI::getUUID($username);
      if($uuid == null) {
        return self::getView()->render($response, 'Pages/admin/account/login.twig',
          ['success' => false, 'msg' => 'Username or password incorrect, have you registered?']
        );
      }

      //Checks if the user exists
      $userExist = DB::getInstance()->has('users', [ 'uuid' => $uuid ]);
      if(!$userExist) {
        return self::getView()->render($response, 'Pages/admin/account/login.twig',
          ['success' => false, 'msg' => 'Username or password incorrect, have you registered?']
        );
      }

      //Trys to get the user if they exist from the database
      $userInfo = DB::getInstance()->get('users', '*', [ 'uuid' => $uuid ]);

      //Verifys the users password
      if(!password_verify($password, $userInfo['password'])) {
        return self::getView()->render($response, 'Pages/admin/account/login.twig',
          ['success' => false, 'msg' => 'Username or password incorrect, have you registered?']
        );
      }

      //Start the session
      $_SESSION['MEMBER']['uuid'] = $uuid;
      $_SESSION['MEMBER']['username'] = $username;

      //Redirects to admin home page
      return $response->withRedirect('/admin', 301);
    }

    public static function getLogout($request, $response, $args) {
      $_SESSION['MEMBER'] = null;
      self::setVariable('user', null);
      return $response->withRedirect('/', 301);
    }

  }
