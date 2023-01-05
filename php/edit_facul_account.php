<?php

session_start();

require_once 'conn.php';


$userid =  $_POST['userid']; 

$say =  "SELECT * FROM accounts WHERE acc_id= '$userid'";

$results = mysqli_query($sqlcon, $say);

while ($row = mysqli_fetch_array($results)) {

  echo '<div class="container">
  <form class="form" method="post" action="../php/update_facul_account.php"  enctype="multipart/form-data">
    <div class="col">
        <div class="row">
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 py-2 me-5">
         
          <img src="data:image;base64,'.base64_encode($row["image_size"]).'" id="iset"  class=" rounded-circle flex justify-content-start"  height="200px;" width="200px;" style=" object-fit: cover;">
          <label for="image_browser" class="d-flex justify-content-center ps-1 mt-2">Attach Picture</label>
          <input type="file" name="image" class="form-control mt-2" id="file_namew"  accept=".jpg, .jpeg, .png">
          ';
?>



        </div>
        <div class="col-xl-7 col-lg-6 col-md-6 col-sm-6 py-2">
           <input type="hidden" class="form-control" name="update_id" value="<?php echo $row['acc_id']; ?>">
          <label for="user-last" class="d-flex ps-1 justify-content-center">Last Name</label>
          <input type="text" name="last_name" class="form-control text-center"value="<?php echo $row['last_name']; ?>">

          <label for="user-first" class="d-flex ps-1 justify-content-center">First Name</label>
          <input type="text" name="first_name" class="form-control text-center" value="<?php echo $row['first_name']; ?>">

          <label for="user-middle" class="d-flex  ps-1 justify-content-center">Middle Name</label>
          <input type="text" name="mid_name"  class="form-control text-center" value="<?php echo $row['middle_name']; ?>">
        </div>
        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 py-2">
          <label for="user-id" class="d-flex ps-1">Role</label>
          <input type="text" name="role" value="<?php echo $row['role']; ?>" class="form-control" readonly >
        </div>
        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 py-2">
          <label for="user-id" class="d-flex ps-1">Student ID:</label>
          <input type="number" name="user_id" value="<?php echo $row['user_id']; ?>" class="form-control">
        </div>
        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 py-2">
          <label for="user-bday" class="d-flex ps-1">Birthdate</label>
          <input type="date" name="birth_date" class="form-control" value="<?php echo $row['birth_date']; ?>" >

        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-sm-6 py-2">
          <!--empty -->
          <label for="user-sex" class="d-flex ps-1">Gender</label>
          <input type="text" name="gender" value="<?php echo $row['gender']; ?>" class="form-control" >
        </div>
        <div class="col-xl-3 col-lg-5 col-md-12 col-sm-12 py-2">
          <label for="user-age" class="d-flex justify-content-center ps-1">Age</label>
          <input type="number" name="age" class="form-control text-center" value="<?php echo $row['age']; ?>">
        </div>
        <div class="col-xl-3 col-lg-5 col-md-12 col-sm-12 py-2">
          <label for="user-section" class="d-flex ps-1">Year & Section</label>
          <input type="text" name="section" class="form-control" value="<?php echo $row['section']; ?>">
        </div>
        <div class="col-xl-3 col-lg-5 col-md-12 col-sm-12 py-2">
          <label for="user-mobile" class="d-flex  ps-1">Mobile Number</label>
          <input type="number" name="mobile_no" value="<?php echo $row['mobile_no']; ?>" class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 py-2">
          <!--empty -->
          <label for="user-email" class="d-flex ps-1">Email Address</label>
          <input type="text" name="email_address" value="<?php echo $row['email_address']; ?>" class="form-control">
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 py-2">
          <label for="user-password" class="d-flex ps-1">Password</label>
          <input type="password" name="password" class="form-control" value="<?php echo $row['password']; ?>">
        </div>
     </div> 
     <div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 py-2">
          <label for="user-add" class="d-flex ps-1">Address</label>
          <textarea class="form-control" name="address" rows="1"><?php echo $row['address']; ?></textarea>
          <input type="hidden" name="log_id" value="<?php  echo $_SESSION['acc_id']; ?>">
        </div>     
    <div class="modal-footer border-0 mt-3 d-flex justify-content-center">
      <button type="submit" name="save" class="btn btn-success px-4 pb-2 text-white"><i class="fas fa-save me-2"></i>Save Change</button>
      <button type="button" class="btn btn-danger btn  px-5 pb-2 text-white" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>Close</button>
    </div>
  </form>
</div>


 <script type="text/javascript">
  file_namew.onchange = evt => {
    const [file] = file_namew.files;
    if (file) {
      iset.src = URL.createObjectURL(file);

    }
  }
 </script>

<?php } ?>