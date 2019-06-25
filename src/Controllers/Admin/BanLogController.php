<?php

  Namespace CapeCraft\Controllers\Admin;

  use \CapeCraft\Controllers\Controller;
  use \CapeCraft\System\Database as DB;
  use \CapeCraft\Helpers\MojangAPI;

  class BanLogController extends Controller {

    public static function getBanLog($request, $response, $args) {

      DB::getInstance()->delete('PunishmentHistory', [ "You've been kicked for being AFK" ]);

      $PAGE_NUMBER = empty($args['page']) || !is_numeric($args['page']) ? 1 : $args['page'];
      $PAGE_LIMIT = 10;
      $TOTAL_BANS = DB::getInstance()->count('PunishmentHistory');

      $banLog = DB::getInstance()->select('PunishmentHistory', '*', [
        "ORDER" => [ "id" => "DESC" ],
        "LIMIT" => [ ($PAGE_NUMBER - 1) * $PAGE_LIMIT, 10 ]
      ]);

      foreach($banLog as $key => $ban) {
        $banLog[$key]['username'] = MojangAPI::getUsername($ban['uuid']);
      }

      return self::getView()->render($response, 'Pages/admin/banlog.twig', [
        'banLog' => $banLog,
        'pageNumber' => $PAGE_NUMBER,
        'totalPages' => ceil($TOTAL_BANS / $PAGE_LIMIT)
      ]);
    }

    public static function getBan($request, $response, $args) {

      $ban = DB::getInstance()->get('PunishmentHistory', '*', [
        "id" => $args['ban']
      ]);

      $ban['username'] = MojangAPI::getUsername($ban['uuid']);
      $ban['start'] = gmdate("d/m/Y H:i:s", $ban['start'] / 1000);

      if($ban['end'] == -1)
        $ban['end'] = "PERMANENT";
      else
        $ban['end'] = gmdate("d/m/Y H:i:s", $ban['end'] / 1000);

      return self::getView()->render($response, 'Pages/admin/ban.twig', [
        'ban' => $ban
      ]);
    }

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

    public static function getPlayer($request, $response, $args) {

      $punishments = DB::getInstance()->select('PunishmentHistory', '*', [
        'uuid' => $args['uuid']
      ]);

      $player = [
        'uuid' => $args['uuid'],
        'username' => MojangAPI::getUsername($args['uuid'])
      ];

      return self::getView()->render($response, 'Pages/admin/player.twig', [
        'player' => $player,
        'punishments' => $punishments
      ]);
    }

  }
