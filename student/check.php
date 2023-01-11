<?php

session_start();

require_once '../php/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $update_id = $_POST['update_id'];
  $update = $_POST['update_acc_id'];
  $status = "done";
  $subj_name = $_POST['subjectas'];

  $pass = 75;

  $update_question_id = $_POST['update_question_id'];
  $selected = $_POST['quizcheck'];

  $result = 0;
  $wrong = 0;

  $idlist = join(',', array_map('intval', array_keys($_POST['quizcheck'])));

  $q = "SELECT * FROM test_question,student_choice WHERE (test_question.question_id = student_choice.question_id) AND student_choice.test_id='$update_id' AND test_question.question_id IN ($idlist)";

  $query = mysqli_query($sqlcon,$q);

  while (list($question_id,$subject_name,$level_difficulty,$question_title,$option_a,$option_b,$option_c,$option_d,$correct_ans) = mysqli_fetch_row($query)) {

    if ($correct_ans == $_POST['quizcheck'][$question_id]) {

      $result+=1;
    }
  }
  $base = mysqli_query($sqlcon,"SELECT * FROM choose_question WHERE test_id = '$update_id'");
  $lack = mysqli_fetch_assoc($base);

  $basket = $lack['question_prev'];
  $bask = $lack['question_no'];
  $tots = $basket + $bask;
  $remark = $result * $tots/100;
  $percentage = $result/$tots * 100;

  if ($percentage >= $pass) {
    echo $remarks = "passed";
  }
  else {
    echo $remarks = "failed";
  }
    
  $finalresult = "INSERT INTO tbl_quiz_result(acc_id,test_id,score,score_percent,attempt,result,res_status)VALUES('$update','$update_id','$result','$percentage','$tots','$remarks','$status')";
  $res = mysqli_query($sqlcon,$finalresult);
  $lastid = mysqli_insert_id($sqlcon); 

  if ($res) {

    foreach ($update_question_id as $key => $value) {

      $ccc = $_POST['quizcheck'][$value];

      $querys = "INSERT INTO tbl_student_answer(quiz_check,test_id,ans_id,question_id) VALUES ('".$ccc."','$update_id','$lastid','".$value."')";
      mysqli_query($sqlcon,$querys);
    }
    header("Location:result.php?update_id");
  }
  else{

    echo mysqli_error($sqlcon);
  }
}
?>