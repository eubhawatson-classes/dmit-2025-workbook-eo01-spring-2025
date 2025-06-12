<?php
$validation = "";
// can give relative or absolute path

require "/home/vwatson/public_html/PHPMailer-master/src/Exception.php";
require "/home/vwatson/public_html/PHPMailer-master/src/PHPMailer.php";
require "/home/vwatson/public_html/PHPMailer-master/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function clean_input($input)
{
	$input = trim($input);
	$input = filter_var($input, FILTER_SANITIZE_STRING);
	return $input;
}

if (isset($_POST['send'])) {
	$name = clean_input($_POST['name']);
	$email = clean_input($_POST['email']);
	$message = clean_input($_POST['message']);
	$is_form_valid = TRUE;

	// please do more!!!!!!

	if (!$name || !$email || !$message) {
		$is_form_valid = false;
		$validation .= "Please fill out all fields.";
	}

	$badStrings = array(
		"Content-Type:",
		"MIME-Version:",
		"Content-Transfer-Encoding:",
		"bcc:",
		"cc:"
	);
	foreach ($_POST as $k => $v) {
		foreach ($badStrings as $v2) {
			if (strpos($v, $v2) !== false) {
				$is_form_valid = false;
				$validation .= "<p>Bad email injector.</p>";
			}
		}
	}
	// $refer = $_SERVER['HTTP_REFERER'];

	if ($is_form_valid == TRUE) {
		$body = "<h2>Hello!</h2>";
		$body .= "<p>We thought you'd like to know that you just received a submission through your web form.</p>";
		$body .= "<p>Name: $name</p>";
		$body .= "<p>Email: $email</p>";
		$body .= "<p>Message: $message</p>";

		$mail = new PHPMailer(true);

		try {
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = 'youremail@address.com';                     //SMTP username
			$mail->Password   = 'yourpasswords';                               //SMTP password
			$mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
			$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			//Recipients
			$mail->setFrom('littlemissevalyn@gmail.com', 'Web Form Submission');
			$mail->addAddress('littlemissevalyn@gmail.com', 'My GMail Account'); //Add a recipient		    
			$mail->addReplyTo($email, $name);
			// $mail->addBCC('bcc@example.com');

			//Attachments
			// $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
			// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

			//Content
			$mail->isHTML(true); //Set email format to HTML
			$mail->Subject = 'New Web Form Submission';
			$mail->Body = $body;
			// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();

			// echo 'Message has been sent';
			header("Location:thank-you.php");

		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
		// header("Location:thank-you.php");
	}
} else {
	$name = $message = $email = "";
}
?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Contact Form</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	</head>

	<body class="d-flex align-items-center justify-content-center min-vh-100">
		<section class="container">
			<div class="row align-items-center">
				<div class="col-md-5">
					<h2 class="display-4 fw-light">We'd love to hear from you!</h2>
					<p class="text-muted">Whether you have a question, comment, or just want to say hello, please don't hesitate to get in touch with us using the form below. Our team will do our best to respond to your message as soon as possible.</p>
				</div>
				<div class="col-md-6 offset-md-1">
					<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
						<?php if (isset($validation)): ?>
							<p class="text-warning">
								<?php echo $validation; ?>
							</p>
						<?php endif ?>

						<div class="mb-3">
							<label for="name" class="form-label">Your Name</label>
							<input type="text" name="name" id="name" value="<?php echo $name; ?>" class="form-control">
						</div>

						<div class="mb-3">
							<label for="email" class="form-label">Email Address</label>
							<input type="text" name="email" id="email" value="<?php echo $email; ?>"
								class="form-control">
						</div>

						<div class="mb-3">
							<label for="message" class="form-label">Message</label>
							<textarea name="message" id="message"
								class="form-control"><?php echo $message; ?></textarea>
						</div>

						<input type="submit" name="send" value="Send Email" class="btn btn-primary">
					</form>
				</div>
			</div>
		</section>
	</body>

</html>