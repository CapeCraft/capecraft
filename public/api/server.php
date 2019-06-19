<?php
  Header("Content-Type: application/json");
  Header("Access-Control-Allow-Origin: *");

  $server = [
    "players" => 11
  ];

  echo json_encode($server);
