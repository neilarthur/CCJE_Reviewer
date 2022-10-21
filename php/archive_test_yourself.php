<?php

require_once 'conn.php';


if (isset($_POST['save'])) {

	$id = $_POST['update_id'];
  $status = 'archive';

    $sql= "UPDATE choose_question SET status = '$status' WHERE test_id='$id' ";
    $query_run = mysqli_query($sqlcon, $sql);

    if ($query_run) {
      
       header("Location:../faculty/testyourself.php");
  	}
  	else {
      echo mysqli_error($sqlcon);
    }
}    
?>