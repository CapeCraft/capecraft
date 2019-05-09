<?php
  // Election Start
  $start = 1530813600;

  // Election End
  $end = 1530900000;

  $electionStatus;

  if(time() < $start) {
    $time = $start;
    $electionStatus = "before";
  } else if(time() > $end) {
    $time = $end;
    $electionStatus = "after";
    //CALCULATE LATER
    $electionResults = $database->get('election');
    $uuids = [];

    foreach($electionResults as $vote) {
      if(!isset($uuids[$vote['choice']])) {
        $uuids[$vote['choice']] = 1;
      } else {
        $uuids[$vote['choice']]++;
      }
    }

    $totalVotes = 0;

    foreach($electionResults as $vote) {
      $totalVotes++;
    }

    arsort($uuids);
    $electionWinner = array_slice($uuids, 0, 1);

  } else {
    $electionStatus = "during";
  }
