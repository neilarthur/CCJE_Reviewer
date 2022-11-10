<?php

require_once'conn.php';

if (isset($_POST['create'])) {

	$area_quiz = $_POST['subjects'];
	$difficulty = $_POST['diff'];
	$questions = $_POST['questions_title'];
	$option_a = $_POST['option_a'];
	$option_b = $_POST['option_b'];
	$option_c = $_POST['option_c'];
	$option_d = $_POST['option_d'];
	$correct_ans = $_POST['correct_ans'];
	$acc = $_POST['acc'];
	$test_id = $_POST['test_id'];
	$status = "active";
	$stat = "active";

	foreach ($questions as $key => $value) {

		$insert_quiz = "INSERT INTO test_question(subject_name,level_difficulty,questions_title,option_a,option_b,option_c,option_d,correct_ans,acc_id,status)VALUES ('$area_quiz','$difficulty','".$value."','".$option_a[$key]."','".$option_b[$key]."','".$option_c[$key]."','".$option_d[$key]."','".$correct_ans[$key]."','$acc','$status')";

		$query_quiz = mysqli_query($sqlcon,$insert_quiz);

		$last_id = mysqli_insert_id($sqlcon);

		if ($query_quiz) {

			$insert_lock = "INSERT INTO student_choice(question_id,test_id,question_stat)VALUES ('$last_id','$test_id','$stat')";
			$insert_query = mysqli_query($sqlcon,$insert_lock);
			
			if ($insert_query) {
				
				header("location: editing-quiz.php?id=$test_id");

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