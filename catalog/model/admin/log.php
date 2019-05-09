<?php

$database->delete('PunishmentHistory', [ "You've been kicked for being AFK" ]);

  if(isset($searchUUID)) {
    $totalLogs = $database->select('PunishmentHistory', '*',  [ "uuid" => $searchUUID, "ORDER" => ["id" => "DESC"]]);


    //Page Info
    $maxPerPage = 10;
    $pages = ceil(count($totalLogs) / $maxPerPage);

    $logs = $database->select('PunishmentHistory', '*',  [ "uuid" => $searchUUID, "ORDER" => ["id" => "DESC"], "LIMIT" => [$maxPerPage * ($currentPage - 1), 10] ]);
  } else {
    $totalLogs = $database->select('PunishmentHistory', '*',  [ "ORDER" => ["id" => "DESC"]]);


    //Page Info
    $maxPerPage = 10;
    $pages = ceil(count($totalLogs) / $maxPerPage);

    $logs = $database->select('PunishmentHistory', '*',  [ "ORDER" => ["id" => "DESC"], "LIMIT" => [$maxPerPage * ($currentPage - 1), 10] ]);
  }
