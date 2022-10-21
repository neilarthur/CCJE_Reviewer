<?php

require_once 'conn.php';

if (isset($_POST["save"])) {
	
	$first_name = $_POST['first_name'];
	$middle_name = $_POST['middle_name'];
	$last_name = $_POST['last_name'];
	$role = $_POST['role'];
	$birth_date = $_POST['birth_date'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];
	$user_id = $_POST['user_id'];
	$year = $_POST['year'];
	$section = $_POST['section'];
	$email_address = $_POST['email_address'];
	$mobile_no = $_POST['mobile_no'];
	$address =$_POST['address'];
	$password = $_POST['password'];


	$image = $_FILES['image']['name'];
	$image_Data =addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$image_type =$_FILES['image']['type'];
	


  if (substr($image_type,0,5)=="image") {
	$sql_run = "INSERT INTO accounts (first_name,middle_name,last_name,role,birth_date,age,gender,user_id,year,section,email_address,mobile_no,address,image,image_size,password) VALUES ('$first_name','$middle_name','$last_name','$role','$birth_date','$age','$gender','$user_id','$year','$section','$email_address','$mobile_no','$address','$image_name','$image_Data','$password')";


	$sql_rows = mysqli_query($sqlcon, $sql_run);

	if ($sql_rows) {
		
		header("location:../faculty/accounts_manage.php?addsuccess");
	}
	else{

    header("Location: ../faculty/accounts_manage.php?adderror");
  }

  }
  else {
		echo mysqli_error($sqlcon);
	}
}

?>