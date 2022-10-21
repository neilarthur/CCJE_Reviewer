<?php

session_start();

require_once '../php/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $update_id = $_POST['update_id'];
  $update = $_POST['update_acc_id'];
  $status = "done";
  $subj_name = $_POST['subjectas'];

  $pass = 75;


  if (!empty($_POST['quizcheck'])) {


    $count = count($_POST['quizcheck']);

    #loop to store  and display values in individual checked

    $result = 0;
    $i = 1;
    $selected = $_POST['quizcheck'];

    #print_r($selected);

    $q = "SELECT * FROM test_question,student_choice WHERE (test_question.question_id=student_choice.question_id) AND test_id = '$update_id'";
    $query = mysqli_query($sqlcon, $q);

    while ($rows = mysqli_fetch_array($query)) {

      $mate = $rows['total_quest'];
      $rate = $rows['passing_rate'];

      $checked = $rows['correct_ans'] == $selected[$i];

      if ($checked) {

        $result++;

      }
      else{

      }

      $i++;
    }
    $base = mysqli_query($sqlcon,"SELECT * FROM choose_question WHERE test_id = '$update_id'");
    $lack = mysqli_fetch_assoc($base);

    $basket = $lack['question_prev'];
    $bask = $lack['question_no'];
    $tots = $basket + $bask;
    $remark = $result * $tots/100;
    $percentage = $result/$tots * 100;


    if ($percentage >= $pass) {
      echo $remarks = "passed";
    }
    else {
      echo $remarks = "failed";
    }



    $nad = "UPDATE accounts SET take_exam = '$status' WHERE acc_id = '$update'";
    $tac = mysqli_query($sqlcon,$nad);

    

    
    $finalresult = "INSERT INTO tbl_quiz_result(acc_id,test_id,score,score_percent,attempt,result,res_status)VALUES('$update','$update_id','$result','$percentage','$tots','$remarks','$status')";
    $res = mysqli_query($sqlcon,$finalresult);
    $lastid = mysqli_insert_id($sqlcon); 

    if ($res) {

      for ($c=1; $c <= sizeof($selected); $c++) {
        $querys = "INSERT INTO tbl_student_answer(quiz_check,test_id,ans_id)  VALUES ('".$selected[$c]."','$update_id','$lastid')";
        mysqli_query($sqlcon,$querys);
      }
      header("Location:result.php?update_id");
    }

    else{

      mysqli_error($sqlcon);
    }


    $sacs = mysqli_query($sqlcon,"SELECT email_address FROM accounts WHERE role = 'student' AND acc_id ='$update'");

    while ($gow = mysqli_fetch_array($sacs)) {
      $stud = $gow['email_address'];

    }
    # EMAIL  eto i lilipat ko sa kabila 
    #send email

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
    $mail->addAddress($stud);

    //Set the subject line
    $mail->Subject = "Score Released:CCJE:".$_POST['subjectas'];
    $mail->Body = "Your score is ".$result;


    //Replace the plain text body with one created manually
    $mail->AltBody = 'This is a plain-text message body';


    if (!$mail->send()) {

      echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    else{

       echo 'Mailer success';
    }
  }

  if (empty($_POST['quizcheck'])) {

    $counts = count($_POST['quizcheck']);

    $resulted = 0;
    $e = 1;
    $select = $_POST['quizcheck'];

    $querys = "SELECT * FROM test_question,student_choice WHERE (test_question.question_id=student_choice.question_id) AND test_id = '$update_id'";
    $querd = mysqli_query($sqlcon, $querys);

    while ($laws = mysqli_fetch_array($querd)) {

      $checker = $laws['correct_ans'] == $select[$e];

      if ($checker) {
        
        $resulted++;
      }
      else{

      }
      $e++;
    }

    $base = mysqli_query($sqlcon,"SELECT * FROM choose_question WHERE test_id = '$update_id'");
    $lack = mysqli_fetch_assoc($base);

    $basket = $lack['question_prev'];
    $bask = $lack['question_no'];
    $tots = $basket + $bask;
    $remark = $resulted * $tots/100;
    $percentage = $resulted/$tots * 100;

    if ($percentage >= $pass) {
      echo $remarked = "passed";
    }
    elseif ($percentage >= 0) {
      echo $remarked ="failed";
    }

    else {
      echo $remarked = "failed";
    }

  

    $finaltotal = "INSERT INTO tbl_quiz_result(acc_id,test_id,score,score_percent,attempt,result)VALUES('$update','$update_id','$resulted','$percentages','$tots','$remarked')";
    $res = mysqli_query($sqlcon,$finaltotal);
    $last = mysqli_insert_id($sqlcon); 

    if ($res) {

      for ($a=1; $a <= sizeof($select); $a++) {
        $queryss = "INSERT INTO tbl_student_answer(quiz_check,test_id,ans_id)  VALUES ('".$select[$a]."','$update_id','$last')";
        mysqli_query($sqlcon,$queryss);
      }
      header("Location:result.php?update_id");
    }

    else{

      mysqli_error($sqlcon);
    }
  }
}
?>