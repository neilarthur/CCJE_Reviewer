<?php

require("../PHPMailer-master/src/Exception.php");
require("../PHPMailer-master/src/PHPMailer.php");
require("../PHPMailer-master/src/SMTP.php");

require_once 'conn.php';


if (isset($_POST['create'])) {

	$description = $_POST['description'];
	$area_exam = $_POST['subjects'];
	$total_quest = $_POST['t_question'];
	$time_limit = $_POST['time_limit'];
	$start_d = $_POST['start_d'];
	$end_d = $_POST['end_d'];
	$prepared_by = $_POST['prepared_by'];
	$access_code = $_POST['access_code'];
	$approval="Pending";
	$status = "active";

	$acc_ids = $_POST['acc_ids'];

	$acts = " Added an exam ";

	$sacs = mysqli_query($sqlcon,"SELECT email_address FROM accounts WHERE role ='student'");

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
	$mail->setFrom('donotreply@gmail.com', 'CCJELSPU');

	//Set an alternative reply-to address
	//This is a good place to put user-submitted addresses
	$mail->addReplyTo('ralphvincent.p11@gmail.com', 'CCJELSPU');

	//Set who the message is to be sent to

	while ($rows = mysqli_fetch_assoc($sacs)) {
		
		$stud = $rows['email_address'];

		$mail->addAddress($stud);
	}


	//Set the subject line
	$mail->Subject = "CCJELSPU BOARD EXAMINATION LICENSURE";
	$mail->Body = $_POST['access_code'];


	//Replace the plain text body with one created manually
	$mail->AltBody = 'This is a plain-text message body';

	if (!$mail ->send()) {
		
		echo 'Mailer Error:' .$mail->ErrorInfo;

	}
	else {

		$pre_exam_insert = "INSERT INTO tbl_pre_question(description,subjects,time_limit,total_question,sum_question,access_code,start_date,end_date,prepared_by,pre_board_status)VALUES('$description','$area_exam','$time_limit','$total_quest','$total_quest','$access_code','$start_d','$end_d','$prepared_by','$status')";

		$query_pre_exam = mysqli_query($sqlcon,$pre_exam_insert);

		if ($query_pre_exam) {


			$logs_run = "INSERT INTO logs(acc_id,login_time,action) VALUES ('$acc_ids',now(),'$acts')";
			$logs_query = mysqli_query($sqlcon,$logs_run);

			if ($logs_query) {

				header("location: ../faculty/preboard.php");
			}
			else {

				echo mysqli_error($sqlcon);
			}
		}
		else{

			echo mysqli_error($sqlcon);	
		}
	}
}
?>