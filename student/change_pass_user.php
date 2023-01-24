<?php

include_once '../php/conn.php';


if (isset($_POST['save'])) {

	$acc_id = $_POST['acc_id'];
	$c_password = $_POST['current_password'];
	$new_password = $_POST['new_password'];
	$nc_password = $_POST['new_confirm_password'];


	$chg_pwd = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '$acc_id'");
	$chg_pwd1 = mysqli_fetch_array($chg_pwd);

	$data_pwd = $chg_pwd1['password'];


	if ($data_pwd ==$c_password) {

		if ($new_password ==$nc_password) {

			$update_pwd = "UPDATE accounts SET password ='$new_password' WHERE acc_id ='$acc_id'";
			$update_pwd_run = mysqli_query($sqlcon,$update_pwd);

			if ($update_pwd_run) {
				
				header("Location:dashboard.php?adsuccess");

			}
			else{
				header("Location:change_password.php?aderror");
			}
		}
		else{
			echo mysqli_error($sqlcon);
		}
	}
	else{
		header("Location:change_password.php?aderror");
	}
}
?>