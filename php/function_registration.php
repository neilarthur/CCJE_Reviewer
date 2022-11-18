<?php

session_start();

require_once 'conn.php';

require("../PHPMailer-master/src/Exception.php");
require("../PHPMailer-master/src/PHPMailer.php");
require("../PHPMailer-master/src/SMTP.php");

function sendmail_verify($f_name,$email_ad,$verification_code) {

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

	$mail->Subject ="Email Verification from CCJELSPU";

	$email_template="
	<h2> You have to registerd with lspu</h2>
	<h5>Verify your email address to login with the below given link</h5>
	<br><br>
	<a href='http://localhost/CCJE_Reviewer/php/verify.php?verified=$verification_code'>Click Me</a>
	";


	//Set the subject line
	$mail->Subject = "CCJELSPU BOARD EXAMINATION LICENSURE";
	$mail->Body = $email_template;

	$mail->send();
}


if (isset($_POST['register'])) {


	$email_ad = $_POST['email_ad'];
	$u_name = $_POST['u_name'];
	$pass_word = $_POST['pass_word'];
	$conf_password = $_POST['conf_pass'];
	$f_name = $_POST['f_name'];
	$m_name = $_POST['m_name'];
	$l_name = $_POST['l_name'];
	$age = $_POST['age'];
	$date_birth = $_POST['date_birth'];
	$role = $_POST['role'];
	$section = $_POST['section'];
	$gender = $_POST['gender'];
	$contact_no = $_POST['contact_no'];
	$address = $_POST['address'];
	$image_upload =$_FILES['image']['name'];
	$verification_code = md5(rand());
	$year = "4th year";
	$status = "active";


	$image_Data =addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$image_type =$_FILES['image']['type'];

	if (substr($image_type,0,5)=="image") {
		
		$check_query = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE email_address ='$email_ad'");

		if (mysqli_num_rows($check_query) > 0) {

			echo mysqli_error($sqlcon);
		}
		else {

			if ($pass_word == $conf_password) {

				$insert_query = "INSERT INTO accounts(first_name,user_id,middle_name,last_name,role,birth_date,age,gender,year,section,email_address,mobile_no,address,image,image_size,password,verification_code,status) VALUES('$f_name','$u_name','$m_name','$l_name','$role','$date_birth','$age','$gender','$year','$section','$email_ad','$contact_no','$address','$image_upload','$image_Data','$pass_word','$verification_code','$status')";

				$query_run = mysqli_query($sqlcon,$insert_query);

				if ($query_run) {
					
					sendmail_verify("$f_name","$email_ad","$verification_code");

					header("location:registration.php");
				}
				else{

					echo mysqli_error($sqlcon);
				}
			}
			else{

				echo mysqli_error($sqlcon);
			}

				
		}
	}
}

?>