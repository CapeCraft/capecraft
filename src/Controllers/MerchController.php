<?php

  Namespace CapeCraft\Controllers;

  use \CapeCraft\Controllers\Controller;

  class MerchController extends Controller {

    /**
     * Shows the home page
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
    public static function getMerch($request, $response, $args) {
      return self::getView()->render($response, 'Pages/merch.twig');
    }

    /**
     * Shows the uk merch page
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
    public static function getMerchUK($request, $response, $args) {
      return $response->withRedirect('https://shop.spreadshirt.co.uk/capecraft/all', 301);
    }

    /**
     * Shows the us merch page
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
    public static function getMerchUS($request, $response, $args) {
      return $response->withRedirect('https://shop.spreadshirt.com/capecraft/all', 301);
    }

  }
