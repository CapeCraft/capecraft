<?php

  Namespace CapeCraft\Controllers\Admin;

  use \CapeCraft\Controllers\Controller;
  use \JJG\Ping;
  use \xPaw\MinecraftPing;
	use \xPaw\MinecraftPingException;

  class AdminController extends Controller {

    public static function getHome($request, $response, $args) {
      $host = "play.capecraft.net";
      $ping = new Ping($host);
      try {
        $query = new MinecraftPing($host, 25565 );
        $queryResult = $query->Query();
      } catch( MinecraftPingException $e ) {
		    $queryResult = false;
      }
      return self::getView()->render($response, 'Pages/admin/home.twig', [
        'ping' => $ping->ping(),
        'query' => $queryResult
      ]);
    }

  }
