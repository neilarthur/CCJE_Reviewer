<?php

session_start();

require("../PHPMailer-master/src/Exception.php");
require("../PHPMailer-master/src/PHPMailer.php");
require("../PHPMailer-master/src/SMTP.php");

include_once '../php/conn.php';


function send_code($access,$sound) {

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
	$mail->setFrom('donotreply@gmail.com','dorenr');

	//Set an alternative reply-to address
	//This is a good place to put user-submitted addresses
	$mail->addReplyTo('ralphvincent.p11@gmail.com', 'CCJELSPU');


	$mail->addAddress($sound);

	$mail->isHTML(true);

	$mail->Subject ="Email Verification from CCJELSPU";

	


	//Set the subject line
	$mail->Subject = "CCJELSPU BOARD EXAMINATION LICENSURE";
	$mail->Body = $access;

	$mail->send();
}

if (isset($_POST['save'])) {

	$update_id = $_POST['update_id'];
	$access = $_POST['access'];
	$status ="Approve";


	$sql_query = "UPDATE tbl_pre_question SET approval='$status' WHERE pre_exam_id ='$update_id'";
	$sql_run = mysqli_query($sqlcon,$sql_query);

	if ($sql_run) {

		$wonder = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE role='student'");

		while ($rows = mysqli_fetch_assoc($wonder)) {
			
			$sound = $rows['email_address']; 

			send_code("$access","$sound");

			header("location: exam-manage.php");
		}
	}
	else{
		echo mysqli_error($sqlcon);
	}
}
elseif (isset($_POST['reject'])) {
	
	$update_id = $_POST['update_id'];
	$status ="Decline";


	$sql_query = "UPDATE tbl_pre_question SET approval='$status' WHERE pre_exam_id ='$update_id'";
	$sql_run = mysqli_query($sqlcon,$sql_query);

	if ($sql_run) {
		
		header("location: exam-manage.php");
	}
	else{
		echo mysqli_error($sqlcon);
	}
}
?>