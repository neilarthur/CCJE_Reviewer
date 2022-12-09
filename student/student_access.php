<?php

require_once '../php/conn.php';

if (isset($_POST['save'])) {
	
	$access = $_POST['access_code'];
	$acc_id = $_POST['acc_id'];
	$pre_exam = $_POST['pre_exam'];


	$code = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question WHERE access_code='$access'");
	
	$user_matched = mysqli_num_rows($code);

	if ($user_matched >0) {

		$insert_done = "INSERT INTO tbl_pre_marks_done (acc_id,pre_exam_id) VALUES ('$acc_id','$pre_exam')";
		$insert_query = mysqli_query($sqlcon,$insert_done);

		if ($insert_query) {

			header("location:preboard.php?code=$access&acc_id=$acc_id");	
		}
		else {

			echo mysqli_error($sqlcon);
		}
	}
	else{
		header("location:dashboard.php?error=Incorrect Access Code");
	}
}
?>