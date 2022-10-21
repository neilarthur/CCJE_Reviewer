<?php


require_once '../php/conn.php';


if (isset($_POST['submits'])) {

	$rate = $_POST['rate'];
	$time = $_POST['time'];
	$like = $_POST['t_quest'];
	$lost = $_POST['acc'];
	$shor = $_POST['test'];

	


	$lo = "INSERT INTO tbl_marks_done(acc_id,test_id)VALUES('$lost','$shor')";
	$best = mysqli_query($sqlcon,$lo);

	if ($best) {

		header("location:quiz.php?id=$shor&base=$like&pass=$rate&limit=$time");
	}
	else {
		mysqli_error($sqlcon);
	}
}
?>