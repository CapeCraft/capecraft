<?php
  Namespace CapeCraft\Routes;

  use \CapeCraft\Controllers\Admin\AdminController;
  use \CapeCraft\Controllers\Admin\Account\LoginController;

  class WebRoutes {

    public static function start($app) {

      //Admin Routes
      $app->group('/admin', function($app) {
        $app->map(['GET'], '/', [ AdminController::class, 'getHome']);

        //Account Stuff
        $app->group('/account', function($app) {
          $app->map(['GET'], '/login', [ LoginController::class, 'getLogin' ]);
          $app->map(['POST'], '/login', [ LoginController::class, 'doLogin' ]);
        });
      });
    }

  }
