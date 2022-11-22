<?php

session_start();

require_once'conn.php';

require("../PHPMailer-master/src/Exception.php");
require("../PHPMailer-master/src/PHPMailer.php");
require("../PHPMailer-master/src/SMTP.php");



function resend_email($f_name,$email_ad,$verification_code){
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
	$mail->setFrom('donotreply@gmail.com',$f_name);

	//Set an alternative reply-to address
	//This is a good place to put user-submitted addresses
	$mail->addReplyTo('ralphvincent.p11@gmail.com', 'CCJELSPU');

	$mail->addAddress($email_ad);

	$mail->isHTML(true);

	$mail->Subject ="Resend Email Verification from CCJELSPU";

	$email_template="
	<h2> You have to registerd with lspu</h2>
	<h5>Verify your email address to login with the below given link</h5>
	<br><br>
	<a href='http://localhost/CCJE_Reviewer/php/index.php?verified=$verification_code'>Click Me</a>
	";


	//Set the subject line
	$mail->Subject = "CCJELSPU BOARD EXAMINATION LICENSURE";
	$mail->Body = $email_template;

	$mail->send();
}

if (isset($_POST['resend_email_btn'])) {

	$email_ad = $_POST['email_address'];


	$check_mail_query = "SELECT * FROM accounts WHERE email_address='$email_ad'";

	$check_mail_run = mysqli_query($sqlcon,$check_mail_query);


	if (mysqli_num_rows($check_mail_run) >0) {

		$rows = mysqli_fetch_array($check_mail_run);

		if ($rows['verify_status']=='0') {

			$f_name = $rows['first_name'];
			$email_ad = $rows['email_address'];
			$verification_code = $rows['verification_code'];


			resend_email($f_name,$email_ad,$verification_code);

			header("Location: email_resend.php?loginsuccess");
		}
		else {

			header("Location:email_resend.php?loginerror");			
		}
	}
	else{

		header("Location:email_resend.php?loginerror");
	}

}
?>