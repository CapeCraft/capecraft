<?php

  Namespace CapeCraft\Controllers;

  use \CapeCraft\Controllers\Controller;
  use \JJG\Ping;
  use \xPaw\MinecraftPing;
	use \xPaw\MinecraftPingException;

  class HomeController extends Controller {

    public static function getHome($request, $response, $args) {
      try {
        $query = new MinecraftPing("play.capecraft.net", 25565 );
        $queryResult = $query->Query();
      } catch( MinecraftPingException $e ) {
		    $queryResult = false;
      }
      return self::getView()->render($response, 'Pages/home.twig', [
        'query' => $queryResult
      ]);
    }

  }
