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

  }
