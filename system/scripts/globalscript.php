<?php
	class GlobalScript {

    /* Will show the error modal */
		function setModal($title, $content) {
      global $modal;
      $modal['title'] = $title;
      $modal['content'] = $content;
      $modal['show'] = true;
    }

    /*
    * Checks the username to make sure its valid
    * Sanitizes string, check if correct length, check if
    * correct characters and check if real.
    *
    * If $dbCheck is true, then it will check if NOT
    * used in database.
    */
    function checkUsername($username, $dbCheck = false) {
      global $database, $usernameHandler;

      $username = filter_var($username, FILTER_SANITIZE_STRING);

      //Checks if its more than 17 or less than 1.
      if(strlen($username) >= 17 || strlen($username) <= 1) {
        $this->setModal("Error", "The username must be between 1 and 17 characters");
        return null;
      }

      //Checks if the username contains anything other than the allowed symbols.
      if(preg_match('/[^A-Za-z0-9_]/', $username)) {
        $this->setModal("Error", "Please only have letters, numbers and underscores");
        return null;
      }

      if(!$usernameHandler->checkName($username)) {
        $this->setModal("Error", "That's not a REAL username<br>If you already haven account and have recently changed your username. Please wait an hour before trying to login again");
        return null;
      }

      //Checks if the username exists in the database
      if($dbCheck) {
        $database->where('uuid', $usernameHandler->getUUID($username))->get('users');
        if($database->count > 0) {
          $this->setModal("Error", "That username is in use. If you already have an account and have recently changed your username. Please wait an hour before trying to login again");
          return null;
        }
      }
      return $username;
    }

		//Verify password
		function verifyPassword($password, $rowpassword) {
			if(password_verify($password, $rowpassword)) {
				return true;
			} else {
				$this->setModal("Login error!", "Username or Password is incorrect");
				return false;
			}
		}
	}
