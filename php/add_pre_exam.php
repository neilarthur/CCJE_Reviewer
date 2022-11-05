<?php

require("../PHPMailer-master/src/Exception.php");
require("../PHPMailer-master/src/PHPMailer.php");
require("../PHPMailer-master/src/SMTP.php");



require_once 'conn.php';

if (isset($_POST['create'])) {

	$descript = $_POST['description'];
	$subjects_name = $_POST['subjects'];
	$levels = $_POST['difficult'];
	$limit = $_POST['time_limit'];
	$question_no = $_POST['t_question'];
	$access = $_POST['access_code'];
	$checkbox1 = $_POST['chkl'];
	$prepared_by = $_POST['prepared_by'];
	$status = "pending";

	

	$sacs = mysqli_query($sqlcon,"SELECT email_address FROM accounts WHERE role = 'student'");

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

	//send the message, check for errors
	if (!$mail->send()) {
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} 
	else {

		$sql = "INSERT INTO tbl_pre_question (description,subjects,levels_name,time_limit,total_question,sum_question,access_code,prepared_by,pre_board_status) VALUES ('$descript','$subjects_name','$levels','$limit','$question_no','$question_no','$access','$prepared_by','$status')";
		$sql_runs=mysqli_query($sqlcon, $sql);
		$lastid = mysqli_insert_id($sqlcon);

		if($sql_runs) {
			for ($i=0; $i <sizeof($checkbox1); $i++) {
				$query = "INSERT INTO tbl_pre_choose_quest(question_id,pre_exam_id)  VALUES ('".$checkbox1[$i]."','$lastid')";
				mysqli_query($sqlcon,$query) or die (mysqli_error($sqlcon));
			}
			header("location:../faculty/preboard.php?examsuccess");
		}
		else {
			header("location:../faculty/preboard.php?examerror");
		}   
	}	
}
?>