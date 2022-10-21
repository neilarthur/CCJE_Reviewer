<?php

require_once 'conn.php';


if (isset($_POST['save'])) {

  $ids = $_POST['lets'];
	$id = $_POST['update_id'];

    $sql= "DELETE FROM student_choice WHERE qy_id='$id' ";
    $query_run = mysqli_query($sqlcon, $sql);

    if ($query_run) {

  		header("Location:../faculty/view_question.php?id=$ids");
  	}
  	else {

  		echo mysqli_error($sqlcon);
  	}
}    
?>