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
	<title>Change Password</title>
	<!-- Boostrap 5.2 -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/home.css">
	<!-- Box Icons-->
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<!-- Font Awesome-->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<!-- System Logo -->
    <link rel="icon" href="../assets/pics/system-ico.ico">
    <style>
       .dp .dropdown-toggle::after {
            content: none;
        }
        .dp .dropdown-list{
            left: -90px;
        }
         .navbar .breadcrumb li a{
          color: #8C0000;
        }
    </style>
</head>
<body  style="background-color: rgb(229, 229, 229);">
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
				<div class="flex-shrink-0 text-center">
                     <div class="dropdown dp">
                        <a class="text-reset dropdown-toggle text-decoration-none" href="#"id="navbarDropdownMenuLink" role="button"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell fa-lg"></i>
                            <span class=" top-0 start-100 translate-middle badge rounded-pill badge-notification bg-danger">1</span>
                        </a>
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="border-radius: 10px;">
                            <h6 class="dropdown-header text-dark ">Notifications</h6>
                            <a class="dropdown-item d-flex align-items-center" href="notification.php">
                                <div class="me-4">
                                     <div class="fa-stack fa-1x">
                                      <i class="fa fa-circle fa-stack-2x ms-2"></i>
                                      <i class="fas fa-user fa-stack-1x ms-2 text-white" ></i>
                                    </div> 
                                </div>
                                <div class="fw-bold">
                                    <div class="small text-gray-500">September 16, 2022</div>
                                    <span class="font-weight-bold">Sir pagcaliwagan added an exam</span>
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="notification.php">Show All Notifications</a>
                        </div>
                    </div>
                </div>
				<div class="flex-shrink-0 dropdown pe-5 text-center">
					<button class="btn  dropdown-toggle border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
			          <?php

			              $query_row = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id= '{$_SESSION['acc_id']}' ");
			               while ($rows = mysqli_fetch_assoc($query_row)) {
			            echo'<span><img class="me-2 rounded-circle" src="data:image;base64,'.base64_encode($rows["image_size"]).'" height="40px;" width="40px;"> '.$_SESSION["first_name"].'</span>';
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
				<div class="modal-header flex-column border-0 bg-warning">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  <div class="icon-box mt-2">
					  	<i class="fas fa-exclamation-circle fa-6x text-dark"></i>
					  </div> 
				</div>
				<div class="modal-body flex-column">
					<p class="fs-5 modal-title mt-3 text-center">The action are you going to perform is irrevesible. Please confirm!</p>
					  <p class="fs-5 mt-2 text-center">Are you sure that you want to logout?</p>
				</div>
				<div class="modal-footer d-flex justify-content-center border-0 mb-2">
					<form action="../php/logout_students.php" class="hide" method="POST" class="text-center">
						<input type="hidden" name="id" value="<?php echo $_SESSION['acc_id']  ?>">
						<input type="hidden" name="times" value="<?php echo $_SESSION['login_id']  ?>">
                        <button type="submit" class="btn btn-success mx-2 px-5 pb-2 rounded-pill">YES</button>
                        <button type="button" class="btn btn-danger mx-2 px-5 pb-2 rounded-pill" data-bs-dismiss="modal">NO</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--Main Content-->
	<div class="container-fluid py-3 ">
		<div class="row">
			<div class="col-lg-4">
				<div class="card ms-2">
					<div class="card-body">
						<div class="card m-2" style="background-color: rgb(254, 255, 191);">
							<div class="card-body mb-3">
								<h5 class=" fw-bold text-uppercase"style="color: #8C0000;">Terms and Conditions:</h5>
								<div class="rows m-4 fs-6">
									<p>&bull; If this is your FIRST TIME accessing the Automated Licensure Examination Reviewer, students are advised to change their password immediately for privacy and security purposes.</p>
									<p>&bull; The password must be at least eight (8) characters long.</p>
									<p>&bull; The password must have three different kinds of characters. These are upper case letters, lower case letters and numbers.</p>
									<p>&bull; Don’t use special characters, especially not %, ¤ or Scandinavian characters</p>
									<p>&bull; The password must not be too similar to your old password.</p>
									<p>&bull; Note! Please notice! If you are using Sparknet with your own account, create a password with only characters: a-z, A-Z and numbers 0-9.</p>
									<p>&bull; It is recommended to use Eduroam if that is available.</p>
									<p>&bull; It's recommended to use Google Chrome or Mozilla Firefox when changing the password (supported browsers).</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="card">
					<div class="card-header fs-3 text-uppercase fw-bold" style="color: #8C0000;"> Change Password</div>
					<div class="card-body">
						<form method="POST" action="change_pass_user.php">
							<div class="form-group mb-4 fs-5 row">
								<label for="password" class="col-md-4 fw-bold col-form-label text-md-right">Current Password</label>
								<div class="col-md-6">
									<input type="hidden" name="acc_id" value="<?php echo $_SESSION['acc_id']; ?>">
									<input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
								 </div>
							</div>
							<div class="form-group fs-5 mb-4 row">
								<label for="password" class="col-md-4 fw-bold col-form-label text-md-right">New Password</label>
								<div class="col-md-6">
									<div class="input-group">
										<input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password" >
									    <span class="input-group-text ps-5 mx-auto bg-white" id="basic-addon2"><i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i></span>
									</div>
								</div>
							</div>
							<div class="form-group fs-5 mb-4 row">
								<label for="password" class="col-md-4 fw-bold col-form-label text-md-right">New Confirm Password</label>
								<div class="col-md-6 mb-4">
									<div class="input-group">
										<input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
										<span class="input-group-text ps-5 mx-auto bg-white" id="basic-addon2"><i class="far fa-eye" id="togglePass" style="margin-left: -30px; cursor: pointer;"></i></span>
									</div>
									<div id="CheckPasswordMatch" class="fw-bold fs-6 mt-3 text-center"></div>
								</div>
							</div>
							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-6">
									<button type="submit" name="save" class="btn btn-success btn-lg pb-2 px-5">SUBMIT </button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer -->
  <footer class="text-center text-lg-start text-white ft mt-3">
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
   
</body>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>	
	
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
<script type="text/javascript">
	const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#new_password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>
<script type="text/javascript">
  const togglePass = document.querySelector('#togglePass');
  const pass = document.querySelector('#new_confirm_password');

  togglePass.addEventListener('click', function (e) {
    // toggle the type attribute
    const set = pass.getAttribute('type') === 'password' ? 'text' : 'password';
    pass.setAttribute('type', set);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>
<script>
$(document).ready(function () {
	$("#new_confirm_password").on('keyup', function(){
		var password = $("#new_password").val();
		var confirmPassword = $("#new_confirm_password").val();
		if (password == confirmPassword) {
			$("#CheckPasswordMatch").html("Password match!").css("color","green");
		}
		else if (password != confirmPassword){
			$("#CheckPasswordMatch").html("Password does not match!").css("color","red");
		}
		else if (  confirmPassword == " "){
			$("#CheckPasswordMatch").html("!").css("color","red");
		}
		else if ( password == "") {
			$("#CheckPasswordMatch").html("!").css("color","red");
		}
		else {
			return false;
		}
	});
});
</script>

<?php 
#add accounts
if (isset($_GET['adsuccess'])) {
	echo ' <script> swal("Password Changed!", " clicked the okay!", "success");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/student/change_password.php");
	</script>';
}
elseif (isset($_GET['aderror'])) {
	echo ' <script> swal("Error Password. Please try again!", " clicked the okay!", "error");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/student/change_password.php");
	</script>';
}

?>
</html>