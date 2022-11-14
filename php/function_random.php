<?php

require_once 'conn.php';

if (isset($_POST['create'])) {

	$quest = $_POST['unique_quest'];
	$test_id = $_POST['test_id'];
	$totas = $_POST['total'];
	$stat = "active";


	foreach ($quest as $key => $value) {
		

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
?>