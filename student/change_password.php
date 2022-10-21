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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"rel="stylesheet"/>
</head>
<body  style="background-color: rgb(229, 229, 229);">
	<div class="header text-uppercase hd " >
		<div class="container-fluid py-3">
			<img src="../assets/pics/logo.png" alt="" width="75" height="75" class="d-inline-block align-top mt-2 ms-4" >
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
					<h5 class="modal-title"></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body align-items-center">
					<h4 class="fw-bold"><i class="fas fa-exclamation-triangle alert alert-danger me-2"></i>Do you really wish to leave or log out?</h4>
				</div>
				<div class="modal-footer border-0">
					<form action="../php/logout_faculty.php" class="hide" method="POST">
						<input type="hidden" name="id" value="<?php echo $_SESSION['acc_id']  ?>">
						<input type="hidden" name="times" value="<?php echo $_SESSION['login_id']  ?>">
						<div class="signout">
							<button type="submit" class="btn btn-success">YES</button>
							<button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">NO</button>
						</div>
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
									<input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
								</div>
							</div>
							<div class="form-group fs-5 mb-4 row">
								<label for="password" class="col-md-4 fw-bold col-form-label text-md-right">New Confirm Password</label>
								<div class="col-md-6 mb-4">
									<input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
								</div>
							</div>
							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-6">
									<button type="submit" name="save" class="btn btn-success btn-lg">SUBMIT </button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
   
</body>
<script src="../js/bootstrap.bundle.min.js"></script>
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

<?php 
#add accounts
if (isset($_GET['adsuccess'])) {
	echo ' <script> swal("Account has been Saved!", " clicked the okay!", "success");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/faculty/change_password.php");
	</script>';
}
elseif (isset($_GET['aderror'])) {
	echo ' <script> swal("Account has not saved!", " clicked the okay!", "error");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/faculty/change_password.php");
	</script>';
}

?>
</html>