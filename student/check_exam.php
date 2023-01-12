<?php

session_start();

require_once '../php/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$update_exam = $_POST['update_pre_question'];
	$update_id = $_POST['sub_acc_id'];
	$total_quest = $_POST['total_quest'];
	$rate = 70;


	$pre_exam = $_POST['pre_exam_id'];

	$question_di = $_POST['question_di'];


	$choices = $_POST['examcheck'];

	$results = 0;
  	$wrong = 0;


	$idlist = join(',', array_map('intval', array_keys($_POST['examcheck'])));

	$q = "SELECT * FROM test_question,tbl_pre_choose_quest WHERE (test_question.question_id=tbl_pre_choose_quest.question_id) AND pre_exam_id='$pre_exam'";

	$query = mysqli_query($sqlcon,$q);

	while (list($question_id,$subject_name,$level_difficulty,$question_title,$option_a,$option_b,$option_c,$option_d,$correct_ans) = mysqli_fetch_row($query)) {

		if ($correct_ans == $_POST['examcheck'][$question_id]) {

			$results+=1;
		}
	}

	$remark = $results * $total_quest/100;
	$percent = $results/$total_quest * 100;

	if ($percent >= $rate) {
	    echo $remarks = "passed";
	}
	else {
	    echo $remarks = "failed";
	}

	$base2 = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_marks_done WHERE pre_exam_id = '$pre_exam' AND acc_id ='$update_id'");
  	$lack2= mysqli_fetch_assoc($base2);

  date_default_timezone_set('Asia/Manila');

  $currentTimeinSeconds  =$lack2['date_created'];

  $sssl = time() - strtotime($currentTimeinSeconds);

  $sssl2 = date('y-m-d H:i:s', $sssl);

	$final = "INSERT INTO tbl_exam_result(acc_id,pre_exam_id,score,score_percent,attempt,result,date_exam_result)VALUES('$update_id','$pre_exam','$results','$percent','$total_quest','$remarks','$sssl2')";
	$examinner = mysqli_query($sqlcon,$final);

	$last_insert = mysqli_insert_id($sqlcon);

	if ($examinner) {

		foreach ($question_di as $qty => $value) {

			$ccc = $_POST['examcheck'][$value];

			$exam_query = "INSERT INTO tbl_pre_student_ans(exam_check,pre_exam_id,exam_result_id,question_id) VALUES ('$ccc','$pre_exam','$last_insert','".$value."')";

			mysqli_query($sqlcon,$exam_query);
		}
	    header("Location:exam_result.php?code=$update_exam&update=$update_id");
	}

	else{

		mysqli_error($sqlcon);
	}
}

?>