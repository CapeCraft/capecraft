<?php

  Namespace CapeCraft\Controllers;

  use \CapeCraft\Controllers\Controller;

  class RuleController extends Controller {

    /**
     * Shows the game rules
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
    public static function getRules($request, $response, $args) {
      return self::getView()->render($response, 'Pages/rules/rules.twig');
    }

    /**
     * Shows the alt rules
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
    public static function getAltRules($request, $response, $args) {
      return self::getView()->render($response, 'Pages/rules/altrules.twig');
    }

  }
