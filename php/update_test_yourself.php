<?php

require_once 'conn.php';

if (isset($_POST["create"])) {

	$update_id = $_POST['test'];
	$des = $_POST['description'];
	$sec = $_POST['class_section'];
	$type =$_POST['type_exam'];
	$subject_exams = $_POST['subjects'];
	$level_difficulty = $_POST['difficult'];
	$question_title = $_POST['t_question'];
	$limit = $_POST['time_limit'];
	$prep = $_POST['prepared_by'];

	

	$sql_run =mysqli_query($sqlcon, "UPDATE choose_question SET description='$des', section='$sec', type_test='$type', subject_name='$subject_exams', question_difficulty='$level_difficulty',total_quest='$question_title',time_limit='$limit', prepared_by ='$prep' WHERE test_id = '$update_id'" );

	if ($sql_run) {

		header("Location:../faculty/testyourself.php?");
	}
	else{

		echo mysqli_error($sqlcon);
	}
}

?>