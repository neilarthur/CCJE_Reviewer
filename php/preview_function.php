<?php

session_start();

require_once 'conn.php';

if (isset($_POST['trial_quiz'])) {

	$trial_error = $_POST['trial'];

	$update_id=$_POST['update_id'];

	$update_acc_id = $_POST['update_acc_id'];


	$corr = 0;



	$idlist = join(',', array_map('intval', array_keys($_POST['trial'])));

	$q = "SELECT * FROM test_question,student_choice WHERE (test_question.question_id = student_choice.question_id) AND student_choice.test_id='$update_id'  AND test_question.question_id IN ($idlist)";

	$q_query = mysqli_query($sqlcon,$q);

	while (list($question_id,$subject_name,$level_difficulty,$question_title,$option_a,$option_b,$option_c,$option_d,$correct_ans) = mysqli_fetch_row($q_query)) {


		if ($correct_ans == $_POST['trial'][$question_id]) {

			$corr +=1;
		}

	}

	$results = "INSERT INTO tbl_trial_result(acc_id,test_id,result) VALUES ('$update_acc_id','$update_id','$corr')";
	$results_query = mysqli_query($sqlcon,$results);
	$last_id = mysqli_insert_id($sqlcon);

	if ($results_query) {

		foreach ($trial_error as $key => $value) {
		
			$corrects = "INSERT INTO trial_preview (trial_ans,test_id,trial_result_id) VALUES ('".$value."','$update_id','$last_id')";

			$corrects_query = mysqli_query($sqlcon,$corrects);

			if ($corrects_query) {
			
				header("location: ../faculty/testyourself.php?id=$update_id&last=$last_id");
			}
			else {

				echo mysqli_error($sqlcon);
			}
		}
	}
	else {

		echo mysqli_error($sqlcon);
	}
}

?>

