<?php

session_start();
include_once '../php/conn.php';

if (!isset($_SESSION["login"]) || $_SESSION['login'] !=true) {
    header("location: ../php/index.php");
     exit;
}
elseif (!isset($_SESSION["role"]) || $_SESSION['role'] !='student') {
    header("location: ../php/index.php");
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<!-- Boostrap 5.2 -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/home.css">
	<!-- Box Icons-->
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<!-- Font Awesome-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"rel="stylesheet"/>
	<!-- JS Chart-->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body style="background-color: rgb(229, 229, 229);">
	<div class="header text-uppercase hd " >
		<div class="container-fluid py-3">
			<img src="../assets/pics/logo.png" alt="" width="80" height="80" class="d-inline-block align-top mt-2 ms-2" >
			<h3 class="text-white mt-3 ms-4" >Automated Licensure Examination Reviewer </h3>
			<span class="text-white text-center dep">College of Criminal Justice and Education</span>
		</div>
	</div>
	<!-- Top navbar-->
	<nav id="navbar-top" class="navbar navbar-expand-lg navbar-light fw-bold">
		<div class="container-fluid">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse ms-4" id="navbarTogglerDemo03">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0 pe-2">
					<li class="nav-item text-uppercase">
						<a class="nav-link" aria-current="page" href="dashboard.php">Home</a>
					</li>
					<li class="nav-item text-uppercase">
						<a class="nav-link " href="take_quiz.php">Take Quiz</a>
					</li>
					<li class="nav-item text-uppercase">
						<a class="nav-link " href="take_preboard.php">Pre-boad Exam</a>
					</li>
					<li class="nav-item text-uppercase">
					<a class="nav-link " href="test_results.php">Results</a> 
					</li>
				</ul>
				<div class="flex-shrink-0 dropdown px-4 text-center">
					<button class="btn  dropdown-toggle border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
			          <?php

			              $query_row = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id= '{$_SESSION['acc_id']}' ");
			               while ($rows = mysqli_fetch_assoc($query_row)) {
			            echo'<span><img class="me-2 rounded-circle" src="data:image;base64,'.base64_encode($rows["image_size"]).'" height="40px;"> '.$_SESSION["first_name"].'</span>';
			            ?>
			         <?php }

			          ?>
			          	
			        </button>
			        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
			        	<li><a class="dropdown-item" href="profile.php?acc_id=<?php echo $_SESSION["acc_id"] ?>"><i class="fas fa-user-circle fa-lg me-2" style="color: #8C0000;"></i> Profile</a></li>
			            <li><a class="dropdown-item" href="change_password.php"><i class="fas fa-lock fa-lg me-2" style="color: #8C0000;"></i> Change Password</a></li>
			            <li><a class="dropdown-item" href=""data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fas fa-sign-out-alt fa-lg me-2" style="color: #8C0000;"></i> Log out</a></li>
			        </ul>
			    </div>
			</div>
		</div>
	</nav>
	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header border-0">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
                 <div class="icon-box mt-2 mb-2 d-flex justify-content-center">
                    <i class="fa-solid fa-circle-question fa-5x text-danger"></i>
                </div>
				<div class="modal-body d-flex justify-content-center">
					<p class="h4 text-dark fw-bold">Do you really wish to leave</p>
				</div>
				<div class="modal-footer d-flex justify-content-center border-0">
					<form action="../php/logout_faculty.php" class="hide" method="POST" class="text-center">
						<input type="hidden" name="id" value="<?php echo $_SESSION['acc_id']  ?>">
						<input type="hidden" name="times" value="<?php echo $_SESSION['login_id']  ?>">
                        <button type="submit" class="btn btn-primary mx-2 px-5 pb-2">YES</button>
                        <button type="button" class="btn btn-danger mx-2 px-5 pb-2" data-bs-dismiss="modal">NO</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Main  Content-->
	<div class="container-fluid">
		<form action="../php/update_student_profile.php" method="POST">
			<div class="container py-4">
				<div class="row gutters">
					<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
						<!-- Profile -->
						<div class="card h-100 mb-4">
							<div class="card-body">
								<div class="account-settings">
									<div class="user-profile">
										<?php
											$info = $_GET['acc_id'];
									        $query_row = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id= '$info' ");
									         while ($rows = mysqli_fetch_assoc($query_row)) { 

									         	echo '<div class="d-flex flex-column align-items-center text-center p-3 py-5">
									         	<img src="data:image;base64,'.base64_encode($rows["image_size"]).'" id="imgss"  class="img-fluid img-thumbnail rounded-circle flex justify-content-start w-100 h-100"  style=" object-fit: cover;">
									         	';
									         	?>

											
												<input type="file" name="image" class="form-control" id="file_case" accept=".jpg, .jpeg, .png">

												<span class="fw-bold"><?php  echo $rows['first_name'] ?> <?php  echo $rows['last_name'] ?></span>
												<span class="text-black-30"><?php  echo $rows['email_address'] ?></span>
											</div>
											<?php }

								             ?>
									</div>
								</div>
							</div>
						</div>
					</div>
						<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 t">
						<div class="card h-100">
							<div class="card-body">
								<div class="row gutters m-3">
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<h3 class="mb-2 text-primary fw-bolder text-uppercase mb-4">Personal Information</h3>
									</div>
									<?php
									 $info = $_GET['acc_id'];
									 $query_row = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id= $info ");
									      while ($rows = mysqli_fetch_assoc($query_row)) { ?>

									<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label for="user-last">Lastname</label>
											<input type="hidden" name="acc_id" value="<?php echo $info?>">
											<input type="text" class="form-control" name="lastname" value="<?php  echo $rows['last_name'] ?>">
										</div>
									</div>
									<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label for="user-first">Firstname</label>
											<input type="text" class="form-control" name="firstname" value="<?php  echo $rows['first_name'] ?>">
										</div>
									</div>
									<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label for="user-middle">Middlename</label>
											<input type="text" class="form-control" name="middlename"value="<?php  echo $rows['middle_name'] ?>">
										</div>
									</div>
									<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label for="user-role">Role</label>
											<input type="text" class="form-control" name="role" value="<?php  echo $rows['role'] ?>">
										</div>
									</div>
									<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label for="user-bday">Birtdate</label>
											<input type="date" class="form-control" name="bday" value="<?php  echo $rows['birth_date'] ?>">
										</div>
									</div>
									<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label for="user-gender">Gender</label>
											<div class="input-group">
												<select class="form-select" required="" name="gender" value="">
													
													<option ><?php  echo $rows['gender'] ?></option>
													<?php 
													if ($rows['gender']== 'Male') {
														echo "<option >Female</option>";
													}
													elseif ($rows['gender']== 'Female') {
														echo "<option >Male</option>";
													}
													?>
													
												</select>
											</div>
										</div>
									</div>
									<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label for="phone">Age</label>
											<input type="number" class="form-control" name="age" value="<?php  echo $rows['age'] ?>" >
										</div>
									</div>
									<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label for="phone">Mobile Number</label>
											<input type="number" class="form-control" name="mobile" value="<?php  echo $rows['mobile_no'] ?>" >
										</div>
									</div>
									<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label for="user-email">Email Address</label>
											<input type="email" class="form-control" name="email" value="<?php  echo $rows['email_address'] ?>">
										</div>
									</div>
									<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label for="uder-id">ID No.</label>
											<input type="number" class="form-control" name="id" value="<?php  echo $rows['user_id'] ?>" >
										</div>
									</div>
									<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label for="user-year">Year</label>
											<input type="text" class="form-control"  name="year" value="<?php  echo $rows['year'] ?>">
										</div>
									</div>
									<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label for="user-section">Section</label>
											<input type="text" class="form-control" name="section" value="<?php  echo $rows['section'] ?>">
										</div>
									</div>
								</div>
								<div class="row gutters m-3">
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
										<label for="user-add">Address</label>
										<textarea class="form-control" name="address" rows="2" ><?php  echo $rows['address'] ?></textarea>
									</div>
								</div>
								<?php }

								 ?>
								<div class="row gutters">
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-center">
										<div class="text-right ">
											<button type="submit" id="submit" name="submit" class="btn btn-success btn-lg me-4 text-uppercase mx-5">Submit</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

</body>
<script src="../js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function(){
  window.addEventListener('scroll', function() {
      if (window.scrollY > 50) {
        document.getElementById('navbar-top').classList.add('fixed-top');
        // add padding top to show content behind navbar
        navbar_height = document.querySelector('.navbar').offsetHeight;
        document.body.style.paddingTop = navbar_height + 'px';
      } else {
        document.getElementById('navbar-top').classList.remove('fixed-top');
         // remove padding top from body
        document.body.style.paddingTop = '0';
      } 
  });
}); 
</script>
</html>