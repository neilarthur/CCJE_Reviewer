<?php

session_start();

require_once 'conn.php';

require("../PHPMailer-master/src/Exception.php");
require("../PHPMailer-master/src/PHPMailer.php");
require("../PHPMailer-master/src/SMTP.php");


function send_pass_reset($fname,$lname,$email) {
	$mail = new PHPMailer\PHPMailer\PHPMailer();

	//Tell PHPMailer to use SMTP
	$mail->isSMTP();
		
	//Enable SMTP debugging
	//SMTP::DEBUG_OFF = off (for production use)
	//SMTP::DEBUG_CLIENT = client messages
	//SMTP::DEBUG_SERVER = client and server messages
		
	//Set the hostname of the mail server
	$mail->Host = 'smtp.gmail.com';

	$mail->SMTPDebug  = 1;
	//Use `$mail->Host = gethostbyname('smtp.gmail.com');`
	//if your network does not support SMTP over IPv6,
	//though this may cause issues with TLS

	//Set the SMTP port number:
	// - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
	// - 587 for SMTP+STARTTLS
	$mail->Port = 465;

	//Set the encryption mechanism to use:
	// - SMTPS (implicit TLS on port 465) or
	// - STARTTLS (explicit TLS on port 587)
	$mail->SMTPSecure = 'ssl';

	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;

	$mail->SMTPOptions = array(
	'ssl' => array(
	'verify_peer' => false,
	'verify_peer_name' => false,
	'allow_self_signed' => true
	)
	);

	//Username to use for SMTP authentication - use full email address for gmail
	$mail->Username = 'ralphvincent.p11@gmail.com';

	//Password to use for SMTP authentication
	$mail->Password = 'phbaqvzqfeuhpztr';

	//Set who the message is to be sent from
	//Note that with gmail you can only use your account address (same as `Username`)
	//or predefined aliases that you have configured within your account.
	//Do not use user-submitted addresses in here
	$mail->setFrom('donotreply@gmail.com',$fname." ".$lname);

	//Set an alternative reply-to address
	//This is a good place to put user-submitted addresses
	$mail->addReplyTo('ralphvincent.p11@gmail.com', 'CCJELSPU');

	$mail->addAddress($email);

	$mail->isHTML(true);

	$mail->Subject ="Reset Password Confirmation From CCJELSPU";

	$email_template="
	<h5>You are receive this email because we receive a password a password reset request for your account.</h5>
	<br><br>
	<a href='http://localhost/CCJE_Reviewer/php/for_pass_reset.php?&email=$email'>Click Me</a>
	";


	//Set the subject line
	$mail->Subject = "CCJELSPU BOARD EXAMINATION LICENSURE";
	$mail->Body = $email_template;

	$mail->send();
}


if (isset($_POST['reset_pass'])) {

	$email_add = $_POST['email_address'];
	$tokens = "active";


	$validate_email = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE email_address='$email_add'");

	if (mysqli_num_rows($validate_email) > 0) {

		$row=mysqli_fetch_array($validate_email);
		$fname = $row['first_name'];
		$lname = $row['last_name'];
		$email = $row['email_address'];

		send_pass_reset($fname,$lname,$email);

		$_SESSION['status']="Please check your Email address.";
		header("location:forgot-pass.php");
		exit(0);
	}
	else {

		$_SESSION['status_1']="Your Email Address are incorrect please try again ";
		header("location: forget-pass.php");
		exit(0);
	}
}


?>