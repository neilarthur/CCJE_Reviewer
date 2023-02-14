<?php

require_once 'conn.php';

if (isset($_POST["save"])) {
	
	$first_name = $_POST['first_name'];
	$middle_name = $_POST['mid_name'];
	$last_name = $_POST['last_name'];
	$role = $_POST['role'];
	$birth_date = $_POST['birth_date'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];
	$user_id = $_POST['user_id'];
	$section = $_POST['section'];
	$email_address = $_POST['email_address'];
	$mobile_no = $_POST['mobile_no'];
	$address =$_POST['address'];
	$password = $_POST['password'];
	$category =$_POST['category'];

	$status = "active";
	$verify_status="verified";

	$image_name = $_FILES['image']['name'];

	$image_Data =addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$image_type =$_FILES['image']['type'];
	

	if (substr($image_type,0,5)=="image") {

		$email_query = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE email_address = '$email_address'");

		if (mysqli_num_rows($email_query) > 0) {

			echo "EMAIL IS ALREADY BEEN TAKEN";
		}
		else
		{
			$sql_run = "INSERT INTO accounts (first_name,middle_name,last_name,role,birth_date,age,gender,user_id,section,email_address,mobile_no,address,image,image_size,password,status,verify_status) VALUES ('$first_name','$middle_name','$last_name','$role','$birth_date','$age','$gender','$user_id','$section','$email_address','$mobile_no','$address','$image_name','$image_Data','$password','$status','$verify_status')";
			$sql_rows = mysqli_query($sqlcon, $sql_run);

			if ($category=='student') {
				if ($sql_rows) {
					header("Location: ../secretary/accounts.php?addsuccess&tab-accounts=students");
				}
				else{
					header("Location: ../secretary/accounts.php?adderror&tab-accounts=students");
				}
			}
			elseif ($category=='faculty') {
				if ($sql_rows) {
					header("Location: ../secretary/accounts.php?addsuccess&tab-accounts=faculty");
				}
		        else{

		          header("Location: ../secretary/accounts.php?adderror&tab-accounts=faculty");
		        }
	    	}
		}
	}
	else{
		echo mysqli_error($sqlcon);
	}
}

if (isset($_POST['check_submit_btn'])) {

	$email = $_POST['email_id'];

	$email_query = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE email_address = '$email'");

	if (mysqli_num_rows($email_query) > 0) {

		echo "EMAIL IS ALREADY BEEN TAKEN";
	}
	else
	{
		echo "AVAILABLE ";
	}

}

if (isset($_POST['check_btn'])) {

	$emails = $_POST['email_ids'];

	$email_query = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE email_address = '$emails'");

	if (mysqli_num_rows($email_query) > 0) {

		echo "EMAIL IS ALREADY BEEN TAKEN";
	}
	else
	{
		echo "AVAILABLE ";
	}

}

?>