<?php

  Namespace CapeCraft\Controllers;

  use \CapeCraft\Controllers\Controller;
  use \CapeCraft\System\Settings;
  use \PHPMailer\PHPMailer\PHPMailer;
  use \PHPMailer\PHPMailer\Exception;
  use \ReCaptcha\ReCaptcha;

  class UnbanController extends Controller {

    /**
     * Shows the unban form
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
    public static function getUnban($request, $response, $args) {
      return self::getView()->render($response, 'Pages/unban.twig', [
        'siteKey' => getEnv('SITE_KEY')
      ]);
    }

    /**
     * Handles the unban request
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  Array $args        Args from the URL (If any)
     * @return Twig               Returns the View
     */
    public static function doUnban($request, $response, $args) {

      //Gets recaptcha response
      $recaptcha = new ReCaptcha(getenv('SECRET_KEY'));
      if(isset($request->getParsedBody()['g-recaptcha-response'])) {
        $resp = $recaptcha->verify($request->getParsedBody()['g-recaptcha-response'], Settings::getClientIP());
      } else {
        $resp = false;
      }

      //Gets post data as variables
      $username = filter_var($request->getParsedBody()['username'], FILTER_SANITIZE_STRING);
      $email = $request->getParsedBody()['email'];
      $cemail = $request->getParsedBody()['cemail'];
      $beforeban = filter_var($request->getParsedBody()['beforeban'], FILTER_SANITIZE_STRING);
      $whyunban = filter_var($request->getParsedBody()['whyunban'], FILTER_SANITIZE_STRING);
      $whatdifferent = filter_var($request->getParsedBody()['whatdifferent'], FILTER_SANITIZE_STRING);
      $confirmunban = isset($request->getParsedBody()['confirmunban']);

      //Check if any values are empty, if emails match and checks the checkbox/recaptcha has been done
      if(empty($username) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || $email !== $cemail || empty($beforeban) || empty($whyunban) || empty($whatdifferent) || !$confirmunban || ($resp == false || !$resp->isSuccess())) {
        return self::getView()->render($response, 'Pages/unban.twig', [
          'siteKey' => getEnv('SITE_KEY'),
          'error' => true,
          'post' => $request->getParsedBody()
        ]);
      }
    
      //Return invalid username if wrong and add warning that already submitted ban

      $subject = "$username - Unban Request";
			$body = "
			<table>
				<tr>
					<th>Username</th>
				</tr>
				<tr>
					<td>$username</td>
				</tr>
			</table>
			<strong>What happened before you was banned?</strong>
			<p>$beforeban</p>
      <strong>Why should we unban you</strong>
      <p>$whyunban</p>
			<strong>What will you do to avoid being banned again?</strong>
			<p>$whatdifferent</p>
			";

      $mail = new PHPMailer(true);

      try {
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 0; //2 for logging
        $mail->IsSMTP();
        $mail->Host = getenv('MAIL_HOST');
        $mail->SMTPAuth = true;
        $mail->Username = getenv('MAIL_USERNAME');
        $mail->Password = getenv('MAIL_PASSWORD');
        $mail->SMTPSecure = getenv('MAIL_ENCRYPTION');
        $mail->Port = getenv('MAIL_PORT');
        $mail->setFrom(getenv('MAIL_FROM_ADDRESS'), getEnv('MAIL_FROM_NAME'));
        $mail->addReplyTo($email, $username);
        $mail->addAddress(getenv('MAIL_TO'), getenv('MAIL_TO_NAME'));
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->send();
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }

      return self::getView()->render($response, 'Pages/admin/error.twig', [
        'error' => [
          'title' => "Thank You!",
          'msg' => "Your unban request has been submitted and will be reviewed by a senior member of staff. Please refrain from asking about your unban request on any CapeCraft platforms.</br>If you have any further questions, please direct them to <a href=\"mailto:staff@capecraft.net\">staff@capecraft.net</a>"
        ]
      ]);
    }

  }
