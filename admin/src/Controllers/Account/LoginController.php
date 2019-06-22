<?php

  Namespace CapeCraft\Controllers\Account;

  use \CapeCraft\Controllers\Controller;

  class LoginController extends Controller {

    public static function getLogin($request, $response, $args) {
      return self::getView()->render($response, 'pages/account/login.twig', [
        'name' => "It works!"
      ]);
    }

  }
