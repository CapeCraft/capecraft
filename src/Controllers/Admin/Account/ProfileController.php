<?php

  Namespace CapeCraft\Controllers\Admin\Account;

  use \CapeCraft\Controllers\Controller;
  use \CapeCraft\System\Database as DB;

  class ProfileController extends Controller {

    /**
     * Shows the profile page
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
    public static function getProfile($request, $response, $args) {
      return self::getView()->render($response, 'Pages/admin/account/profile.twig', [
        'username' => $_SESSION['MEMBER']['username']
      ]);
    }

    /**
     * Shows the profile page
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
    public static function doPasswordReset($request, $response, $args) {

      $password = $request->getParsedBody()['password'];
      $cpassword = $request->getParsedBody()['confirmpassword'];

      if($password != $cpassword) {
        return self::doError($response, "Those don't match!", "Look likes those passwords don't match!");
      }

      DB::getInstance()->update('users', [
        'password' => password_hash($password, PASSWORD_BCRYPT)
      ], [
        'uuid' => $_SESSION['MEMBER']['uuid']
      ]);

      return self::getView()->render($response, 'Pages/admin/account/profile.twig', [
        'username' => $_SESSION['MEMBER']['username']
      ]);
    }
  }
