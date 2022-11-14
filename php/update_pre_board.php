<?php

require_once 'conn.php';


if (isset($_POST['create'])) {

	$id = $_POST['update_id'];
	$description = $_POST['description'];
	$area_exam = $_POST['subjects'];
	$total = $_POST['t_question'];
	$time_limit = $_POST['time_limit'];
	$start_time = $_POST['start_time'];
	$close_time = $_POST['close_time'];



	$edit = "UPDATE tbl_pre_question SET description='$description',subjects='$area_exam',time_limit='$time_limit',total_question='$total',sum_question='$total',start_date='$start_time',end_date='$close_time' WHERE pre_exam_id = '$id'";

	$my = mysqli_query($sqlcon,$edit);

	if ($my) {

		header("location:../php/editing-preboard.php?id=$id");
	}
	else{
		mysql_error($sqlcon);
	}
 } 
?>