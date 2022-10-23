<?php

require_once 'conn.php';

if (isset($_POST["create"])) {

	$subject_id = $_POST['subjects'];
	$level_difficulty = $_POST['level_difficulty'];
	$questions_title = $_POST['questions_title'];
	$option_a = $_POST['option_a'];
	$option_b = $_POST['option_b'];
	$option_c = $_POST['option_c'];
	$option_d = $_POST['option_d'];
	$correct_ans = $_POST['correct_ans'];
	$acc_id = $_POST['acc'];

	foreach ($questions_title as $key => $value) {


		$sql_run = "INSERT INTO test_question (subject_name,level_difficulty,questions_title,option_a,option_b,option_c,option_d,correct_ans,acc_id) VALUES ('$subject_id','$level_difficulty','".$value."','".$option_a[$key]."','".$option_b[$key]."','".$option_c[$key]."','".$option_d[$key]."','".$correct_ans[$key]."','".$acc_id[$key]."')";

		$query = mysqli_query($sqlcon,$sql_run);

		if ($query) {

			header("location:../faculty/testbank.php?testsuccess");
		}
		else {
			header("location:../faculty/testbank.php?testerror");
		}
	}
}

?>