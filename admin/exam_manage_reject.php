<?php


include_once '../php/conn.php';

if (isset($_POST['save'])) {

	$update_id = $_POST['update_id'];
	$status ="Decline";


	$sql_query = "UPDATE tbl_pre_question SET approval='$status' WHERE pre_exam_id ='$update_id'";
	$sql_run = mysqli_query($sqlcon,$sql_query);

	if ($sql_run) {
		
		header("location: exam-manage.php");
	}
	else{
		echo mysqli_error($sqlcon);
	}
}
?>