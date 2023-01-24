<?php

require_once 'conn.php';

if (isset($_POST['sub'])) {

	$userover_id = $_POST['userover_id'];
	$start_time = $_POST['start_time'];
	$close_time = $_POST['close_time'];
	$total = $_POST['t_question'];


	$wert = "UPDATE tbl_pre_question SET start_date='$start_time', end_date='$close_time' WHERE pre_exam_id ='$userover_id'";

	$wert_query = mysqli_query($sqlcon,$wert);

	if ($wert_query) {
		
		header("location: editing-preboard.php?id=$userover_id&total=$total");
	}
	else {
		mysqli_error($sqlcon);
	}
}
?>