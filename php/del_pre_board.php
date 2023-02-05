<?php

include_once 'conn.php';

if ($_GET['enabled']) {

	$update_id = $_GET['enabled'];
	$status = "active";

	$data = "UPDATE tbl_pre_question SET pre_board_status ='$status' WHERE pre_exam_id = '$update_id'";
	$data_run = mysqli_query($sqlcon,$data);


	if ($data_run) {

		$query = "UPDATE tbl_pre_choose_quest SET pre_choose_status = '$status' WHERE pre_exam_id = '$update_id'";
		$query_run = mysqli_query($sqlcon,$query);

		if ($query_run) {

			header("Location:../faculty/archive_exam.php?m=1");
		}
		else{

			echo mysqli_error($sqlcon);
		}

	}
	else{

		echo mysqli_error($sqlcon);
	}
}elseif ($_GET['disabled']) {
  $update_id = $_GET['disabled'];
  $status = "archive";

  $data = "UPDATE tbl_pre_question SET pre_board_status ='$status' WHERE pre_exam_id = '$update_id'";
  $data_run = mysqli_query($sqlcon,$data);


  if ($data_run) {

    $query = "UPDATE tbl_pre_choose_quest SET pre_choose_status = '$status' WHERE pre_exam_id = '$update_id'";
    $query_run = mysqli_query($sqlcon,$query);

    if ($query_run) {

      header("Location:../faculty/preboard.php?m=1");
    }
    else{

      echo mysqli_error($sqlcon);
    }

  }
  else{

    echo mysqli_error($sqlcon);
  }
}
?>