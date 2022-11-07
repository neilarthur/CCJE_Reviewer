<?php

include_once 'conn.php';


if (isset($_POST['save'])) {

  $ids = $_POST['lets'];
  $id = $_POST['update_id'];

  $descript = $_POST['descript'];
  $time = $_POST['time'];
  $access = $_POST['access'];
  $total = $_POST['total'];
  $safd = $_POST['safd'];

    $sql= "DELETE FROM tbl_pre_choose_quest WHERE exam_choose_id='$id' ";
    $query_run = mysqli_query($sqlcon, $sql);

    if ($query_run) {

  		header("Location:../php/editing-preboard.php?id=$ids");
  	}
  	else {

  		echo mysqli_error($sqlcon);
  	}
}     
?>