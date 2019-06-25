<?php

  Namespace CapeCraft\Controllers\Admin;

  use \CapeCraft\Controllers\Controller;
  use \JJG\Ping;
  use \xPaw\MinecraftPing;
	use \xPaw\MinecraftPingException;

  class AdminController extends Controller {

    /**
     * Shows the
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
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
