<?php

require_once 'conn.php';

if (isset($_POST['sub'])) {

	$userover_id = $_POST['userover_id'];
	$start_time = $_POST['start_time'];
	$close_time = $_POST['close_time'];
	$total = 0;


	$wert = "UPDATE choose_question SET start_day='$start_time', end_day='$close_time' WHERE test_id ='$userover_id'";

	$wert_query = mysqli_query($sqlcon,$wert);

	if ($wert_query) {
		
		header("location: editing-quiz.php?id=$userover_id&total=$total");
	}
	else {
		mysqli_error($sqlcon);
	}
}
?>