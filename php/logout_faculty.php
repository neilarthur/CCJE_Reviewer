<?php

require_once 'conn.php';

session_start();


if ($_SERVER["REQUEST_METHOD"]=="POST") {

	$ids = $_POST['acc_id'];

	$user_ac = "user has been logout";

	$last_id = $_SESSION['login_id'];


	$myDate = date("d-m-y h:i:s");


	$logout_Querry = "UPDATE logs SET action ='$user_ac', logout_time =  now() WHERE log_id = '$last_id'";
	$logs2 = mysqli_query($sqlcon,$logout_Querry);

	if ($logs2) {
		session_destroy();
		header("location:index.php");
    }
    else{
    	echo mysqli_error($sqlcon);
    }
}
?>