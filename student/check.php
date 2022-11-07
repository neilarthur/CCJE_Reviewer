<?php

session_start();

require_once '../php/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $update_id = $_POST['update_id'];
  $update = $_POST['update_acc_id'];
  $status = "done";
  $subj_name = $_POST['subjectas'];

  $pass = 75;


  if (!empty($_POST['quizcheck'])) {


    $count = count($_POST['quizcheck']);

    #loop to store  and display values in individual checked

    $result = 0;
    $i = 1;

    $selected = $_POST['quizcheck'];

    #print_r($selected);

    $q = "SELECT * FROM choose_question,test_question,student_choice WHERE (choose_question.test_id = student_choice.test_id) AND (test_question.question_id=student_choice.question_id) AND student_choice.test_id = '$update_id'";
    $query = mysqli_query($sqlcon, $q);

    while ($rows = mysqli_fetch_array($query)) {

      $checked = $rows['correct_ans'] == $selected[$i];

      if ($checked) {
        
        $result++;
      }
      $i++;
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

      foreach ($selected as $key => $value) {
        
        $querys = "INSERT INTO tbl_student_answer(quiz_check,test_id,ans_id) VALUES ('".$value."','$update_id','$lastid')";
        mysqli_query($sqlcon,$querys);
      }
      header("Location:result.php?update_id");
    }

    else{

      mysqli_error($sqlcon);
    }
  }
}
?>