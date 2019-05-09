<?php
  if(isset($_GET['p'])) {
    $rawpagenumber = $_GET['p'];
    $rawpagenumber = filter_var($_GET['p'], FILTER_SANITIZE_NUMBER_INT);
  }

  $custom_filter = false;

  if(!empty($_POST['filter_logid'])) {
    $custom_filter = true;
    $custom_filter_row = "logID";
    $custom_filter_val = filter_var($_POST['filter_logid'], FILTER_SANITIZE_STRING);
  }

  if(!empty($_POST['filter_username'])) {
    $custom_filter = true;
    $custom_filter_row = "uuid";
    $custom_filter_val = $usernameHandler->getUUID(filter_var($_POST['filter_username'], FILTER_SANITIZE_STRING));
  }

  if(!empty($_POST['filter_uuid'])) {
    $custom_filter = true;
    $custom_filter_row = "uuid";
    $custom_filter_val = filter_var($_POST['filter_uuid'], FILTER_SANITIZE_STRING);
  }