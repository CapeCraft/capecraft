<?php
  if(isset($_POST['login'])) {
		$username = $globalScript->checkUsername($_POST['username']);		
		if($username != null) {  
      $uuid = $usernameHandler->getUUID($username);
			$password = $globalScript->verifyPassword($_POST['password'], $database->where('uuid', $uuid)->getOne('users')['password']);
			if($password) {            
				$_SESSION['MEMBER']['uuid'] = $uuid;  
				$_SESSION['MEMBER']['username'] = $usernameHandler->getName($uuid);
				$_SESSION['MEMBER']['loggedin'] = true;
				
  			$ip = (DEVELOPMENT_MODE) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['HTTP_CF_CONNECTING_IP'];
  			$json = file_get_contents("http://ip-api.com/json/" . $ip);
  			$json = json_decode($json, true);
				$_SESSION['MEMBER']['timezone'] = $json['timezone'];
				
				Header("Location: /admin");
			}
		}
  }