<?php

require_once 'conn.php';

if (isset($_POST["create"])) {

	$let = $_POST['test'];
	$checkbox1 = $_POST['chkl'];



	for ($i=0; $i <sizeof($checkbox1); $i++) {
		$query = "INSERT INTO student_choice(question_id,test_id)  VALUES ('".$checkbox1[$i]."','$let')";
		$ss = mysqli_query($sqlcon,$query);
		if ($ss) {
			header("location:../faculty/testyourself.php?id=$let");
		}
		else{
			mysqli_error($sqlcon);
		}
	}
}

?>