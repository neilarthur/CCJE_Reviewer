<?php

include_once '../php/conn.php';


if (isset($_POST['submit'])) {

	$acc_id = $_POST['acc_id'];
	$c_password = $_POST['c_password'];
	$new_password = $_POST['new_password'];
	$conf_password = $_POST['conf_password'];



	$change_pass = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '$acc_id'");
	$change_pass1 = mysqli_fetch_array($change_pass);

	$acc_pass = $change_pass1['password'];


	if ($acc_pass ==$c_password) {

		if ($new_password ==$conf_password) {

			$update_password = "UPDATE accounts SET password ='$new_password' WHERE acc_id = '$acc_id'";
			$update_1 = mysqli_query($sqlcon,$update_password);

			if ($update_1) {
				
				header("Location:dashboard.php");
			}
			else{
				header("location:dashboard.php");
			}
		}
		else{
			
			echo mysqli_error($sqlcon);
		}
	}


}
?>