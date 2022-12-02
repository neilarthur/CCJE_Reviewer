<?php

session_start();

require_once 'conn.php';

if (isset($_POST['create'])) {

	$area_exam = $_POST['subjects'];
	$difficulty =$_POST['level_difficulty'];
	$questions_title = $_POST['questions_title'];
	$opt_a = $_POST['option_a'];
	$opt_b = $_POST['option_b'];
	$opt_c = $_POST['option_c'];
	$opt_d = $_POST['option_d'];
	$correct_ans = $_POST['correct_ans'];
	$acc_id = $_POST['acc'];
	$update_id = $_POST['update_id'];
	$status = "active";
	$stat = "active";
	$totas = $_POST['total_1'];


	foreach ($questions_title as $key => $value) {

		$insert_preboard = "INSERT INTO test_question(subject_name,level_difficulty,questions_title,option_a,option_b,option_c,option_d,correct_ans,acc_id,status)VALUES('$area_exam','$difficulty','".$value."','".$opt_a[$key]."','".$opt_b[$key]."','".$opt_c[$key]."','".$opt_d[$key]."','".$correct_ans[$key]."','".$acc_id[$key]."','$stat')";

		$query_preboard = mysqli_query($sqlcon,$insert_preboard);

		$last_preboard = mysqli_insert_id($sqlcon);

		if ($query_preboard) {

			$insert_chose_preboard = "INSERT INTO tbl_pre_choose_quest(question_id,pre_exam_id,pre_choose_status)VALUES('$last_preboard','$update_id','$status')";

			$query_choose_preboard = mysqli_query($sqlcon,$insert_chose_preboard);

			if ($query_choose_preboard) {

				$_SESSION['validate'] = "Questions added successfully";
				
				header("location: editing-preboard.php?id=$update_id&total=$totas");
			}
			else{

				echo mysqli_error($sqlcon);
			}
		}
		else{

			echo mysqli_error($sqlcon);
		}
	}
}
?>