<?php

  Namespace CapeCraft\Controllers;

  use \CapeCraft\Controllers\Controller;

  class UnbanController extends Controller {

    public static function getUnban($request, $response, $args) {
      return self::getView()->render($response, 'Pages/unban.twig', [
        'siteKey' => getEnv('SITE_KEY')
      ]);
    }

    public static function doUnban($request, $response, $args) {
      return self::getView()->render($response, 'Pages/altrules.twig');
    }

  }
