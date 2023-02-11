<?php

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

	$acts = "added an exam ";

	$sta = 0;

	$pre_exam_insert = "INSERT INTO tbl_pre_question(description,subjects,time_limit,total_question,sum_question,access_code,start_date,end_date,prepared_by,pre_board_status)VALUES('$description','$area_exam','$time_limit','$total_quest','$total_quest','$access_code','$start_d','$end_d','$prepared_by','$status')";

	$query_pre_exam = mysqli_query($sqlcon,$pre_exam_insert);

	if ($query_pre_exam) {

		$logs_run = "INSERT INTO logs(acc_id,login_time,action) VALUES ('$acc_ids',now(),'$acts')";
		$logs_query = mysqli_query($sqlcon,$logs_run);

		if ($logs_query) {

			$notif = "INSERT INTO tbl_notification(action,acc_id,date_created,notif_status)VALUES('$acts','$acc_ids',now(),'$sta')";

			$notif_query = mysqli_query($sqlcon,$notif);

			if ($notif_query) {

				header("location: ../faculty/preboard.php");
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
?>