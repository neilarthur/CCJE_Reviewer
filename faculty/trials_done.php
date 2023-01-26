<?php


require_once '../php/conn.php';

if (isset($_POST['submit'])) {

	$id = $_POST['update_id'];

	$acc_id = $_POST['update_acc_id'];


	$trial_marks = "INSERT INTO tbl_trial_done(acc_id,test_id)VALUES('$acc_id','$id')";

	$trial_marks_query = mysqli_query($sqlcon,$trial_marks);


	if ($trial_marks_query) {
		
		header("location:../php/preview.php?id=$id&acc_id=$acc_id");
	}
	else {

		echo mysqli_error($sqlcon);
	}

}
?>