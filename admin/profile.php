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

?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<!-- Boostrap 5.2 -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/dash.css">
	<!-- Box Icons-->
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<!-- Font Awesome-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"rel="stylesheet"/>
	 <!-- Bootstrap CSS -->
	<link href="../css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/datatables-1.10.25.min.css" />
	<!-- System Logo -->
    <link rel="icon" href="../assets/pics/system-ico.ico">
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
					<span class="link_name">Exam Management</span>
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
									<li class="breadcrumb-item active" aria-current="page">Profile</li>
								</ol>
							</nav>
						</div>
					</nav>
				</div>
				<form class="d-flex">
					<div class="dropdown dp mt-3">
		                <a class="text-reset dropdown-toggle text-decoration-none" href="#"id="navbarDropdownMenuLink" role="button"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell fa-lg "></i>
		                    	                                                <?php 

                            $comers = mysqli_query($sqlcon,"SELECT * FROM tbl_notification  WHERE notif_status='0' AND action='Added an exam'  ORDER BY notif_id DESC");
                            ?>
                            <span class=" top-0 start-100 translate-middle badge rounded-pill badge-notification bg-danger"><?php echo mysqli_num_rows($comers); ?></span>
	                    </a>
	                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="border-radius: 10px;">
	                        <h6 class="dropdown-header text-dark ">Notifications</h6>
	                        	<?php

                                $comers = mysqli_query($sqlcon,"SELECT * FROM tbl_notification,accounts WHERE (tbl_notification.acc_id = accounts.acc_id) AND (accounts.role='faculty') AND (tbl_notification.action='Added an exam')");

                                if (mysqli_num_rows($comers)==0) {
                                    
                                    echo "<h5 class='text-center'>No notification Found</h5>";
                                }

                                if (mysqli_num_rows($comers) >= 0) {

                                    foreach ($comers as $item) {

                                ?>
                            <a class="dropdown-item d-flex align-items-center" href="notification.php">
	                            <div class="me-4">
	                                 <div class="fa-stack fa-1x">
	                                  <i class="fa fa-circle fa-stack-2x ms-2"></i>
	                                  <i class="fas fa-user fa-stack-1x ms-2 text-white" ></i>
	                                </div> 
	                            </div>
	                            <div class="fw-bold">
	                                <div class="small text-gray-500"><?php echo date('F j, Y, g:i a',strtotime($item['date_created'])); ?></div>
                                <span class="font-weight-bold"><?php

                                if ($item['gender'] == 'Male') {
                                    
                                    echo " Sir ".$item['first_name']." ".$item['last_name']." ".$item['action'].".";
                                }
                                elseif($item['gender']== 'Female') {

                                    echo " Ma'am ".$item['first_name']." ".$item['last_name']." ".$item['action'].".";
                                }
                                ?></span>
                            </div>

                            <?php

                                }
                            }
                            ?>
	                        </a>
	                        <a class="dropdown-item text-center small text-gray-500" href="notification.php">Show All Notifications</a>
	                    </div>
		            </div>
		            <div class="dropdown me-3">
		                <button class="btn  dropdown-toggle border border-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
		                <?php

		                    $query_row = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id= '{$_SESSION['acc_id']}' ");
		                     while ($rows = mysqli_fetch_assoc($query_row)) {
		                  echo'<span><img class="me-2 rounded-circle" src="data:image;base64,'.base64_encode($rows["image_size"]).'" height="40px;" width="40px;"  ></span>';
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
			<div class="container-fluid">
				<form action="../php/update_admin_profile.php" method="POST" enctype="multipart/form-data">
					<div class="container py-5">
						<div class="row gutters">
							<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
								<!-- Profile -->
								<div class="card h-100 mb-4">
									<div class="card-body">
										<div class="account-settings">
											<div class="user-profile">
												<div class="user-avatar">
													<?php
													$info = $_GET['acc_id'];
											        $query_row = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id= '$info' ");
											         while ($rows = mysqli_fetch_assoc($query_row)) { 

											         	echo '<div class="d-flex flex-column align-items-center text-center p-3 py-5">
											         	<img src="data:image;base64,'.base64_encode($rows["image_size"]).'" id="imgss"  class="img-thumbnail rounded-circle flex mb-2"  style=" object-fit: cover; height:200px; width:200px;">
											         	';
											         	?>

													
														<input type="file" name="image" class="form-control mb-2" id="file_case" accept=".jpg, .jpeg, .png">

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
							</div>
								<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12 t">
								<div class="card h-100">
									<div class="card-body">
										<div class="row gutters m-3">
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
												<h3 class="mb-2 text-primary fw-bold text-uppercase mb-4">Personal Information</h3>
											</div>
											<?php
											 $info = $_GET['acc_id'];
											 $query_row = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id= $info ");
											      while ($rows = mysqli_fetch_assoc($query_row)) { ?>

											<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 mb-2">
												<div class="form-group">
													<label for="user-last">Lastname</label>
													<input type="hidden" name="update_id" value="<?php echo $info?>">
													<input type="text" class="form-control" name="last_name" value="<?php  echo $rows['last_name'] ?>">
												</div>
											</div>
											<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 mb-2">
												<div class="form-group">
													<label for="user-first">Firstname</label>
													<input type="text" class="form-control" name="first_name" value="<?php  echo $rows['first_name'] ?>">
												</div>
											</div>
											<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 mb-2">
												<div class="form-group">
													<label for="user-middle">Middlename</label>
													<input type="text" class="form-control" name="mid_name"value="<?php  echo $rows['middle_name'] ?>">
												</div>
											</div>
											<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 mb-2">
												<div class="form-group">
													<label for="user-role">Role</label>
													<input type="text" class="form-control" name="role" value="<?php  echo $rows['role'] ?>">
												</div>
											</div>
											<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 mb-2">
												<div class="form-group">
													<label for="user-bday">Birtdate</label>
													<input type="date" class="form-control" name="birth_date" value="<?php  echo $rows['birth_date'] ?>">
												</div>
											</div>
											<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 mb-2">
												<div class="form-group">
													<label for="user-gender">Gender</label>
													<div class="input-group">
														<select class="form-select" required="" name="gender" value="">
															
															<option ><?php  echo $rows['gender'] ?></option>
															<?php 
															if ($rows['gender']== 'Male') {
																echo "<option value='Female'>Female</option>";
															}
															elseif ($rows['gender']== 'Female') {
																echo "<option value='Male'>Male</option>";
															}
															?>
															
														</select>
													</div>
												</div>
											</div>
											<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 mb-2">
												<div class="form-group">
													<label for="phone">Age</label>
													<input type="number" class="form-control" name="age" value="<?php  echo $rows['age'] ?>" >
												</div>
											</div>
											<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 mb-2">
												<div class="form-group">
													<label for="phone">Mobile Number</label>
													<input type="number" class="form-control" name="mobile_no" value="<?php  echo $rows['mobile_no'] ?>" >
												</div>
											</div>
											<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 mb-2">
												<div class="form-group">
													<label for="uder-id">ID No.</label>
													<input type="number" class="form-control" name="user_id" value="<?php  echo $rows['user_id'] ?>" >
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-2">
												<div class="form-group">
													<label for="user-email">Email Address</label>
													<input type="email" class="form-control" name="email_address" value="<?php  echo $rows['email_address'] ?>">
												</div>
											</div>
											<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 mb-2">
												<div class="form-group">
													<label for="user-section">Section</label>
													<input type="text" class="form-control" name="section" value="<?php  echo $rows['section'] ?>">
												</div>
											</div>
										</div>
										<div class="row gutters m-3">
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
												<label for="user-add">Address</label>
												<textarea class="form-control" name="address" rows="2" ><?php  echo $rows['address'] ?></textarea>
											</div>
										</div>
										<?php }

										 ?>
										<div class="row gutters mt-5">
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-center">
												<div class="text-right">
													<button type="submit" id="submit" name="submit" class="btn btn-success pb-2 px-4 btn-md fs-6 rounded">Save changes</button>
													
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
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
		                    <h5 class="modal-title"></h5>
		                    
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

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

 <script type="text/javascript">
 	file_case.onchange = evt => {
 		const [file] = file_case.files;
 		if (file) {
 			imgss.src = URL.createObjectURL(file);

 		}
 	}
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

</html>