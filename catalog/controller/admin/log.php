<?php
  $currentPage = isset($_GET['p']) ? filter_var($_GET['p'], FILTER_SANITIZE_NUMBER_INT) : 1;

  if(isset($_POST['search'])) {
    $searchUsername = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $searchUUID = $usernameHandler->getUUID($searchUsername);
  }
