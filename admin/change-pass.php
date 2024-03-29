<?php

session_start();
include_once '../php/conn.php';

if (!isset($_SESSION["login"]) || $_SESSION['login'] !=true) {
    header("location: ../php/index.php");
     exit;
}
elseif (!isset($_SESSION["role"]) || $_SESSION['role'] !='admin') {
    header("location: ../php/index.php");
    exit;
}


if (isset($_POST['submit'])) {

	$acc_id = $_POST['acc_id'];
	$c_password = $_POST['c_password'];
	$new_password = $_POST['new_password'];
	$conf_password = $_POST['conf_password'];



	$change_pass = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '$acc_id'");
	$change_pass1 = mysqli_fetch_array($change_pass);

	$acc_pass = $change_pass1['password'];


	if ($acc_pass ==$c_password) {

		if ($new_password ==$conf_password) {

			$update_password = "UPDATE accounts SET password ='$new_password' WHERE acc_id = '$acc_id'";
			$update_1 = mysqli_query($sqlcon,$update_password);

			if ($update_1) {
				header("Location:dashboard.php?changesuc");
			}
			else{
				header("location:change-pass.php?changeerror");
			}
		}
		else{
			
			echo mysqli_error($sqlcon);
		}
	}
	else{
		header("location:change-pass.php?changeerror");
	}


}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<!-- Boostrap 5.2 -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- Password Requirements CSS -->
    <link rel="stylesheet" href="../css/jquery.passwordRequirements.css" />
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/dash.css">
	<link rel="stylesheet" href="../css/demo.css" />
	<!-- Box Icons-->
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<!-- Font Awesome-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"rel="stylesheet"/>
	<!-- System Logo -->
    <link rel="icon" href="../assets/pics/system-ico.ico">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>	
    <script src="../js/jquery.passwordRequirements.min.js"></script>
	<style>
       .dp .dropdown-toggle::after {
            content: none;
        }
        .navbar .breadcrumb li a{
		  color: #8C0000;
		}
    </style>
</head>
<body style="background: rgb(230, 230, 230);">
	<div class="sidebar close">
		<div class="logo-details mt-2">
			<img src="../assets/pics/CCJE.png" alt="" width="50" height="50" class="d-inline-block align-top ms-3 bg-white rounded-circle" ><span class="logo_name ms-2">CCJE Reviewer</span>
		</div>
		<hr style="color:rgb(255, 255, 255);">
		<ul class="nav-links fw-bolder">
			<li class="navigation-list-item">
				<a href="dashboard.php">
					<i class="fas fa-tachometer-alt"></i>
					<span class="link_name">Dashboard</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="dashboard.php">Dashboard</a></li>
				</ul>
			</li>
			<li class="navigation-list-item">
				<a href="analytics.php">
					<i class='bx bx-pie-chart-alt-2 bx-sm' ></i>
					<span class="link_name">Analytics</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="analytics.php">Analytics</a></li>
				</ul>
			</li>
			<li>
			<li class="navigation-list-item">
				<a href="exam-manage.php">
					<i class='bx bx-spreadsheet bx-sm'></i>
					<span class="link_name">Exam Managment</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="exam-manage.php">Exam Management</a></li>
				</ul>
			</li>
			<li class="navigation-list-item">
				<a href="results.php">
					<i class="fas fa-poll"></i>
					<span class="link_name">Results</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="results.php">Results</a></li>
				</ul>
			</li>
			<li class="navigation-list-item">
				<a href="accounts.php?tab-accounts=students">
					<i class='bx bxs-user-account bx-sm' ></i>
					<span class="link_name">Accounts</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="accounts.php?tab-accounts=students">Accounts</a></li>
				</ul>
			</li>
			<li class="navigation-list-item">
				<a href="login-history.php" >
					<i class="fas fa-history"></i>
					<span class="link_name">Log History</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="login-history.php">Log History</a></li>
				</ul>
			</li>
			<li class="navigation-list-item">
                <a href="archive_users.php?tab-accounts=students" >
                    <i class="fas fa-archive"></i>
                    <span class="link_name">Archived</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="archive_users.php?tab-accounts=students">Archived</a></li>
                </ul>
            </li>
			<li class="navigation-list">
				<div class="profile-details">
					<?php

                    $query_row = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id= '{$_SESSION['acc_id']}' ");
                     while ($rows = mysqli_fetch_assoc($query_row)) {
                     	echo '
                     						<div class="profile-content">
						<img class="rounded-circle" src="data:image;base64,'.base64_encode($rows["image_size"]).'" alt="profileImg">
					</div>
                     	';
                     	?>

					<?php }

                    ?>
						<div class="name-job">
							<div class="profile_name"><a class="profile text-warning" href="profile.php?acc_id=<?php echo $_SESSION["acc_id"] ?>"><?php echo $_SESSION["first_name"];?></a></div>
							<div class="job text-capitalize"><?php echo $_SESSION["role"];  ?></div>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<section class="home-section float-start" >
			<div class="home-content d-flex justify-content-between" style="background: white;">
				<div class="d-flex">
					<button style="border-style: none; background: white; height: 60px;" class="mt-1">
						<i class='bx bx-menu' ></i>
					</button>
					<nav class="navbar navbar-expand-lg navbar-light" style="margin-top: 10px; margin-left: 12px;">
						<div class="container-fluid">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashboard.php" style="text-decoration: none;">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Change Password</li>
								</ol>
							</nav>
						</div>
					</nav>
				</div>
				<form class="d-flex">
					<div class="dropdown dp mt-3 me-2">
	                    <a class="text-reset dropdown-toggle text-decoration-none position-relative" href="#"id="navbarDropdownMenuLink" role="button"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell fa-lg mx-2"></i>
	                        <div id="count_wrapper">
	                            
	                        </div>
	                    </a>
	                    <div class="dropdown-list bg-light dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="border-radius: 10px;">
	                        <p class="h5 dropdown-header text-dark ">Notifications</p>
	                          <div style="overflow-y: auto; white-space: nowrap; height: auto; max-height: 300px;" class="bg-white">
	                             <div id="wrapper">
	                                 
	                             </div> 
	                          </div>
	                        <a class="dropdown-item text-center small text-gray-500" href="notification.php">Show All Notifications</a>
	                    </div>
	                </div>
		            <div class="dropdown mx-2">
		                <button class="btn  dropdown-toggle border border-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
		                <?php

		                    $query_row = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id= '{$_SESSION['acc_id']}' ");
		                     while ($rows = mysqli_fetch_assoc($query_row)) {
		                  echo'<span><img class="me-2 rounded-circle" src="data:image;base64,'.base64_encode($rows["image_size"]).'" height="40px;"></span>';
		                  ?>
		               <?php }

		                ?>
		                </button>
		                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
		                    <li><a class="dropdown-item" href="profile.php?acc_id=<?php echo $_SESSION["acc_id"] ?>"><i class="fas fa-user-circle fa-lg me-2" style="color: #8C0000;"></i> Profile</a></li>
		                    <li><a class="dropdown-item" href="change-pass.php"><i class="fas fa-lock fa-lg me-2" style="color: #8C0000;"></i> Change Password</a></li>
		                    <li><a class="dropdown-item" href=""data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fas fa-sign-out-alt fa-lg me-2" style="color: #8C0000;"></i> Log out</a></li>
		                </ul>
		            </div>
		        </form>
			</div>
			<!-- Main Content-->
			<div class="container-fluid py-5 px-5">
				<div class="card h-100">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-5">
								<img class="img-fluid center" alt="" id="picture" src="../assets/pics/change.jpg "width="800" height="800"/>
							</div>
							<div class="col-lg-7 pe-5">
								<form method="POST" action="change-pass.php">
									<div class="card h-100 mt-4 shadow">
										<div class="card-body m-2">
											<h4 class=" fw-bolder mb-3 text-uppercase text-center text-primary" style="font-family: 'Nunito', sans-serif;">Change Password</h4>
											<div class="mb-3">
												<input type="hidden" name="acc_id" value="<?php echo $_SESSION['acc_id'] ?>">
												<label for="password" class="fw-bold mb-2">Enter Current Password:</label>
												<div class="input-group">
													<input type="password" class=" form-control" placeholder="Enter Current Password" id="Current_password" name="c_password" required>
													<span class="input-group-text ps-5 mx-auto bg-white" id="basic-addon2"><i class="far fa-eye" id="toggle" style="margin-left: -30px; cursor: pointer;"></i></span>
												</div>
											</div>
											<div class="mb-3">
												<label for="password" class="fw-bold mb-2">Enter New Password:</label>
												<div class="input-group">
													<input type="password" class="pr-password form-control" id="Password" placeholder="Enter New Password" name="new_password" required>
													<span class="input-group-text ps-5 mx-auto bg-white" id="basic-addon2"><i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i></span>
												</div>
											</div>
											<div class="mb-3">
												<label for="user" class="fw-bold mb-2">Confirm New Password:</label>
												<div class="input-group">
													<input type="password" class="form-control" id="ConfirmPassword" placeholder="Enter Confirm Password" name="conf_password" required>
													<span class="input-group-text ps-5 mx-auto bg-white" id="basic-addon2"><i class="far fa-eye" id="togglePass" style="margin-left: -30px; cursor: pointer;"></i></span>
												</div>
											</div>
											<div style="margin-top: 7px;" id="CheckPasswordMatch" class="fw-bold mb-2 ms-3"></div>
											<div class="d-flex justify-content-center ">
												<button class="btn btn-success text-uppercase px-5 pb-2" name="submit">Submit</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Logout Modal-->
	    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header flex-column border-0 bg-danger">
	                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	                    <div class="icon-box mt-2 mb-2">
	                        <i class="fas fa-exclamation-circle fa-5x text-white"></i>
	                    </div>
	                </div>
	                <div class="modal-body text-center mt-2">
	                    <h4 class="fw-bold">Do you really wish to leave or log out?</h4>
	                </div>
	                <div class="modal-footer border-0">
	                    <a href="../php/logout.php" class="btn btn-success mx-2">YES</a>
	                    <button type="button" class="btn btn-danger mx-2" data-bs-dismiss="modal">NO</button>
	                </div>
	            </div>
	        </div>
	    </div>
	    
</body>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
   let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
   arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  console.log(sidebarBtn);
  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
  });
</script>
<script>
/* trigger when page is ready */
    $(document).ready(function (){
        $(".pr-password").passwordRequirements({

        });
    });
</script>
<script type="text/javascript">
	const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#Password');

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
  const pass = document.querySelector('#ConfirmPassword');

  togglePass.addEventListener('click', function (e) {
    // toggle the type attribute
    const set = pass.getAttribute('type') === 'password' ? 'text' : 'password';
    pass.setAttribute('type', set);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>
<script type="text/javascript">
  const toggle = document.querySelector('#toggle');
  const c_password = document.querySelector('#Current_password');

  toggle.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = c_password.getAttribute('type') === 'password' ? 'text' : 'password';
    c_password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>
<script>
  function loadXMLDocs() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("count_wrapper").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", "notif_num.php", true);
  xhttp.send();
}
setInterval(function(){
    loadXMLDocs();
    // 1sec
},100);

window.onload = loadXMLDocs;

</script>
<script >
    function load() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("wrapper").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", "notif_wrapper.php", true);
  xhttp.send();
}
setInterval(function(){
    load();
    // 1sec
},100);

window.onload = load;
</script>
<script>
$(document).ready(function () {
	$("#ConfirmPassword").on('keyup', function(){
		var password = $("#Password").val();
		var confirmPassword = $("#ConfirmPassword").val();
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
 <script type="text/javascript">
    $(document).ready(function(){
        $("#navbarDropdownMenuLink").on("click",function(){
            $.ajax({
                url:"view_notification.php",
                success: function(comers){
                    console.log(comers);
                }
            });
        });
    });
</script>
 <?php

#Change Pass
 
if (isset($_GET['changesuc'])) {
	echo ' <script> swal("Password Changed!", " clicked the okay!", "success");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/admin/change-pass.php");
	</script>';
}
elseif (isset($_GET['changeerror'])) {
	echo ' <script> swal("Error Password. Please try again!", " clicked the okay!", "error");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/admin/change-pass.php");
	</script>';
}

 
?>
</html>