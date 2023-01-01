<?php

session_start();


require_once 'conn.php';

if (isset($_POST["create"])) {

	$update_id = $_POST['update_id'];
	$title = $_POST['title'];
	$description = $_POST['description'];
	$class_section = $_POST['class_section'];
	$type_exam = $_POST['type_exam'];
	$subjects = $_POST['subjects'];
	$difficult = $_POST['difficult'];
	$t_question = $_POST['t_question'];
	$time_limit = $_POST['time_limit'];
	

	$sql_run =mysqli_query($sqlcon, "UPDATE choose_question SET description='$description',quiz_title='$title',section='$class_section',type_test='$type_exam',subject_name='$subjects',question_difficulty='$difficult',question_prev='$t_question',total_quest='$t_question',time_limit='$time_limit' WHERE test_id = '$update_id'" );

	if ($sql_run) {

		header("Location: editing-quiz.php?id=$update_id&total=$t_question");
	}
	else{

		echo mysqli_error($sqlcon);
	}
}

?>