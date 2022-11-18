<?php

require_once 'conn.php';


if (isset($_POST['save'])) {
  $tots = $_POST['total'];
  $ids = $_POST['lets'];
	$id = $_POST['update_id'];

    $sql= "DELETE FROM student_choice WHERE qy_id='$id' ";
    $query_run = mysqli_query($sqlcon, $sql);

    if ($query_run) {

  		header("Location:../php/editing-quiz.php?id=$ids&total=$tots");
  	}
  	else {

  		echo mysqli_error($sqlcon);
  	}
}    
?>