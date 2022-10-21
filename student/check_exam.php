<?php

session_start();

require_once '../php/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$update_exam = $_POST['update_pre_question'];
	$update_id = $_POST['sub_acc_id'];
	$total_quest = $_POST['total_quest'];
	$rate = $_POST['rate'];

	#pagination




	$pre_exam = $_POST['pre_exam_id'];

	if (!empty($_POST['examcheck'])) {

		$count = count($_POST['examcheck']);

		#loop to store  and display values in individual checked

	    $results = 0;
	    $i = 1;
	   	$choices = $_POST['examcheck'];

    	#print_r($selected);

    	$q = "SELECT * FROM test_question,tbl_pre_choose_quest WHERE (test_question.question_id=tbl_pre_choose_quest.question_id) AND pre_exam_id = '$pre_exam'";
    	$query = mysqli_query($sqlcon, $q);

    	while ($rows = mysqli_fetch_array($query)) {

    		$checked = $rows['correct_ans'] == $choices[$i];

    		if ($checked) {

    			$results++;
    		}
    		else{

    		}
    		$i++;
    	}

	    $remark = $results * $total_quest/100;
	    $percent = $results/$total_quest * 100;


	    if ($percent >= $rate) {
	      echo $remarks = "passed";
	    }
	    else {
	      echo $remarks = "failed";
	    }
	    
	    $final = "INSERT INTO tbl_exam_result(acc_id,pre_exam_id,score,score_percent,attempt,result)VALUES('$update_id','$pre_exam','$results','$percent','$total_quest','$remarks')";
	    $examinner = mysqli_query($sqlcon,$final);

	    $last_insert = mysqli_insert_id($sqlcon);
	    if ($examinner) {

	    	for ($a=1; $a <=sizeof($choices); $a++) { 
	    		
	    		$exam_query = "INSERT INTO tbl_pre_student_ans(exam_check,pre_exam_id,exam_result_id)VALUES('".$choices[$a]."','$pre_exam','$last_insert')";

	    		$exam_run = mysqli_query($sqlcon,$exam_query);
	    	}
	      header("Location:exam_result.php?code=$update_exam&update=$update_id");
	    }

	    else{

	      mysqli_error($sqlcon);
	    }
  	}


  	if (empty($_POST['examcheck'])) {

		$count = count($_POST['examcheck']);

		#loop to store  and display values in individual checked

	    $resulted = 0;
	    $e = 1;
	   	$choices_check = $_POST['examcheck'];

    	#print_r($selected);

    	$mysql_exam = "SELECT * FROM test_question,tbl_pre_choose_quest WHERE (test_question.question_id=tbl_pre_choose_quest.question_id) AND pre_exam_id = '$pre_exam'";
    	$query_exam = mysqli_query($sqlcon, $mysql_exam);

    	while ($col = mysqli_fetch_array($query_exam)) {

    		$checked_exam = $col['correct_ans'] == $choices_check[$e];

    		if ($checked_exam) {

    			$resulted++;
    		}
    		else{

    		}
    		$e++;
    	}

	    $remarked = $resulted * $total_quest/100;
	    $percented = $resulted/$total_quest * 100;


	    if ($percent >= $rate) {
	      echo $marks = "passed";
	    }
	    else {
	      echo $marks = "failed";
	    }
	    
	    $final_exam = "INSERT INTO tbl_exam_result(acc_id,pre_exam_id,score,score_percent,attempt,result)VALUES('$update_id','$pre_exam','$resulted','$percented','$total_quest','$marks')";
	    $examinner = mysqli_query($sqlcon,$final_exam);

	    $last= mysqli_insert_id($sqlcon);
	    if ($examinner) {

	    	for ($d=1; $d <=sizeof($choices_check); $d++) { 
	    		
	    		$exam_ad = "INSERT INTO tbl_pre_student_ans(exam_check,pre_exam_id,exam_result_id)VALUES('".$choices_check[$d]."','$pre_exam','$last')";

	    		$exam_dun = mysqli_query($sqlcon,$exam_ad);
	    	}
	      header("Location:exam_result.php?code=$update_exam&update=$update_id");
	    }

	    else{

	      mysqli_error($sqlcon);
	    }
  	}
}

?>