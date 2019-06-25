<?php

  Namespace CapeCraft\Controllers;

  use \CapeCraft\Controllers\Controller;

  class UnbanController extends Controller {

    /**
     * Shows the unban form
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
    public static function getUnban($request, $response, $args) {
      return self::getView()->render($response, 'Pages/unban.twig', [
        'siteKey' => getEnv('SITE_KEY')
      ]);
    }

    //// TODO: The Unban Handler
    public static function doUnban($request, $response, $args) {
      return self::getView()->render($response, 'Pages/altrules.twig');
    }

  }
