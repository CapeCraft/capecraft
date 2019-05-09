<?php
  $logid = $_GET['logid'];
  $logid = filter_var($logid, FILTER_SANITIZE_STRING);

  $userlog = $database->where('logID', $logid)->getOne('userlog');

  function punishType($logid) {
    switch($logid) {
      case 1:
        return "Temp-Warning";
        break;
      case 2:
        return "Warning";
        break;
      case 3:
        return "Temp-Mute";
        break;        
      case 4:
        return "Mute";
        break;
      case 5:
        return "Kick";
        break;
      case 6:
        return "Temp-Ban";
        break;
      case 7:
        return "Permanent Ban";
        break;
      default:
        return "Error";
        break;
    }
  }

  function getPunishLength($length) {
    switch($length) {
      case 1:
        return "Second/s";
        break;
      case 2:
        return "Minute/s";
        break;
      case 3:
        return "Hour/s";
        break;
      case 4:
        return "Day/s";
        break;
      case 5:
        return "Month/s";
        break;
      default:
        return "Error";
        break;
    }    
  }