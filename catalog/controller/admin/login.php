<?php
  if(isset($_POST['login'])) {
		$username = $globalScript->checkUsername($_POST['username']);
		if($username != null) {
      $uuid = $usernameHandler->getUUID($username);
			$password = $globalScript->verifyPassword($_POST['password'], $database->get('users', '*', [ "uuid" => $uuid])['password']);
			if($password) {
				$_SESSION['MEMBER']['uuid'] = $uuid;
				$_SESSION['MEMBER']['username'] = $usernameHandler->getName($uuid);
				$_SESSION['MEMBER']['loggedin'] = true;
				Header("Location: /admin");
			}
		}
  }
