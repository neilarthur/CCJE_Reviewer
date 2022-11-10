<?php

require_once 'conn.php';


if (isset($_POST['save'])) {

	$id = $_POST['update'];
    $status = 'Ready';

    $sql= "UPDATE choose_question SET stat_question = '$status' WHERE test_id='$id' ";
    $query_run = mysqli_query($sqlcon, $sql);

    if ($query_run) {

  		header("Location:../faculty/testyourself.php");
  	}
  	else {

  		echo mysqli_error($sqlcon);
  	}
}    
?>