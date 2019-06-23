<?php
  namespace CapeCraft\Routes;

  use \Tuupola\Middleware\JwtAuthentication;
  use \CapeCraft\System\Settings;

  class Middleware {

    public static function start($request, $response, $next) {
      if($request->getUri()->getPath() == "/admin/account/login") {
        return $next($request, $response);
      }

      if(isset($_SESSION['MEMBER'])) {
        return $next($request, $response);
      } else {
        return $response->withRedirect('/admin/account/login', 301);
      }
    }
  }
