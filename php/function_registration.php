<?php

session_start();

require_once 'conn.php';

require("../PHPMailer-master/src/Exception.php");
require("../PHPMailer-master/src/PHPMailer.php");
require("../PHPMailer-master/src/SMTP.php");

function sendmail_verify($f_name,$email_ad,$verify_status) {

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
	$mail->setFrom('donotreply@gmail.com',$f_name);

	//Set an alternative reply-to address
	//This is a good place to put user-submitted addresses
	$mail->addReplyTo('ralphvincent.p11@gmail.com', 'CCJELSPU');

	$mail->addAddress($email_ad);

	$mail->isHTML(true);

	$mail->Subject ="Email Verification from CCJELSPU";

  //Set the subject line
  $mail->Subject = "CCJE LSPU BOARD EXAMINATION LICENSURE";
  $mail->Body ="<html>
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
                        <h1 style='font-weight: bold;color: #000000;font-family: sans-serif;line-height: 1.4;margin: 0;margin-bottom: 30px;font-size: 35px;text-align: center;text-transform: capitalize;'>Welcome to CCJE Automated Licensure Reviewer</h1>
                        <p style='font-family: sans-serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;'>Hello there,</p>
                        <p style='justify-content: justify;font-family: sans-serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;'>You're receiving this message because you recently signed up your account.</p>
                        <p style='justify-content: justify;font-family: sans-serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;'>Please confirm your email address by clicking the button below. This step adds</p>
                        <p style='justify-content: justify;font-family: sans-serif;font-size: 14px;font-weight: normal;margin: 0;margin-bottom: 15px;'>extra security to your account by verifying you own this email.</p>
                        <table style='margin-top: 50px;margin-bottom: 50px;border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;box-sizing: border-box;'>
                          <tbody>
                            <tr>
                              <td align='center' style='font-family: sans-serif;font-size: 14px;vertical-align: top;padding-bottom: 15px;'>
                                <table style='border-collapse: separate;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: auto;'>
                                  <tbody>
                                    <tr>
                                      <td style='text-align: center;font-family: sans-serif;font-size: 14px;vertical-align: top;background-color: #3498db;border-radius: 5px;'> <a href='http://localhost/CCJE_Reviewer/php/index.php?verifiedsucc&verified=$verify_status&email=$email_ad'  style='color: #ffffff;text-decoration: none;background-color: #3498db;border: solid 1px #3498db;border-radius: 5px;box-sizing: border-box;cursor: pointer;display: inline-block;font-size: 14px;font-weight: bold;margin: 0;padding: 12px 25px;text-transform: capitalize;border-color: #3498db;'>Confirm Email</a> </td>
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
	$role = "student";
	$section = $_POST['section'];
	$gender = $_POST['gender'];
	$contact_no = $_POST['contact_no'];
	$address = $_POST['address'];
	$image_upload =$_FILES['image']['name'];

	$year = "4th year";
	$status = "pending";
	$verify_status="not verified";

	$image_Data =addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$image_type =$_FILES['image']['type'];

	if (substr($image_type,0,5)=="image") {
		
		$check_query = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE email_address ='$email_ad'");

		if (mysqli_num_rows($check_query) > 0) {

			echo "EMAIL IS ALREADY BEEN TAKEN";
		}
		else {

			if ($pass_word == $conf_password) {


				$insert_query = "INSERT INTO accounts(first_name,user_id,middle_name,last_name,role,birth_date,age,gender,year,section,email_address,mobile_no,address,image,image_size,password,status,verify_status) VALUES('$f_name','$u_name','$m_name','$l_name','$role','$date_birth','$age','$gender','$year','$section','$email_ad','$contact_no','$address','$image_upload','$image_Data','$pass_word','$status','$verify_status')";

				$query_run = mysqli_query($sqlcon,$insert_query);

				if ($query_run) {
					
					sendmail_verify("$f_name","$email_ad","$verify_status");

					header("location:index.php?registersucc");
				}
				else{

					header("location:index.php?regerror");
				}
			}
			else {

				header("location:index.php?passerror");
			}	
		}
	}
	else {

		echo mysqli_error($sqlcon);
	}
}

?>