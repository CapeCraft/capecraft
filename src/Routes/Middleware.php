<?php
  namespace CapeCraft\Routes;

  use \Tuupola\Middleware\JwtAuthentication;
  use \CapeCraft\System\Settings;

  class Middleware {

    /**
     * Middleware for admin panel
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
    public static function start($request, $response, $next) {
      //If path is /admin/account/login dont redirect to login
      if($request->getUri()->getPath() == "/admin/account/login") {
        return $next($request, $response);
      }

      //If isset member don't redirect to login
      if(isset($_SESSION['MEMBER'])) {
        return $next($request, $response);
      } else {
        return $response->withRedirect('/admin/account/login', 301);
      }
    }
  }
