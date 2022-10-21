<?php

require_once 'conn.php';

if (isset($_POST['save'])) {
  $update_id = $_POST['update_id'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $middle_name=$_POST['mid_name'];
  $user_id=$_POST['user_id'];
  $gender=$_POST['gender'];
  $age=$_POST['age'];
  $year=$_POST['year'];
  $section = $_POST['section'];
  $email_address = $_POST['email_address'];
  $mobile_no = $_POST['mobile_no'];
  $address = $_POST['address'];
  $password = $_POST['password'];

  if (!empty($_FILES['image']['name'])) {
    
      $image_name = $_FILES['image']['name'];
      $filesize = $_FILES['image']['size'];
      $image_Data =addslashes(file_get_contents($_FILES['image']['tmp_name']));
      $image_type =$_FILES['image']['type'];

      if (substr($image_type,0,5)=="image") {

        $query= "UPDATE accounts SET first_name='$first_name', last_name='$last_name', middle_name='$middle_name', user_id='$user_id', gender='$gender', age='$age', year='$year', section='$section', email_address='$email_address', mobile_no='$mobile_no', address='$address', password='$password', image='$image_name',image_size='$image_Data' WHERE acc_id = '$update_id' ";

        $query_run = mysqli_query($sqlcon, $query);

        if ($query_run) {
          header("Location: ../faculty/accounts_manage.php?upsuc");
        }
        elseif ($filesize > 1000000) {
          echo "<script> alert('Image size is too large'); </script>";
        }
        else{
           header("Location: ../faculty/accounts_manage.php?adderror");
        }        
      }
      else{
        echo mysqli_error($sqlcon);
      }
  }
  else {
    $query= "UPDATE accounts SET first_name='$first_name', last_name='$last_name', middle_name='$middle_name', user_id='$user_id', gender='$gender', age='$age', year='$year', section='$section', email_address='$email_address', mobile_no='$mobile_no', address='$address' WHERE acc_id = '$update_id' ";

    $query_run = mysqli_query($sqlcon, $query);

    if ($query_run) {
       header("Location: ../faculty/accounts_manage.php?upsuc");
    }
    else{
       header("Location: ../faculty/accounts_manage.php?adderror");
    }
  }
}  
?>

