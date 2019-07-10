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
        $banLog[$key]['start'] = date("d/m/Y H:i:s", $ban['start'] / 1000);
        $banLog[$key]['end'] = ($ban['end'] == -1) ? "PERMANENT" : date("d/m/Y H:i:s", $ban['end'] / 1000);
        $banLog[$key]['banned'] = DB::getInstance()->has('Punishments', [
          'uuid' => $ban['uuid'],
          'OR' => [
            'punishmentType#ban' => "BAN",
            'punishmentType#tempBan' => "TEMP_BAN"
          ]
        ]);
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
        return self::getView()->render($response, 'Pages/admin/error.twig', [
          'error' => [
            'title' => "That's not a valid ban!",
            'msg' => "Look likes you inputed a non-valid ban number!"
          ]
        ]);
      }

      //Tries to get the ban from the database else returns an error
      $ban = DB::getInstance()->get('PunishmentHistory', '*', [ 'id' => $args['ban'] ]);
      if(empty($ban)) {
        return self::getView()->render($response, 'Pages/admin/error.twig', [
          'error' => [
            'title' => "That's not a valid ban!",
            'msg' => "Look likes that ban wasn't found!"
          ]
        ]);
      }

      //Sets the username as well as times of the ban
      $ban['username'] = MojangAPI::getUsername($ban['uuid']);
      $ban['notes'] = base64_decode($ban['notes']);
      $ban['start'] = date("d/m/Y H:i:s", $ban['start'] / 1000);
      $ban['end'] = ($ban['end'] == -1) ? "PERMANENT" : date("d/m/Y H:i:s", $ban['end'] / 1000);

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
        'notes' => base64_encode($banNotes)
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
        return self::getView()->render($response, 'Pages/admin/error.twig', [
          'error' => [
            'title' => "That's not a valid UUID!",
            'msg' => "Look likes you inputed a non-valid UUID!"
          ]
        ]);
      }

      //Gets punishment/player information
      $punishments = DB::getInstance()->select('PunishmentHistory', '*', [
        'uuid' => $uuid,
        'ORDER' => [ 'id' => 'DESC' ]
      ]);

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

    public static function doSearch($request, $response, $args) {

      $username = $request->getParsedBody()['username'];

      //Check username is legit
      if(!preg_match("/^[a-zA-Z0-9_]{1,17}$/", $username)) {
        return null;
      }

      $uuid = MojangAPI::getUUID($username);
      if($uuid === null) {
        return null;
      }

      return $response->withRedirect("/admin/player/$uuid", 301);
    }
  }
