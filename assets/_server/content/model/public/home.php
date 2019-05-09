<?php
  if($serverInfo->getInfo()['players']['online'] >= 10) {
    $playOthers = "join <kbd>" . $serverInfo->getInfo()['players']['online'] . "</kbd> others";
  } else {
    $playOthers = "play";
  }