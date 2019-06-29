<?php

  Namespace CapeCraft\Controllers;

  use \CapeCraft\Controllers\Controller;
  use \CapeCraft\System\Settings;
  use \CapeCraft\Helpers\MojangAPI;
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
      $recaptchaResponse = isset($request->getParsedBody()['g-recaptcha-response']) ? $recaptcha->verify($request->getParsedBody()['g-recaptcha-response'], Settings::getClientIP()) : false;
      if($recaptchaResponse == null || !$recaptchaResponse) {
        return self::showFailedUnban($request, $response, "Please confirm the ReCaptcha!");
      }

      //Checks the username is valid
      $username = filter_var($request->getParsedBody()['username'], FILTER_SANITIZE_STRING);
      if(empty($username) || MojangAPI::getUUID($username) == null) {
        return self::showFailedUnban($request, $response, "That username is not valid!");
      }

      //Checks the email is valid
      $email = $request->getParsedBody()['email'];
      $cemail = $request->getParsedBody()['cemail'];
      if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || $email !== $cemail) {
        return self::showFailedUnban($request, $response, "Please check that email and make sure they match!");
      }

      //Check lenghth of large text areas
      $beforeban = filter_var($request->getParsedBody()['beforeban'], FILTER_SANITIZE_STRING);
      $whyunban = filter_var($request->getParsedBody()['whyunban'], FILTER_SANITIZE_STRING);
      $whatdifferent = filter_var($request->getParsedBody()['whatdifferent'], FILTER_SANITIZE_STRING);
      if(empty($beforeban) || empty($whyunban) || empty($whatdifferent)) {
        return self::showFailedUnban($request, $response, "Please fill in all the boxes!");

        if(strlen($beforeban) < 25 || strlen($whyunban) < 25 || strlen($whatdifferent) < 25) {
          return self::showFailedUnban($request, $response, "Your responses must be ATLEAST 25 characters!");
        }

        if(strlen($beforeban) > 1500 || strlen($whyunban) > 15000 || strlen($whatdifferent) > 1500) {
          return self::showFailedUnban($request, $response, "Your responses can not be more than 1500 characters");
        }
      }

      $confirmunban = isset($request->getParsedBody()['confirmunban']);
      if(!$confirmunban) {
        return self::showFailedUnban($request, $response, "Please check the confirmation box");
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

    /**
     * Shows a failed unban with error
     * @param  Request $request   The Request Object
     * @param  Response $response The Response Object
     * @param  String $error      The error message
     * @return Twig               Returns the View
     */
    private static function showFailedUnban($request, $response, $error) {
      return self::getView()->render($response, 'Pages/unban.twig', [
        'siteKey' => getEnv('SITE_KEY'),
        'error' => $error,
        'post' => $request->getParsedBody()
      ]);
    }
  }
