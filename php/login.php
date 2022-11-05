<?php

session_start();

include_once 'conn.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {

	$user_id = $_POST['userID'];
	$password = $_POST['password'];
	$user_action = "user has been log in";

	$sql_run = "SELECT * FROM accounts WHERE user_id='$user_id' AND password='$password'";
	$results = mysqli_query($sqlcon,$sql_run);
	$sql_rows = mysqli_fetch_array($results);

	if ($sql_rows['role']=='admin') {
		$_SESSION["acc_id"] = $sql_rows['acc_id'];
		$_SESSION["role"] = $sql_rows['role'];

		$_SESSION["first_name"] = $sql_rows['first_name'];
		
		$_SESSION["login"]=true;

		header("Location:../admin/dashboard.php?loginsuccess");
	}
	elseif ($sql_rows['role']=='faculty') {
		$_SESSION["role"] = $sql_rows['role'];
		$_SESSION["first_name"] = $sql_rows['first_name'];
		$_SESSION["login"]=true;

		$_SESSION["acc_id"] = $sql_rows['acc_id'];

		$valid = $_SESSION['acc_id'];

		$data = "INSERT INTO logs(acc_id,login_time,action)VALUES('$valid', now(),'$user_action')";
		$log_data = mysqli_query($sqlcon,$data);

		$_SESSION["login_id"] = mysqli_insert_id($sqlcon);

		if ($log_data) {
			header("Location:../faculty/dashboard.php?acc_id=$valid&loginsuccess");
		}
		else{
			 echo mysqli_error($sqlcon);
		}
	}
	elseif ($sql_rows['role']=='student') {

		$_SESSION["role"] = $sql_rows['role'];
		$_SESSION["login"]=true;
		$_SESSION["first_name"] = $sql_rows['first_name'];
		$_SESSION["acc_id"] = $sql_rows['acc_id'];




		$validate = $_SESSION['acc_id'];

		$auth = "INSERT INTO logs(acc_id,login_time,action)VALUES('$validate', now(),'$user_action')";
		$log_data = mysqli_query($sqlcon,$auth);

		$_SESSION["login_id"] = mysqli_insert_id($sqlcon);

		if ($log_data) {
			header("Location:../student/dashboard.php?acc_id=$valid");
		}
		else{
			 echo mysqli_error($sqlcon);
		}
		
	}
	else{
		header("Location:index.php?loginerror");
		exit();
	}
}
?>