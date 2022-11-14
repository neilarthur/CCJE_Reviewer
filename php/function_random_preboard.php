<?php

require_once 'conn.php';

if (isset($_POST['create'])) {

	$quest = $_POST['preboard_choose'];
	$test_id = $_POST['test_id'];
	$totas = $_POST['total'];
	$stat = "active";


	foreach ($quest as $key => $value) {
		

		$random_insert = "INSERT INTO tbl_pre_choose_quest(question_id,pre_exam_id,pre_choose_status)VALUES('".$value."','$test_id','$stat')";

		$random_query = mysqli_query($sqlcon,$random_insert);

		if ($random_query) {
			
			header("location: editing-preboard.php?id=$test_id&total=$totas");
		}
		else{
			echo mysqli_error($sqlcon);
		}
	}
 } 
?>