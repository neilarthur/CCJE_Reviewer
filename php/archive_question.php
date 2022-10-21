<?php

require_once 'conn.php';


if (isset($_POST['save'])) {

	$id = $_POST['update_id'];
    $status = 'archive';

    $sql= "UPDATE test_question SET status = '$status' WHERE question_id='$id' ";
    $query_run = mysqli_query($sqlcon, $sql);

    if ($query_run) {

  		header("Location:../faculty/testbank.php");
  	}
  	else {

  		echo mysqli_error($sqlcon);
  	}
}    
?>