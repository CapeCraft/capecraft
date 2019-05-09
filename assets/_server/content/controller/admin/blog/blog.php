<?php 
  if(isset($_GET['p'])) {
    $rawpagenumber = $_GET['p'];
    $rawpagenumber = filter_var($_GET['p'], FILTER_SANITIZE_NUMBER_INT);
  }