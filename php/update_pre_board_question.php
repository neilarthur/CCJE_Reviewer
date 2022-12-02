<?php

session_start();

require_once 'conn.php';


if (isset($_POST['create'])) {

	
	$id = $_POST['id'];
	$totas = $_POST['total'];
	$checkbox1 = $_POST['chkl'];
	$all_tot = $_POST['all_tot'];
	$pre_status = "active";


	foreach ($checkbox1 as $key => $value) {

		$add_question_bank = "SELECT * FROM tbl_pre_choose_quest WHERE pre_exam_id ='$id' AND question_id='".$value."'";

		$add_question_bank_query = mysqli_query($sqlcon,$add_question_bank);

		if (mysqli_num_rows($add_question_bank_query) >0) {

			$_SESSION['exists'] ="Question are already exists!";

			header("location: editing-preboard.php?id=$id&total=$all_tot");

		}
		else {

			$pre_board_insert = "INSERT INTO tbl_pre_choose_quest (question_id,pre_exam_id,pre_choose_status) VALUES ('".$value."','$id','$pre_status')";

			$pre_query_exam = mysqli_query($sqlcon,$pre_board_insert);

			if ($pre_query_exam) {

				$_SESSION['validate'] = "Selected questions added successfully!";
			
				header("location: editing-preboard.php?id=$id&total=$all_tot");
			}
			else {
				echo mysqli_error($sqlcon);
			}
		}
	}
}
?>