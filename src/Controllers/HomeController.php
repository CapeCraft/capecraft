<?php

  Namespace CapeCraft\Controllers;

  use \CapeCraft\Controllers\Controller;
  use \JJG\Ping;
  use \xPaw\MinecraftPing;
	use \xPaw\MinecraftPingException;

  class HomeController extends Controller {

    /**
     * Shows the home page
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
    public static function getHome($request, $response, $args) {
      //Attempts to query and get information from the server
      try {
        $query = new MinecraftPing("play.capecraft.net", 25565 );
        $queryResult = $query->Query();
      } catch( MinecraftPingException $e ) {
		    $queryResult = false;
      }

      //Sets the join message approipately.
      $message = "join us";
      if($queryResult['players']['online'] >= 10) {
        $message = "join " . $queryResult['players']['online'] . " others";
      }

      //Returns the view
      return self::getView()->render($response, 'Pages/home.twig', [
        'message' => $message
      ]);
    }

  }
