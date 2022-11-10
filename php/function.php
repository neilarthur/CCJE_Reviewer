<?php

require_once 'conn.php';

if (isset($_POST["create"])) {

	$let = $_POST['test'];
	$checkbox1 = $_POST['chkl'];

	$status = "active";


	foreach ($checkbox1 as $key => $value) {
		
		$query = "INSERT INTO student_choice(question_id,test_id,question_stat) VALUES ('".$value."','$let','$status')";
		$ss = mysqli_query($sqlcon,$query);

		if ($ss) {
			
			header("location:editing-quiz.php?id=$let");

		}
		else {

			echo mysqli_error($sqlcon);
		}
	}
}

?>