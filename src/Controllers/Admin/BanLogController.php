<?php

  Namespace CapeCraft\Controllers\Admin;

  use \CapeCraft\Controllers\Controller;
  use \CapeCraft\System\Database as DB;
  use \CapeCraft\Helpers\MojangAPI;

  class BanLogController extends Controller {

    /**
     * Shows the ban log page
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
    public static function getBanLog($request, $response, $args) {

      //Removes all AFK kick punishments
      DB::getInstance()->delete('PunishmentHistory', [ "You've been kicked for being AFK" ]);

      //Sets the variables such as page number and max count on page
      $PAGE_NUMBER = empty($args['page']) || !is_numeric($args['page']) ? 1 : $args['page'];
      $PAGE_LIMIT = 10;
      $TOTAL_BANS = DB::getInstance()->count('PunishmentHistory');

      //Gets the punishment history for the selected pages
      $banLog = DB::getInstance()->select('PunishmentHistory', '*', [
        "ORDER" => [ "id" => "DESC" ],
        "LIMIT" => [ ($PAGE_NUMBER - 1) * $PAGE_LIMIT, 10 ]
      ]);

      //Finds the username for each player in the current list
      foreach($banLog as $key => $ban) {
        $banLog[$key]['username'] = MojangAPI::getUsername($ban['uuid']);
      }

      //Returns the view
      return self::getView()->render($response, 'Pages/admin/banlog.twig', [
        'banLog' => $banLog,
        'pageNumber' => $PAGE_NUMBER,
        'totalPages' => ceil($TOTAL_BANS / $PAGE_LIMIT)
      ]);
    }

    /**
     * Shows the individiual ban information
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
    public static function getBan($request, $response, $args) {

      //Checks the ban is valid, else returns an error page
      if(empty($args['ban']) || !is_numeric($args['ban'])) {
        //// TODO: return error page!
          return;
      }

      //Tries to get the ban from the database else returns an error
      $ban = DB::getInstance()->get('PunishmentHistory', '*', [ "id" => $args['ban'] ]);
      if(empty($ban)) {
        //// TODO: return error page!
        return;
      }

      //Sets the username as well as times of the ban
      $ban['username'] = MojangAPI::getUsername($ban['uuid']);
      $ban['start'] = gmdate("d/m/Y H:i:s", $ban['start'] / 1000);
      $ban['end'] = ($ban['end'] == -1) ? "PERMANENT" : gmdate("d/m/Y H:i:s", $ban['end'] / 1000);

      //Returns the view
      return self::getView()->render($response, 'Pages/admin/ban.twig', [
        'ban' => $ban
      ]);
    }

    /**
     * Sets the proof/notes if set
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Response               Returns the View
     */
    public static function doBan($request, $response, $args) {
      $banID = $args['ban'];
      $banProof = empty($request->getParsedBody()['banProof']) ? null : filter_var($request->getParsedBody()['banProof'], FILTER_SANITIZE_STRING);
      $banNotes = empty($request->getParsedBody()['banNotes']) ? null : filter_var($request->getParsedBody()['banNotes'], FILTER_SANITIZE_STRING);

      DB::getInstance()->update('PunishmentHistory', [
        'proof' => $banProof,
        'notes' => $banNotes
      ], [ 'id' => $banID ]);

      return $response->withJson([ 'success' => true ]);
    }

    /**
     * Gets information about the player
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
    public static function getPlayer($request, $response, $args) {

      $uuid = $args['uuid'];
      if(!preg_match("/[a-fA-F0-9]{32}/", $uuid)) {
        // TODO: Return error page
        return;
      }

      //Gets punishment/player information
      $punishments = DB::getInstance()->select('PunishmentHistory', '*', [ 'uuid' => $uuid ]);
      $player = [
        'uuid' => $uuid,
        'username' => MojangAPI::getUsername($uuid)
      ];

      //Gets the view
      return self::getView()->render($response, 'Pages/admin/player.twig', [
        'player' => $player,
        'punishments' => $punishments
      ]);
    }

  }
