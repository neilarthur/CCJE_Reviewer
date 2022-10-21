<?php

require_once 'conn.php';


$id = $_GET['id'];
$status = 'archive';

$sql= "UPDATE accounts SET status = '$status' WHERE acc_id='$id' ";
$query_run = mysqli_query($sqlcon, $sql);

if ($query_run) {

	header("Location:../faculty/accounts_manage.php?m=1");
}
else {

	echo mysqli_error($sqlcon);
}   
?>