<?php

require_once 'conn.php';

if (isset($_POST['create'])) {


	$test_id = $_POST['test_id'];
	$totas = $_POST['total'];
	$total_quest = $_POST['total_quest'];
	$stat = "active";
	$area_exam = $_POST['area_exam'];
	$diff = $_POST['diff'];

	$mess ="A random number is not successf";



	$select = "SELECT DISTINCT * FROM test_question WHERE subject_name = '$area_exam' AND level_difficulty = '$diff' ORDER BY rand() LIMIT $total_quest";

	$select_query = mysqli_query($sqlcon,$select);

	while ($rows = mysqli_fetch_array($select_query)) {

		$base[] = $rows['question_id'];
	}


	$select_dis = mysqli_query($sqlcon,"SELECT DISTINCT * FROM test_question,student_choice WHERE (test_question.question_id = student_choice.question_id) AND (student_choice.question_id = '$base') AND  (student_choice.test_id='$test_id')");

	$select_run = mysqli_num_rows($select_dis);

	if ($select_run) {

		header("location: editing-quiz.php?id=$test_id&total=$totas");
	}
	else {

		foreach ($base as $key => $value) {

			$random_insert = "INSERT INTO student_choice(question_id,test_id,question_stat)VALUES('".$value."','$test_id','$stat')";

			$random_query = mysqli_query($sqlcon,$random_insert);

			if ($random_query) {

				header("location: editing-quiz.php?id=$test_id&total=$totas");
			}
			else{
				echo mysqli_error($sqlcon);
			}
		}
	}
} 
?>