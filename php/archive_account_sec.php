<?php

require_once 'conn.php';


$id = $_GET['id'];
$status = 'archive';

$sql= "UPDATE accounts SET status = '$status' WHERE acc_id='$id' ";
$query_run = mysqli_query($sqlcon, $sql);

$query= mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id= $id");
while ($fetch = mysqli_fetch_array($query)) {
  if ($fetch['role']=='student') {
    if ($query_run) {

      header("Location:../secretary/accounts.php?m=1&tab-accounts=students");
    }
    else {

      echo mysqli_error($sqlcon);
    }   
  }
  elseif ($fetch['role']=='faculty') {
    if ($query_run) {

      header("Location:../secretary/accounts.php?m=1&tab-accounts=faculty");
    }
    else {

      echo mysqli_error($sqlcon);
    } 
  }
}
  
?>