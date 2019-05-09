<?php

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  global $database, $usernameHandler;

  $start = 1537210800;
  $end = 1537383600;

  $candidates = array(
    "86ddbc979d9247f0a7ed0c1f328f0b11",
    "6f1bc9f6046b40e898baedc8402d9346"
  );

  Header("Content-Type: application/json");

  if(isset($_GET['adminCheck']) && isset($_GET['key'])) {
    if($_GET['key'] == "removed") {
      $result = $database->select('election', '*');

      $cadidateCount = [];
      foreach($result as $candidate) {
        if(!isset($cadidateCount[$candidate['choice']])) {
          $cadidateCount[$candidate['choice']] = 0;
        }
        $cadidateCount[$candidate['choice']]++;
      }

      if($cadidateCount[array_keys($cadidateCount)[0]] == $cadidateCount[array_keys($cadidateCount)[1]]) {
        echo json_encode([ 'isDraw' => true, 'total' => $cadidateCount ]);
        return;
      }

      $uuid = array_keys($cadidateCount, max($cadidateCount))[0];
      echo json_encode(['uuid' => $uuid, 'username' => $usernameHandler->getName($uuid), 'total' => $cadidateCount ]);
    }
  }

  if(isset($_GET['checkElection'])) {
    if(time() >= $start && time() <= $end) {
      //Election Running
      echo json_encode($candidates);
    } else {
      //Election NOT running
      echo json_encode(false);
    }
  }

  if(isset($_GET['getResults'])) {
    if(time() < $end) {
      echo json_encode(['electionFinished' => false, 'timeLeft' => $end - time()]);
    } else {
      $result = $database->select('election', '*');

      $cadidateCount = [];
      foreach($result as $candidate) {
        if(!isset($cadidateCount[$candidate['choice']])) {
          $cadidateCount[$candidate['choice']] = 0;
        }
        $cadidateCount[$candidate['choice']]++;
      }

      if($cadidateCount[array_keys($cadidateCount)[0]] == $cadidateCount[array_keys($cadidateCount)[1]]) {
        echo json_encode(['electionFinished' => true, 'isDraw' => true]);
        return;
      }

      $uuid = array_keys($cadidateCount, max($cadidateCount))[0];
      echo json_encode(['electionFinished' => true, 'isDraw' => false, 'uuid' => $uuid, 'username' => $usernameHandler->getName($uuid) ]);
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
    if($clientKey == "removed") {
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
    $result = $database->has('election', [ 'voter' => $uuid ]);
    return $result;
  }

?>
