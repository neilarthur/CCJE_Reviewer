<?php

include_once 'conn.php';

if (isset($_POST["save"])) {

	$update_id = $_POST['update_id'];
	$status = "archive";

	$data = "UPDATE tbl_pre_question SET pre_board_status ='$status' WHERE pre_exam_id = '$update_id'";
	$data_run = mysqli_query($sqlcon,$data);


	if ($data_run) {

		$query = "UPDATE tbl_pre_choose_quest SET pre_choose_status = '$status' WHERE pre_exam_id = '$update_id'";
		$query_run = mysqli_query($sqlcon,$query);

		if ($query_run) {

			$exam_res = "UPDATE tbl_exam_result SET status='$status' WHERE pre_exam_id='$update_id'";

			$exam_res1 = mysqli_query($sqlcon,$exam_res);

			if ($exam_res1) {

				$student_ans = "UPDATE tbl_pre_student_ans SET status='$status' WHERE pre_exam_id='$update_id'";
				$student_ans1 = mysqli_query($sqlcon,$student_ans);

				if ($student_ans1) {
					
					header("Location:../faculty/preboard.php");
				}
				else {

					echo mysqli_error($sqlcon);
				}
				
			}
			
		}
		else{

			echo mysqli_error($sqlcon);
		}
		

	}
	else{

		echo mysqli_error($sqlcon);
	}
}
?>