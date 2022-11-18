<?php

require_once 'conn.php';


if (isset($_POST['create'])) {

	
	$id = $_POST['id'];
	$totas = $_POST['total'];
	$checkbox1 = $_POST['chkl'];
	$pre_status = "active";


	foreach ($checkbox1 as $key => $value) {

		$pre_board_insert = "INSERT INTO tbl_pre_choose_quest (question_id,pre_exam_id,pre_choose_status) VALUES ('".$value."','$id','$pre_status')";

		$pre_query_exam = mysqli_query($sqlcon,$pre_board_insert);

		if ($pre_query_exam) {

			header("location: editing-preboard.php?id=$id&total=$totas");
		}
		else {
			echo mysqli_error($sqlcon);
		}
	}
}
?>