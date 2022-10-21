<?php

require_once 'conn.php';

if (isset($_POST['submit'])) {
  $update_id = $_POST['acc_id'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $middlename=$_POST['middlename'];
  $id=$_POST['id'];
  $gender=$_POST['gender'];
  $age=$_POST['age'];
  $year=$_POST['year'];
  $section = $_POST['section'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $address = $_POST['address'];
 

  $query= "UPDATE accounts SET first_name='$firstname', last_name='$lastname', middle_name='$middlename', user_id='$id', gender='$gender', age='$age', year='$year', section='$section', email_address='$email', mobile_no='$mobile', address='$address'  WHERE acc_id = '$update_id' ";

  $query_run = mysqli_query($sqlcon, $query);


  if ($query_run) {
    echo '<script> alert("Data Updated");</script>';
    header("Location: ../student/profile.php?acc_id=$update_id");
  }
  else{

    echo mysqli_error($sqlcon);
  }
}  
?>