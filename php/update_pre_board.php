<?php

require_once 'conn.php';


if (isset($_POST['save'])) {

	$id = $_POST['update_id'];
	$descript = $_POST['description'];
	$subject = $_POST['subjects'];
	$level = $_POST['difficult'];
	$time = $_POST['time_limit'];
	$quest = $_POST['t_question'];


	$edit = "UPDATE tbl_pre_question SET description='$descript', subjects='$subject',levels_name='$level',time_limit='$time',total_question='$quest' WHERE pre_exam_id='$id'";

	$my = mysqli_query($sqlcon,$edit);

	if ($my) {

		header("location:../faculty/preboard.php");
	}
	else{
		mysql_error($sqlcon);
	}
 } 
?>