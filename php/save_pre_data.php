<?php

require_once 'conn.php';

if (isset($_POST['save'])) {

	$preboards = $_POST['pre_boards'];

	$action = "Ready";


	$update_run = "UPDATE tbl_pre_question SET stat_exam = '$action' WHERE pre_exam_id='$preboards'";

	$update_query = mysqli_query($sqlcon,$update_run);

	if ($update_query) {

		header("Location:../faculty/preboard.php");
	}
	else {

		echo mysqli_error($sqlcon);
	}
}
?>