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
	<title>Preboard Exam</title>
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
	<!--Main Content-->
	<div class="container py-4">
		<div class="row">
			<div class="card mb-3"style="background-color: #8C0000;;">
				<div class="card-body">
					<h2 class="fw-bold text-white text-uppercase">Preboard Examination</h2>
				</div>
			</div>
			<div class="card">
				<div class="card-body m-3 table-responsive-lg">
					<table class="table table-striped align text-center">
						<thead class="fs-5">
							<tr>
								<th scope="col">Area of Exam</th>
								<th scope="col">Number of Items</th>
								<th scope="col">Time Limit</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php

							

							$code = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question");

							while ($rows = mysqli_fetch_assoc($code)) { ?>
							
							<tr>
								<td><?php echo $rows['subjects']; ?></td>
								<td><?php echo $rows['total_question']; ?></td>
								<td><?php echo $rows['time_limit']; ?></td>
								<td>
									<button class="btn btn-success text-uppercase"><a href="#" class="text-white" data-bs-toggle="modal" data-bs-target="#access" style="text-decoration: none;"><i class='bx bxs-hourglass-top me-2'></i>Start</a></button>
								</td>
							</tr>
							<?php } ?>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="access" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h4 class="modal-title mx-3">Access Code</h4>

                <form action="student_access.php" method="POST">
                    <div class="modal-body">
                               <?php if (isset($_GET['error'])) { ?>
                  <p class="error"><center><b style="color: red;"><?php echo $_GET['error'];  ?></b></center></p>
                <?php }  
                ?>
                        <div class="form-group d-flex justify-content-center">
                        	<input type="hidden" name="acc_id" value="<?php echo $_SESSION['acc_id']; ?>">
                            <input type="text" class="form-control" name="access_code" placeholder="Enter Access Code">
                            
                        </div>
                        <div class="modal-footer d-flex justify-content-center border-0">
                            <input type="submit" name="save" class="btn btn-success px-5 pb-2 text-white" value="Enter">
                        </div>
                    </div>
                </form>
            </div>
        </div>
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