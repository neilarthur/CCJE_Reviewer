<?php

session_start();

require_once 'conn.php';

if ($_GET['disabled']) {
	$log = $_SESSION['acc_id'];
	$user_del = "Account has been delete";
	$id = $_GET['disabled'];
	$status = 'archive';

	$sql= "UPDATE accounts SET status = '$status' WHERE acc_id='$id' ";
	$query_run = mysqli_query($sqlcon, $sql);

	if ($query_run) {

		$log_activity = "INSERT INTO logs (acc_id,login_time,action)VALUES('$log',now(),'$user_del')";
		$log_run = mysqli_query($sqlcon,$log_activity);

		if ($log_run) {

			header("Location:../faculty/accounts_manage.php?m=1");
		}
		else{
			
			echo mysqli_error($sqlcon);
		}
	}
	else {

		echo mysqli_error($sqlcon);
	}   
}elseif ($_GET['enabled']) {
	$log = $_SESSION['acc_id'];
	$user_del = "Account has been restored";
	$id = $_GET['enabled'];
	$status = 'active';

	$sql= "UPDATE accounts SET status = '$status' WHERE acc_id='$id' ";
	$query_run = mysqli_query($sqlcon, $sql);

	if ($query_run) {

		$log_activity = "INSERT INTO logs (acc_id,login_time,action)VALUES('$log',now(),'$user_del')";
		$log_run = mysqli_query($sqlcon,$log_activity);

		if ($log_run) {

			header("Location:../faculty/archived_user_accounts.php?m=1");
		}
		else{
			
			echo mysqli_error($sqlcon);
		}
	}
	else {

		echo mysqli_error($sqlcon);
	} 
}
?>