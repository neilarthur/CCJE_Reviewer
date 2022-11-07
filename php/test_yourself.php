<?php

require_once 'conn.php';

if (isset($_POST["create"])) {

	$title = $_POST['title'];
	$des = $_POST['description'];
	$sec = $_POST['class_section'];
	$type =$_POST['type_exam'];
	$subject_exams = $_POST['subjects'];
	$level_difficulty = $_POST['difficult'];
	$question_title = $_POST['t_question'];
	$limit = $_POST['time_limit'];
	$prep = $_POST['prepared_by'];

	$checkbox1 = $_POST['chkl'];


	$sql_run = "INSERT INTO choose_question (description,quiz_title,section,type_test,subject_name,question_difficulty,question_prev,total_quest,time_limit,prepared_by)VALUES('$des','$title','$sec','$type','$subject_exams','$level_difficulty','$question_title','$question_title','$limit','$prep')";


	$sql_rows = mysqli_query($sqlcon, $sql_run);
	$lastid = mysqli_insert_id($sqlcon); 


	if ($sql_rows) {

		foreach ($checkbox1 as $key => $value) {
			
			$query = "INSERT INTO student_choice(question_id,test_id) VALUES ('".$value."','$lastid')";
			mysqli_query($sqlcon,$query) or die (mysqli_error($sqlcon));
		}
		header("location:../faculty/testyourself.php?testsuccess");
	}
	else {
		
		echo mysqli_error($sqlcon);
	}
}

?>