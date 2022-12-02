<?php

session_start();

require_once 'conn.php';

if (isset($_POST['create'])) {

	$quest = $_POST['preboard_choose'];

	$area_exam = $_POST['area_exam'];
	$t_question = $_POST['t_question'];

	$test_id = $_POST['test_id'];
	$totas = $_POST['total'];
	$stat = "active";


	$select = mysqli_query($sqlcon,"SELECT * FROM test_question WHERE subject_name ='$area_exam' ORDER BY rand() LIMIT $t_question ");

	while ($rows = mysqli_fetch_array($select)) {
		
		$query_question[] = $rows['question_id'];
	}


	foreach ($query_question as $key => $value) {
		
		$valid_data = "SELECT * FROM tbl_pre_choose_quest WHERE pre_exam_id='$test_id' AND question_id='".$value."'";

		$valid_data_query = mysqli_query($sqlcon,$valid_data);

		if (mysqli_num_rows($valid_data_query) >0) {

			$_SESSION['exists'] ="Question are already exists!";

			header("location: editing-preboard.php?id=$test_id&total=$totas");
		}
		else {

			$random_insert = "INSERT INTO tbl_pre_choose_quest(question_id,pre_exam_id,pre_choose_status)VALUES('".$value."','$test_id','$stat')";

			$random_query = mysqli_query($sqlcon,$random_insert);

			if ($random_query) {

				$_SESSION['validate'] = "Random questions added successfully!";
			
				header("location: editing-preboard.php?id=$test_id&total=$totas");
			}
			else{
				echo mysqli_error($sqlcon);
			}
		}
	}
 } 
?>