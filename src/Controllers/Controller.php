<?php

  Namespace CapeCraft\Controllers;

  abstract class Controller {

    private static $app;

    /**
     * Create instance of the controller so it doesn't get remade every time it's extended
     * @param  App $app The Slim App
     * @return Void
     */
    public static function createInstance($app) {
      self::$app = $app;
    }

    /**
     * Gets the view from the Slim Container
     * @return Twig The Twig Template Engine
     */
    public static function getView() {
      return self::$app->getContainer()->view;
    }
  }
