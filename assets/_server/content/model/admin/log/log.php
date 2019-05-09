<?php
  $pagenumber = isset($rawpagenumber) ? $rawpagenumber : 1;  

  $database->get('userlog');
  $totalpage = $database->count;
    
  if(!$custom_filter) {
    $logs = $database->orderBy("id","desc")->get('userlog', array(($pagenumber - 1) * 9 , 9));
  } else {
    $logs = $database->orderBy("id","desc")->where($custom_filter_row, $custom_filter_val)->get('userlog', array(($pagenumber - 1) * 9 , 9));
  }

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