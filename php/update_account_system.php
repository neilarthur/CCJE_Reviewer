w<?php

session_start();

require_once 'conn.php';

if (isset($_POST['save'])) {
  $update_id = $_POST['update_id'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $middle_name=$_POST['mid_name'];
  $user_id=$_POST['user_id'];
  $gender=$_POST['gender'];
  $age=$_POST['age'];
  $section = $_POST['section'];
  $email_address = $_POST['email_address'];
  $mobile_no = $_POST['mobile_no'];
  $address = $_POST['address'];
  $c_password = $_POST['c_password'];
  $new_password = $_POST['new_password'];
  $conf_password = $_POST['conf_password'];
  $type = $_POST['type'];



  if (!empty($_FILES['image']['name'])) {

    $image_name = $_FILES['image']['name'];
    $image_Data =addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $image_type =$_FILES['image']['type'];

    if (substr($image_type,0,5)=="image") {

      if ($new_password =="") {
           $query= "UPDATE accounts SET first_name='$first_name', last_name='$last_name', middle_name='$middle_name', user_id='$user_id', gender='$gender', age='$age', section='$section', email_address='$email_address', mobile_no='$mobile_no', address='$address',image='$image_name',image_size='$image_Data' WHERE acc_id = '$update_id' ";
           $query_run = mysqli_query($sqlcon,$query);
      }
      else{
         $query= "UPDATE accounts SET first_name='$first_name', last_name='$last_name', middle_name='$middle_name', user_id='$user_id', gender='$gender', age='$age', section='$section', email_address='$email_address', mobile_no='$mobile_no', address='$address', password='$new_password', image='$image_name',image_size='$image_Data' WHERE acc_id = '$update_id' ";
           $query_run = mysqli_query($sqlcon,$query);
      }

      if ($type='student') {
        
        if ($query_run) {

          header("Location:../system_admin/accounts.php?upsuc&tab-accounts=students");

        }
        else {

          header("location: ../system_admin/accounts.php?upsucer&tab-accounts=students");
        }
      }
      elseif ($type='faculty') {
        if ($query_run) {

          header("location:../system_admin/accounts.php?upsuc&tab-accounts=faculty");

        }
        else {

          header("Location: ../system_admin/accounts.php?upsucer&tab-accounts=faculty");

        }
      }
      else {

        echo mysqli_error($sqlcon);
      }
    }
  }
  else {

    $queries= "UPDATE accounts SET first_name='$first_name', last_name='$last_name', middle_name='$middle_name', user_id='$user_id', gender='$gender', age='$age', section='$section', email_address='$email_address', mobile_no='$mobile_no', address='$address', password='$new_password' WHERE acc_id = '$update_id' ";

    $queries_run = mysqli_query($sqlcon,$queries);

    if ($type='faculty') {

      if ($query_run) {
        header("location: ../system_admin/accounts.php?error&tab-accounts=faculty");

      }
      else {
        header("Location:../system_admin/accounts.php?suc&tab-accounts=faculty");
        
      }
    }
    elseif ($type='student') {

      if ($query_run) {

        header("location:../system_admin/accounts.php?upsuc&tab-accounts=students");

      }
      else {

        header("Location: ../system_admin/accounts.php?upsucer&tab-accounts=students");

      }
    }
    else {

      echo mysqli_error($sqlcon);
    }
  }
}  
?>