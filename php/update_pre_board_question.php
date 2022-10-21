<?php

require_once 'conn.php';


if (isset($_POST['create'])) {

	$id = $_POST['id'];
	$subjects_name = $_POST['subjects'];
	$levels = $_POST['difficult'];
	$shock = $_POST['game'];
	$checkbox1 = $_POST['chkl'];

	$nam = "UPDATE tbl_pre_question SET subjects ='$subjects_name', levels_name='$levels', sum_question='$shock' WHERE pre_exam_id ='$id'";

	$san=mysqli_query($sqlcon,$nam);

	if ($san) {

		for ($i=0; $i <sizeof($checkbox1); $i++) {
			$query = "INSERT INTO tbl_pre_choose_quest(question_id,pre_exam_id)  VALUES ('".$checkbox1[$i]."','$id')";
			$ss = mysqli_query($sqlcon,$query);
		}
		header("location:../faculty/preboard.php");
	}
	else{
		mysqli_error($sqlcon);
	}




}
?>