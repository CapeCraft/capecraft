<?php

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  global $database;

  //Start   1530813600
  //End     1530900000

  $candidates = array(
    "dfc9f96425ce43d594b1da7ec2c8bb3c",
    "6f1bc9f6046b40e898baedc8402d9346"
  );

  Header("Content-Type: application/json");

  if(isset($_GET['checkElection'])) {
    if(time() >= 1530813600 && time() <= 1530900000) {
      //Election Running
      echo json_encode(["dfc9f96425ce43d594b1da7ec2c8bb3c", "6f1bc9f6046b40e898baedc8402d9346"]);
    } else {
      //Election NOT running
      echo json_encode(false);
    }
  }

  if(isset($_GET['checkVote'])) {
    $uuid = filter_var($_GET['uuid'], FILTER_SANITIZE_STRING);
    echo json_encode(!checkVote($uuid));
  }

  if(isset($_GET['makeVote'])) {
    $clientKey = filter_var($_GET['clientKey'], FILTER_SANITIZE_STRING);
    $uuid = filter_var($_GET['uuid'], FILTER_SANITIZE_STRING);
    $choice = filter_var($_GET['choice'], FILTER_SANITIZE_STRING);
    if($clientKey == "3d735ef25f") {
      if(!checkVote($uuid)) {
        if(in_array($choice, $candidates)) {
          $database->insert('election', [ 'voter' => $uuid, 'choice' => $choice ]);
          echo json_encode([ "success" => "Your Vote has been counted! Thanks for voting!"]);
        } else {
          echo json_encode([ "error" => "Invalid Vote!"]);
        }
      } else {
        echo json_encode([ "error" => "You Have Already Voted!"]);
      }
    } else {
      echo json_encode([ "error" => "Invalid Client Key!"]);
    }
  }

  function checkVote($uuid) {
    global $database;
    $database->where('voter', $uuid )->getOne('election');
    return $database->count;
  }

?>
