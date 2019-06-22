<?php
  Namespace CapeCraft\Routes;

  use \CapeCraft\Controllers\HomeController;
  use \CapeCraft\Controllers\Account\LoginController;

  class WebRoutes {

    public static function start($app) {

      $app->map(['GET'], '/', [ HomeController::class, 'getHome']);

      //Account Stuff
      $app->group('/account', function($app) {
        $app->map(['GET'], '/login', [ LoginController::class, 'getLogin' ]);
        $app->map(['POST'], '/login', [ LoginController::class, 'doLogin' ]);
      });
    }

  }
