<?php

require_once 'conn.php';

if (isset($_POST["create"])) {

	$title = $_POST['title'];
	$des = $_POST['description'];
	$sec = $_POST['class_section'];
	$type =$_POST['type_exam'];
	$subject_exams = $_POST['subjects'];
	$level_difficulty = $_POST['difficult'];
	$question_title = $_POST['t_question'];
	$limit = $_POST['time_limit'];
	$prep = $_POST['prepared_by'];
	$start_time = $_POST['start_time'];
	$close_time = $_POST['close_time'];
	$history_acc = $_POST['history_acc'];
	$acs = "Added an quiz";
	$acs2 = "posted a quiz";
	$not_stat = 0;

	$stat_question = "No question";

	$sql_run = "INSERT INTO choose_question (description,quiz_title,section,type_test,subject_name,question_difficulty,question_prev,total_quest,time_limit,start_day,end_day,prepared_by,stat_question)VALUES('$des','$title','$sec','$type','$subject_exams','$level_difficulty','$question_title','$question_title','$limit','$start_time','$close_time','$prep','$stat_question')";

  
	$sql_rows = mysqli_query($sqlcon, $sql_run); 


	if ($sql_rows) {
		$id = mysqli_insert_id($sqlcon);
		$history = "INSERT INTO logs(acc_id,login_time,action) VALUES ('$history_acc',now(),'$acs')";
		$logs_history = mysqli_query($sqlcon,$history);

		if ($logs_history) {
			$geh = "INSERT INTO tbl_notification(action,acc_id,notif_status,section_notif,test_id) VALUES('$acs2','$prep','$notif_stat','$sec','$id')";
			$query = mysqli_query($sqlcon,$geh);
			if ($query) {
				header("Location:../faculty/testyourself.php?testsuccess");
			}else{
				header("location: ../faculty/testyourself.php?testerror");
			}
			
		}
		else {
			
			header("location: ../faculty/testyourself.php?testerror");
		}
	}
	else {

		header("location: ../faculty/testyourself.php?testerror");
	}
}

?>