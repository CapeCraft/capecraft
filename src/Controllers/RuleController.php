<?php

  Namespace CapeCraft\Controllers;

  use \CapeCraft\Controllers\Controller;

  class RuleController extends Controller {

    public static function getRules($request, $response, $args) {
      return self::getView()->render($response, 'Pages/rules.twig');
    }

    public static function getAltRules($request, $response, $args) {
      return self::getView()->render($response, 'Pages/altrules.twig');
    }

  }
