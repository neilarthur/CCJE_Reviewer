<?php

session_start();

require_once 'conn.php';

if (isset($_POST["create"])) {
	
    $tots = $_POST['total'];
	$let = $_POST['test'];
	$checkbox1 = $_POST['chkl'];

	$status = "active";


	foreach ($checkbox1 as $key => $value) {


		$checking = mysqli_query($sqlcon,"SELECT * FROM student_choice WHERE test_id='$let' AND question_id='".$value."'");

		if (mysqli_num_rows($checking) >0) {
			
			$_SESSION['stat_over_1']= "Question are already exists!";

			header("location:editing-quiz.php?id=$let&total=$tots");
		}
		else {

			$query = "INSERT INTO student_choice(question_id,test_id,question_stat) VALUES ('".$value."','$let','$status')";
			$ss = mysqli_query($sqlcon,$query);

			if ($ss) {

				$_SESSION['stat_over']= "Selected questions added successfully!";
				
				header("location:editing-quiz.php?id=$let&total=$tots");
			}
			else {

				$_SESSION['stat_over_1']= "Question are already exists!";

				header("location:editing-quiz.php?id=$let&total=$tots");
			}
		}
	}
}

?>