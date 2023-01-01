<?php

require_once '../php/conn.php';

if (isset($_POST['subs'])) {

	$in_response = $_POST['response'];
	$acc_id = $_POST['acc_id'];
	$test_id = $_POST['test_id'];


	$var_res = "INSERT INTO tbl_response(feedback,test_id,acc)VALUES('$in_response','$test_id','$acc_id')";

	$query_res = mysqli_query($sqlcon,$var_res);


	if ($query_res) {
		
		header("location: ../student/take_quiz.php");
	}
	else {

		echo mysqli_error($sqlcon);
	}
}
?>