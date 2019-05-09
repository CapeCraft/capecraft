<?php
  Header("Content-Type: application/json");
  if(!isset($_SESSION['MEMBER'])) {
    die(json_encode('error'));
  }

  $banid = filter_var($_POST['banid'], FILTER_SANITIZE_NUMBER_INT);
  $proof = filter_var($_POST['proof'], FILTER_SANITIZE_STRING);

  global $database;

  $database->update('PunishmentHistory', [ "proof" => $proof ], [ "id" => $banid ]);
  die(json_encode('success'));
