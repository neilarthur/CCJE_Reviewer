<?php

require_once 'conn.php';

if (isset($_POST['update'])) {

  $update_id = $_POST['update_id'];
  $subject_id = $_POST['subjected'];
  $level_difficulty = $_POST['level_difficulty'];
  $questions_title = $_POST['questions_title'];
  $option_a = $_POST['option_a'];
  $option_b = $_POST['option_b'];
  $option_c = $_POST['option_c'];
  $option_d = $_POST['option_d'];
  $correct_ans = $_POST['correct_ans'];
  $acc_id = $_POST['acc'];

  $query= "UPDATE test_question SET subject_name = '$subject_id', level_difficulty = '$level_difficulty', questions_title = '$questions_title', option_a = '$option_a', option_b = '$option_b', option_c = '$option_c', option_d = '$option_d', correct_ans = '$correct_ans', acc_id = '$acc_id' WHERE question_id = '$update_id' ";

  $query_run = mysqli_query($sqlcon, $query);


  if ($query_run) {
    header("Location:../faculty/testbank.php?uptestsuc");
  }
  else{

    header("Location:../faculty/testbank.php?uptestsucer");
  }
}  
?>