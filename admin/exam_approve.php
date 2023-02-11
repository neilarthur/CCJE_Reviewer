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

	$mail->SMTPDebug  = false;
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
	$mail->Body = "<html>
  <body style='background-color: #f6f6f6;font-family: sans-serif;-webkit-font-smoothing: antialiased;font-size: 14px;line-height: 1.4;margin: 0;padding: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;'>
    <span style='color: transparent;display: none;height: 0;max-height: 0;max-width: 0;opacity: 0;overflow: hidden;mso-hide: all;visibility: hidden;width: 0;'>This is preheader text. Some clients will show this text as a preview.</span>
    <table style='border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;background-color: #f6f6f6;''>
      <tr>
        <td style='font-family: sans-serif;font-size: 14px;vertical-align: top;'>&nbsp;</td>
        <td  style='font-family: sans-serif;font-size: 14px;vertical-align: top;display: block;max-width: 580px;padding: 10px;width: 580px;margin: 0 auto !important;'>
          <div  style='font-family: sans-serif;font-size: 14px;vertical-align: top;display: block;max-width: 580px;padding: 10px;width: 580px;margin: 0 auto !important;'>

            <!-- START CENTERED WHITE CONTAINER -->
            <table  style='border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;background: #ffffff;border-radius: 3px;'>

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td style='font-family: sans-serif;font-size: 14px;vertical-align: top;box-sizing: border-box;padding: 20px;'>
                  <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;'>
                    <tr>
                      <td style='font-family: sans-serif;font-size: 14px;vertical-align: top;'>
                        <h1 style='font-weight: bold;color: #000000;font-family: sans-serif;line-height: 1.4;margin: 0;margin-bottom: 30px;font-size: 35px;text-align: center;text-transform: capitalize;'>CCJE Automated Licensure Reviewer</h1>
                        <p style='font-family: sans-serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;'>Hello there,</p>
                        <p style='justify-content: justify;font-family: sans-serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;'>You're receiving this message because you are trying to access the examination.</p>
                        <p style='justify-content: justify;font-family: sans-serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;'>Please enter the code below to proceed answering the examination.</p>
                        <p style='justify-content: justify;font-family: sans-serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;'>Thank you! Enjoy answering.</p>
                        <table style='margin-top: 50px;margin-bottom: 50px;border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;box-sizing: border-box;'>
                          <tbody>
                            <tr>
                              <td align='center' style='font-family: sans-serif;font-size: 14px;vertical-align: top;padding-bottom: 15px;'>
                                <table style='border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: auto;'>
                                  <tbody>
                                    <tr>
	                                  <td><p style='font-weight: bold;color: #000000;font-family: sans-serif;line-height: 1.4;margin: 0;margin-bottom: 10px; font-size:25px;text-align: center;'>Access Code:</p></td>
	                                  </tr>
                                    <tr>
                                      <td><h3 style='font-weight: bold;color: #000000;font-family: sans-serif;line-height: 1.4;margin: 0;margin-bottom: 30px;font-size: 35px;text-align: center;'>$access</h3></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>
            <!-- END CENTERED WHITE CONTAINER -->

            <!-- START FOOTER -->
            <div class='footer' style='clear: both;margin-top: 10px;text-align: center;width: 100%;'>
              <table style='border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;'>
                <tr>
                  <td  style='font-family: sans-serif;font-size: 12px;vertical-align: top;padding-bottom: 10px;padding-top: 10px;color: #999999;text-align: center;'>
                    <span class='apple-link' style='color: #999999;font-size: 12px;text-align: center;'> © 2022 Copyright: College of Criminal Justice and Education LSPU Sta. Cruz Campus</span>
                    <br> Ask further question message me at <a style='color: #999999;text-decoration: underline;font-size: 12px;text-align: center;'>marklito.repugia@lspu.edu.ph</a>.
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->

          </div>
        </td>
        <td style='font-family: sans-serif;font-size: 14px;vertical-align: top;'>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>";

	$mail->send();
}

if (isset($_POST['save'])) {

	$update_id = $_POST['update_id'];
	$access = $_POST['access'];
	$status ="approve";
	$act = "posted an exam.";
	$act2 = " has been approved.";

	$sql_query = "UPDATE tbl_pre_question SET approval='$status' WHERE pre_exam_id ='$update_id'";
	$sql_run = mysqli_query($sqlcon,$sql_query);


	if ($sql_run) {


		$local = "INSERT INTO tbl_notification(action,acc_id,notif_status) VALUES ('$act','$prepared_by','$act_stat')";
		$base = mysqli_query($sqlcon,$local);

		if ($base) {


			$let = "INSERT INTO tbl_notification (action,acc_id,notif_status) VALUES ('$act2','$prepared_by','$act_stat')";

			$let_query = mysqli_query($sqlcon,$let);


			if ($let_query) {
				
				$wonder = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE role='student'");

				while ($rows = mysqli_fetch_assoc($wonder)) {
					
					$sound = $rows['email_address']; 

					send_code("$access","$sound");

					header("location: exam-manage.php");
				}
			}
			else {

				echo mysqli_error($sqlcon);
			}
		}
		else {

			echo mysqli_error($sqlcon);
		}
	}
	else{
		echo mysqli_error($sqlcon);
	}
}


elseif (isset($_POST['reject'])) {

	$comment = $_POST['comment'];
	$basic = $_SESSION['acc_id'];
	$act_stat2 = 0;

	$borders = "decline";
	$update_ids = $_POST['update_id'];


	$sql_query = "INSERT INTO tbl_notification (action,acc_id,notif_status) VALUES ('$comment','$basic','$act_stat2')";
	$sql_run = mysqli_query($sqlcon,$sql_query);

	if ($sql_run) {
		
		$sql_query2 = "UPDATE tbl_pre_question SET Approval='$borders' WHERE pre_exam_id = '$update_ids'";
		$sql_run2 = mysqli_query($sqlcon,$sql_query2);

		if ($sql_run2) {
			
			header("location: exam-manage.php");
		}
		else {

			echo mysqli_error($sqlcon);
		}
		
	}
	else{
		echo mysqli_error($sqlcon);
	}
}
?>