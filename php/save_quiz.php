<?php

require_once 'conn.php';


if (isset($_POST['save'])) {

	$id = $_POST['update'];
    $status = 'Ready';

    $sql= "UPDATE choose_question SET stat_question = '$status' WHERE test_id='$id' ";
    $query_run = mysqli_query($sqlcon, $sql);

    if ($query_run) {

      $notif_student = "INSERT INTO tbl_notification(action,acc_id,notif_status)VALUES ('$acs2','$history_acc','$not_stat')";
      $notif_student_query = mysqli_query($sqlcon,$notif_student);

      if ($notif_student_query) {
        
        header("location:../faculty/testyourself.php");

      }
      else {

        header("location:../faculty/testyourself.php"); 
      } 
  	}
  	else {

  		echo mysqli_error($sqlcon);
  	}
}    
?>