<?php
  Namespace CapeCraft\Routes;

  use \CapeCraft\Routes\Middleware;
  use \CapeCraft\Controllers\HomeController;
  use \CapeCraft\Controllers\StaffController;
  use \CapeCraft\Controllers\RuleController;
  use \CapeCraft\Controllers\UnbanController;
  use \CapeCraft\Controllers\Admin\AdminController;
  use \CapeCraft\Controllers\Admin\BanLogController;
  use \CapeCraft\Controllers\Admin\Account\LoginController;

  class WebRoutes {

    public static function start($app) {

      //General Pages
      $app->map(['GET'], '/', [ HomeController::class, 'getHome' ]);
      $app->map(['GET'], '/staff', [ StaffController::class, 'getStaff' ]);
      $app->map(['GET'], '/rules', [ RuleController::class, 'getRules' ]);
      $app->map(['GET'], '/rules/alts', [ RuleController::class, 'getAltRules' ]);

      //Unban Request
      $app->map(['GET'], '/unban', [ UnbanController::class, 'getUnban' ]);
      $app->map(['POST'], '/unban', [ UnbanController::class, 'doUnban' ]);

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
        $app->map(['GET'], '', [ AdminController::class, 'getHome' ]);

        $app->group('/banlog', function($app) {
          $app->map(['GET'], '[/{page}]', [ BanLogController::class, 'getBanLog' ]);
        });

        //Account Stuff
        $app->group('/account', function($app) {
          $app->map(['GET'], '/login', [ LoginController::class, 'getLogin' ]);
          $app->map(['POST'], '/login', [ LoginController::class, 'doLogin' ]);
        });
      })->add([ Middleware::class, 'start' ]);
    }

  }
