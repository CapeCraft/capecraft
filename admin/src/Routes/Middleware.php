<?php
  namespace CapeCraft\Routes;

  use \Tuupola\Middleware\JwtAuthentication;
  use \CapeCraft\System\Settings;

  class Middleware {

    public static function start($app) {
      //FOR ALL END POINTS
      $app->add(function($request, $response, $next) {
        if(isset($_SESSION['MEMBER'])) {
          return $next($request, $response);
        } else {
          return $response->withRedirect('/login', 301);
        }
      });
    }
  }
