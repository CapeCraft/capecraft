<?php
		if(isset($_POST['add_new_log'])) {
			
			//Gets username
			$username = $globalScript->checkUsername($_POST['username']);
			if($username == null) {
				return;
			}
			
			//Gets UUID and makes BanID
			$uuid = $usernameHandler->getUUID($username);
			$logID = substr($uuid, 0, 8) . "-" . time();
			
			//Gets Ban Type
			$type = $_POST['type'];
			$type = filter_var($type, FILTER_SANITIZE_NUMBER_INT);
			if($type < 1 && $type > 7) {
				$globalScript->setModal("Error", "Invalid POST");
				return;
			}
			
			//Will get length if applicable	
			if($type == 1 || $type == 3 || $type == 6) {
				$length = $_POST['length'];
				$length = filter_var($length, FILTER_SANITIZE_NUMBER_INT);
				
				$length_type = $_POST['length_type'];
				$length_type = filter_var($length_type, FILTER_SANITIZE_NUMBER_INT);
				if($length_type < 1 && $length_type > 5) {
					$globalScript->setModal("Error", "Invalid POST");
					return;
				}
			}
      
			//Will get reason and check length
			$reason = $_POST['reason'];
			$reason = filter_var($reason, FILTER_SANITIZE_STRING);
			if(strlen($reason) <= 3 || strlen($reason) >= 255) {
				$globalScript->setModal("Error", "Ban Reason must be more than 3 characters and less than 255");
				return;
			}
			
			//Will store proof as md5 proof			
			if(!empty($_POST['proof']) && isset($_POST['proof'])) {
				$proof = $_POST['proof'];
				$proof = filter_var($proof, FILTER_SANITIZE_URL);
			} else {
				$globalScript->setModal("Error", "Please provide proof");
				return;
			}
			
			//Gets ban date
			if(!empty($_POST['date'])) {
				$logdate = $_POST['date'];
				$logdate = filter_var($logdate, FILTER_SANITIZE_STRING);
				$logdate = strtotime($logdate);
			} else {
				$globalScript->setModal("Error", "Please fill in a log date");
				return;
			}						
			
			$buildArray = array(
				"logID" => $logID,
				"uuid" => $uuid,
				"type" => $type,
				"length" => isset($length) ? $length : null,
				"length_type" => isset($length_type) ? $length_type : null,
				"reason" => $reason,
				"proof" => $proof,
				"date" => $logdate,
				"loggedby" => $_SESSION['MEMBER']['uuid']
			);
			
			$database->insert('userlog', $buildArray);			
			$globalScript->setModal("Success", "Your proof has been submitted");
			Header("Location: /admin/log");
		}