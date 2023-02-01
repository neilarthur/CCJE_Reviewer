<?php

require_once 'conn.php';

if ($_GET['disabled']) {
  $id = $_GET['disabled'];
  $status = 'archive';

  $sql= "UPDATE accounts SET status = '$status' WHERE acc_id='$id' ";
  $query_run = mysqli_query($sqlcon, $sql);

  $query= mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id= $id");
  while ($fetch = mysqli_fetch_array($query)) {
    if ($fetch['role']=='student') {
      if ($query_run) {

        header("Location:../admin/accounts.php?m=1&tab-accounts=students");
      }
      else {

        echo mysqli_error($sqlcon);
      }   
    }
    elseif ($fetch['role']=='faculty') {
      if ($query_run) {

        header("Location:../admin/accounts.php?m=1&tab-accounts=faculty");
      }
      else {

        echo mysqli_error($sqlcon);
      } 
    }
  }
}elseif ($_GET['enabled']) {
  $id = $_GET['enabled'];
  $status = 'active';

  $sql= "UPDATE accounts SET status = '$status' WHERE acc_id='$id' ";
  $query_run = mysqli_query($sqlcon, $sql);

  $query= mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id= $id");
  while ($fetch = mysqli_fetch_array($query)) {
    if ($fetch['role']=='student') {
      if ($query_run) {

        header("Location:../admin/archive_users.php?m=1&tab-accounts=students");
      }
      else {

        echo mysqli_error($sqlcon);
      }   
    }
    elseif ($fetch['role']=='faculty') {
      if ($query_run) {

        header("Location:../admin/archive_users.php?m=1&tab-accounts=faculty");
      }
      else {

        echo mysqli_error($sqlcon);
      } 
    }
  }
}

  
?>