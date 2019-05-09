<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'assets/_server/classes/PHPMailer/Exception.php';
  require 'assets/_server/classes/PHPMailer/PHPMailer.php';
  require 'assets/_server/classes/PHPMailer/SMTP.php';

  $g_captcha_response = null;

  if(isset($_POST["g-recaptcha-response"])) {
    require_once("assets/_server/scripts/recaptchalib.php");
    $reCaptcha = new ReCaptcha($settings->googleRecaptcha(true));
    $g_captcha_response = $reCaptcha->getResult($_POST["g-recaptcha-response"]);
  }

  if(isset($_POST['unbanrequest'])) {
		if($g_captcha_response != null && $g_captcha_response) {
			$username = $globalScript->checkUsername($_POST['username']);
			if($username == null) {
				$globalScript->setModal("Error", "Your username is incorrect<br>" . $modalContent);
				return;
			}
			$uuid = $usernameHandler->getUUID($username);

			if(isset($_POST['email']) && !empty($_POST['email'])) {
				$email = $_POST['email'];
				$email = filter_var($email, FILTER_SANITIZE_EMAIL);
			} else {
				$globalScript->setModal("Error", "Please fill in your email");
				return;
			}

			$bannedby = filter_var($_POST['bannedby'], FILTER_SANITIZE_STRING);
			if(empty($bannedby)) {
				$globalScript->setModal("Error", "Banned by username incorrect<br>" . $modalContent);
				return;
			}

			if(isset($_POST['databanned']) && !empty($_POST['databanned'])) {
				$databanned = $_POST['databanned'];
				$databanned = filter_var($databanned, FILTER_SANITIZE_STRING);
			} else {
				$globalScript->setModal("Error", "Please fill in all the boxes");
				return;
			}

			if(isset($_POST['beforeban']) && !empty($_POST['beforeban'])) {
				$beforeban = $_POST['beforeban'];
				$beforeban = filter_var($beforeban, FILTER_SANITIZE_STRING);
			} else {
				$globalScript->setModal("Error", "Please fill in all the boxes");
				return;
			}

			if(isset($_POST['whyunban']) && !empty($_POST['whyunban'])) {
				$whyunban = $_POST['whyunban'];
				$whyunban = filter_var($whyunban, FILTER_SANITIZE_STRING);
			} else {
				$globalScript->setModal("Error", "Please fill in all the boxes");
				return;
			}

			if(isset($_POST['whatdifferent']) && !empty($_POST['whatdifferent'])) {
				$whatdifferent = $_POST['whatdifferent'];
				$whatdifferent = filter_var($whatdifferent, FILTER_SANITIZE_STRING);
			} else {
				$globalScript->setModal("Error", "Please fill in all the boxes");
				return;
			}

			(isset($_POST['confirmunban'])) ? $confirmunban = true : $confirmunban = false;

			$unbanresult = $database->where('uuid', $uuid)->getOne('unbanrequests');

			if($database->count <= 0) {
				$database->insert('unbanrequests', array('uuid' => $uuid, 'requestsent' => time()));
			} else {
				if(($unbanresult['requestsent'] + 86400) > time()) {
					$globalScript->setModal("Error", "You've already sent an unban request in the last 24 hours. Try again later");
					return;
				} else {
					$database->where('uuid', $uuid)->update('unbanrequests', array('requestsent' => time()));
				}
			}

			if($confirmunban) {
				$subject = $username . " - Unban Request";
				$body = "
				<table>
					<tr>
						<th>Username</th>
						<th>Banned By</th>
						<th>Data Banned</th>
					</tr>
					<tr>
						<td>" . $username . "</td>
						<td>" . $bannedby . "</td>
						<td>" . $databanned . "</td>
					</tr>
				</table>
				<strong>What happened before you was banned?</strong>
				<p>" . $beforeban . "</p>
				<strong>Why should we unban you?</strong>
				<p>" . $whatdifferent . "</p>
				";

        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        if(DEVELOPMENT_MODE) {
          $mail->SMTPDebug = 2;
        } else {
          $mail->SMTPDebug  = 0;
        }

        $mail->IsSMTP();
        $mail->Host = "removed";
        $mail->SMTPAuth = true;
        $mail->Username = "removed";
        $mail->Password = "removed";
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('noreply@capecraft.net', 'CapeCraft');
        $mail->addReplyTo($email, $username);
        $mail->addAddress("staff@capecraft.net", "CapeCraft Staff");

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();

				$globalScript->setModal("Succcess", "Unban Request sent please wait for a reply");
			 } else {
				 $globalScript->setModal("Error", "Please confirm the checkbox");
				 return;
			 }

		} else {
			$globalScript->setModal("Error", "Please check the captcha");
			return;
		}
	}
