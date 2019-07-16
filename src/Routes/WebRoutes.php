<?php
  Namespace CapeCraft\Routes;

  use \CapeCraft\Routes\Middleware;
  use \CapeCraft\Controllers\HomeController;
  use \CapeCraft\Controllers\BlogController;
  use \CapeCraft\Controllers\StaffController;
  use \CapeCraft\Controllers\RuleController;
  use \CapeCraft\Controllers\UnbanController;
  use \CapeCraft\Controllers\MerchController;
  use \CapeCraft\Controllers\Admin\AdminController;
  use \CapeCraft\Controllers\Admin\BanLogController;
  use \CapeCraft\Controllers\Admin\AdminBlogController;
  use \CapeCraft\Controllers\Admin\Account\LoginController;
  use \CapeCraft\Controllers\Admin\Account\ProfileController;

  class WebRoutes {

    public static function start($app) {

      //General Pages
      $app->map(['GET'], '/', [ HomeController::class, 'getHome' ]);

      //Blog
      $app->map(['GET'], '/blog', [ BlogController::class, 'getBlogs' ]);
      $app->map(['GET'], '/blog/{page}', [ BlogController::class, 'getBlogs' ]);
      $app->map(['GET'], '/blog/id/{blog}', [ BlogController::class, 'getBlog' ]);

      //Rules
      $app->map(['GET'], '/rules', [ RuleController::class, 'getRules' ]);
      $app->map(['GET'], '/rules/alts', [ RuleController::class, 'getAltRules' ]);

      //Unban Request
      $app->map(['GET'], '/unban', [ UnbanController::class, 'getUnban' ]);
      $app->map(['POST'], '/unban', [ UnbanController::class, 'doUnban' ]);

      $app->map(['GET'], '/staff', [ StaffController::class, 'getStaff' ]);

      /**
       * /merch
       * /donate
       * /discord
       */
      $app->group('/merch', function($app) {
        $app->map(['GET'], '', [ MerchController::class, 'getMerch' ]);
        $app->map(['GET'], '/uk', [ MerchController::class, 'getMerchUK' ]);
        $app->map(['GET'], '/us', [ MerchController::class, 'getMerchUS' ]);
      });

      $app->map(['GET'], '/donate', function($request, $response, $args) {
        return $response->withRedirect('https://capecraftserver.buycraft.net/', 301);
      });
      $app->map(['GET'], '/discord', function($request, $response, $args) {
        return $response->withRedirect('https://discord.gg/62MCajz', 301);
      });

      //Votes
      $app->map(['GET'], '/{_:vote1|Vote1}', function($request, $response, $args) {
        return $response->withRedirect('https://www.planetminecraft.com/server/capecraft-minecraft-survival-at-its-best/vote', 301);
      });

      $app->map(['GET'], '/{_:vote2|Vote2}', function($request, $response, $args) {
        return $response->withRedirect('http://minecraft-mp.com/server/189099/vote/', 301);
      });

      $app->map(['GET'], '/{_:vote3|Vote3}', function($request, $response, $args) {
        return $response->withRedirect('http://minecraftservers.org/vote/488669', 301);
      });

      /**
       * Admin Routes
       */
      $app->group('/admin', function($app) {
        $app->map(['GET'], '', [ AdminController::class, 'getHome' ]);

        //Ban Log Stuff
        $app->group('/banlog', function($app) {
          $app->map(['POST'], '/search', [ BanLogController::class, 'doSearch' ]);
          $app->map(['GET'], '[/{page}]', [ BanLogController::class, 'getBanLog' ]);
        });
        $app->map(['GET'], '/ban/{ban}', [ BanLogController::class, 'getBan' ]);
        $app->map(['POST'], '/ban/{ban}', [ BanLogController::class, 'doBan' ]);
        $app->map(['GET'], '/player/{uuid}', [ BanLogController::class, 'getPlayer' ]);

        //Blog Stuff
        $app->group('/blog', function($app) {
          $app->map(['GET'], '/edit/{blog}', [ AdminBlogController::class, 'getEditBlog' ]);
          $app->map(['GET'], '/delete/{blog}', [ AdminBlogController::class, 'getDeleteBlog' ]);
          $app->map(['GET'], '[/{page}]', [ AdminBlogController::class, 'getBlog' ]);

          $app->map(['POST'], '/edit/{blog}', [ AdminBlogController::class, 'doEditBlog' ]);
          $app->map(['POST'], '/delete/{blog}', [ AdminBlogController::class,'doDeleteBlog' ]);
        });

        //Account Stuff
        $app->group('/account', function($app) {
          $app->map(['GET'], '/login', [ LoginController::class, 'getLogin' ]);
          $app->map(['POST'], '/login', [ LoginController::class, 'doLogin' ]);

          $app->map(['GET'], '/logout', [ LoginController::class, 'getLogout' ]);

          $app->map(['GET'], '/profile', [ ProfileController::class, 'getProfile' ]);
          $app->map(['POST'], '/profile/password', [ ProfileController::class, 'doPasswordReset' ]);
        });
      })->add([ Middleware::class, 'start' ]);
    }

  }
