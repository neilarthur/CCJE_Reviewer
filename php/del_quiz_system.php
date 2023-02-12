<?php

require_once 'conn.php';


if ($_GET['enabled']) {

  $id = $_GET['enabled'];
  $status = "active";


    $sql = "UPDATE choose_question SET status = '$status' WHERE test_id = '$id'";
    $query_run = mysqli_query($sqlcon, $sql);

    if ($query_run) {

      $data = "UPDATE student_choice SET question_stat = '$status' WHERE test_id ='$id'";
      $query = mysqli_query($sqlcon, $data);

      if ($query) {
        header("Location:../system_admin/archive_quizzes.php?m=1");
      }
      else{
        echo mysqli_error($sqlcon);
      }

    }
    else {

      echo mysqli_error($sqlcon);
    }
}elseif ($_GET['disabled']) {
  $id = $_GET['disabled'];
  $status = "archive";


    $sql = "UPDATE choose_question SET status = '$status' WHERE test_id = '$id'";
    $query_run = mysqli_query($sqlcon, $sql);

    if ($query_run) {

      $data = "UPDATE student_choice SET question_stat = '$status' WHERE test_id ='$id'";
      $query = mysqli_query($sqlcon, $data);

      if ($query) {
        header("Location:../system_admin/archive_quizzes.php?m=1");
      }
      else{
        echo mysqli_error($sqlcon);
      }

    }
    else {

      echo mysqli_error($sqlcon);
    }
}    
?>