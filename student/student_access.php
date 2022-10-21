<?php

require_once '../php/conn.php';

if (isset($_POST['save'])) {
	
	$access = $_POST['access_code'];
	$acc_id = $_POST['acc_id'];


	$code = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question WHERE access_code='$access'");
	
	$user_matched = mysqli_num_rows($code);

	if ($user_matched >0) {

		header("location:preboard.php?code=$access&acc_id=$acc_id");
	}
	else{
		header("location:dashboard.php?error=Incorrect Access Code");
	}
}
?>