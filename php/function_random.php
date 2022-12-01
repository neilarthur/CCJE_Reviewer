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

	foreach ($base as $key => $value) {

		$validate = mysqli_query($sqlcon,"SELECT * FROM student_choice WHERE test_id='$test_id' AND question_id='".$value."'");

		if (mysqli_num_rows($validate) >0) {
			
			echo "Question are already exists";
		}
		else {

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