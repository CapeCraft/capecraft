<?php

if(isset($_POST['change-password'])) {
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];

  if(empty($password) || empty($cpassword)) {
    $globalScript->setModal("Error", "Passwords must 6-50 characters long and contain at least one number, one letter and one uppercase letter");
    return;
  }

  if($password == $cpassword) {
    if(strlen($password) >= 6 && strlen($password) <= 50) {
      if(preg_match('/^(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])/', $password)){
        $globalScript->setModal("Success", "Password changed successfully");
        $newPass = password_hash($password, PASSWORD_BCRYPT);
        $database->update('users', ['password' => $newPass], ['uuid' => $_SESSION['MEMBER']['uuid']]);
      } else {
        $globalScript->setModal("Error", "Passwords must 6-50 characters long and contain at least one number, one letter and one uppercase letter");
      }
    } else {
      $globalScript->setModal("Error", "Passwords must 6-50 characters long and contain at least one number, one letter and one uppercase letter");
    }
  } else {
    $globalScript->setModal("Error", "Passwords do not match");
  }
}
