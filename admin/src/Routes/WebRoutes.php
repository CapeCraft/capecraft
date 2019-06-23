<?php
  Namespace CapeCraft\Routes;

  use \CapeCraft\Controllers\HomeController;
  use \CapeCraft\Controllers\Admin\AdminController;
  use \CapeCraft\Controllers\Admin\Account\LoginController;

  class WebRoutes {

    public static function start($app) {

      $app->map(['GET'], '/', [ HomeController::class, 'getHome']);



      /**
       * /merch
       * /donate
       * /discord
       */
      $app->map(['GET'], '/merch', function($request, $response, $args) {
        return $response->withRedirect('https://shop.spreadshirt.co.uk/capecraft/all', 301);
      });
      $app->map(['GET'], '/donate', function($request, $response, $args) {
        return $response->withRedirect('https://capecraftserver.buycraft.net/', 301);
      });
      $app->map(['GET'], '/discord', function($request, $response, $args) {
        return $response->withRedirect('https://discord.gg/62MCajz', 301);
      });

      /**
       * Admin Routes
       */
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
