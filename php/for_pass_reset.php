<?php

session_start();

require_once 'conn.php';


if (isset($_POST['pass_forg'])) {

	$id = $_POST['id'];
	$new = $_POST['new_pass'];
	$conf = $_POST['c_pass'];

	if ($new == $conf) {

		$valid = "UPDATE accounts SET password='$new' WHERE email_address='$id'";
		$valid_run = mysqli_query($sqlcon,$valid);

		if ($valid_run) {
			
			header("location: index.php?forgot");
		}
		else {

			header("location: index.php");
		}
	}
	else {

		header("location:index.php");
	}


}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
	<!-- Boostrap 5.2 -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/home.css">
	<link rel="stylesheet" type="text/css" href="../css/index.css">
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Albert+Sans&family=Fira+Sans&family=Inter:wght@200&family=Libre+Baskerville&family=Mingzat&family=Montserrat:ital,wght@0,400;0,500;1,400&family=Roboto+Condensed:ital,wght@0,700;1,400&family=Russo+One&family=Source+Sans+Pro&family=Ubuntu:wght@700&display=swap" rel="stylesheet">
	<!-- Box Icons -->
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<!-- System Logo -->
	<link rel="icon" href="../assets/pics/system-ico.ico">
	<!-- Font Awesome -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"rel="stylesheet"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<body style="background-color: #f5f5f5;">
	<div class="header text-uppercase hd " >
		<div class="container-fluid py-3">
			<img src="../assets/pics/logo.png" alt="" width="80" height="80" class="d-inline-block align-top mt-2 ms-2" >
			<h3 class="text-white mt-3 ms-4" >Automated Licensure Examination Reviewer </h3>
			<span class="text-white text-center dep">College of Criminal Justice and Education</span>
		</div>
	</div>
	<nav id="navbar-top" class="navbar navbar-expand-lg navbar-light fw-bold text-uppercase">
		<div class="container-fluid">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse ms-4" id="navbarTogglerDemo03">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0 pe-2">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="../home.php">Home</a>
					</li>
					<li class="nav-item dropdown justify-content-start">
			            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Criminology
			            </a>
			            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
			              <li><a class="dropdown-item" href="crim.php">BS Criminology</a></li>
			              <li><a class="dropdown-item" href="college.php">College</a></li>  
			            </ul>
		            </li>
					<li class="nav-item">
						<a class="nav-link " href="about.php">About Us</a>
					</li>
				</ul>
				<div class="d-grid gap-2 d-md-auto justify-content-md-end me-4 ">
					<a class="btn text-white text-capitalize" href="index.php" style="background-color: #8C0000;">Log In<i class="fas fa-sign-in-alt ms-1"></i></a>
				</div>
			</div>
		</div>
	</nav>
	<!-- Log In form -->
	<div class="login-form mt-3">
		<form action="for_pass_reset.php" method="post" class="px-4">
			<div class="avatar mt-2">
				<img src="../assets/pics/CCJE.png" alt="">
			</div>
			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
				<input type="hidden" name="id" value="<?php echo $_GET['email']; ?>">
				<input type="password" name="new_pass" class="form-control" placeholder="Enter new password" required="required" autocomplete="off"  id="password-field">
				<span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password input-group-text bg-white mx-auto pt-2" style="padding-right: 30px;"></span>
			</div>
			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
				<input type="password" name="c_pass" class="form-control" placeholder="Confirm new password" required="required" autocomplete="off" id="password-view">
				<span toggle="#password-view" class="fa fa-fw fa-eye field-icon toggle-pass input-group-text bg-white mx-auto pt-2" style="padding-right: 30px;"></span>
			</div>
			<div class="d-grid gap-2 mt-2 mb-4">
				<input type="submit" name="pass_forg" class="btn btn-primary btn-lg rounded-pill" value="Send Password Reset Link">
			</div>
		</form>
	</div>


	 <!-- Footer -->
	  <footer class="text-center text-lg-start text-white ft mt-5">
	    <!-- Section: Social media -->
	    <section class="d-flex justify-content-between p-4" style="background-color: #8C0000;">
	      <!-- Left -->
	      <div class="me-5 ">
	        <h5>Get connected with us on social networks:</h5>
	      </div>
	      <!-- Left -->
	    </section>

	    <!-- Section: Links  -->
	    <section>
	      <div class="container text-center text-md-start mt-5">
	        <!-- Grid row -->
	        <div class="row mt-3">
	          <!-- Grid column -->
	          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
	            <!-- Content -->
	            <h6 class="text-uppercase fw-bold">College of Criminal Justice and Education LSPU Santa Cruz Campus</h6>
	            <hr class="mb-4 mt-0 d-inline-block mx-auto"style="width: 90%; background-color: #7c4dff; height: 2px"/>
	            <p>
	              Here you can use the links and contacts to learn more about 
	              the College of Criminal Justice and Education LSPU.
	            </p>
	          </div>
	        
	          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
	            <!-- Links -->
	            <h6 class="text-uppercase fw-bold">Useful links</h6>
	            <hr
	                class="mb-4 mt-0 d-inline-block mx-auto"
	                style="width: 100px; background-color: #7c4dff; height: 2px"
	                />
	            <p>
	              <a href="https://www.facebook.com/groups/LSPU.CRIMINOLOGY.SCC.Official" class="text-white"><i class='bx-fw bx bxl-facebook-circle me-2'></i> Facebook: @LSPU CRIMINOLOGY SCC Official</a>
	            </p>
	            <p>
	              <a href="#!" class="text-white"><p><i class="fas fa-envelope mr-3 me-2"></i>Email: marklito.repugia@lspu.edu.ph</a>
	            </p>
	          </div>
	         
	          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
	            <!-- Links -->
	            <h6 class="text-uppercase fw-bold">Contact</h6>
	            <hr
	                class="mb-4 mt-0 d-inline-block mx-auto"
	                style="width: 60px; background-color: #7c4dff; height: 2px"
	                />
	            <p><i class="fas fa-home mr-3 me-2"></i>ccje.scc@lspu.edu.ph</p>
	            <p><i class="fas fa-envelope mr-3 me-2"></i>marklito.repugia@lspu.edu.ph</p>
	          </div>
	          <!-- Grid column -->
	        </div>
	        <!-- Grid row -->
	      </div>
	    </section>
	    <!-- Section: Links  -->

	    <!-- Copyright -->
	    <div class="text-center p-3">
	      © 2022 Copyright: College of Criminal Justice and Education LSPU Sta. Cruz Campus
	    </div>
	    <!-- Copyright -->
	  </footer>
  <!-- Footer -->

</body>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>	

<script type="text/javascript">
$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>
<script type="text/javascript">
$(".toggle-pass").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>

</html>
