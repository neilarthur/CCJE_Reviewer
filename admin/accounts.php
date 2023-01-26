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
	<title>Account Manager</title>
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
	<section class="home-section float-start ">
		<div class="home-content d-flex justify-content-between" style="background: white;">
			<div class="d-flex">
				<button style="border-style: none; background: white; height: 60px;" class="mt-1">
					<i class='bx bx-menu' ></i>
				</button>
				<nav class="navbar navbar-expand-lg navbar-light" style="margin-top: 10px;">
					<div class="container-fluid">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="dashboard.php" style="text-decoration: none;">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Account Management</li>
							</ol>
						</nav>
					</div>
				</nav>
			</div>
			<form class="d-flex">
				<div class="dropdown dp mt-3">
                    <a class="text-reset dropdown-toggle text-decoration-none" href="#"id="navbarDropdownMenuLink" role="button"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell fa-lg "></i>
                        <?php 

                            $comers = mysqli_query($sqlcon,"SELECT * FROM tbl_notification  WHERE notif_status='0' AND action='Added an exam' ORDER BY notif_id DESC");
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
                      echo'<span><img class="me-2 rounded-circle" src="data:image;base64,'.base64_encode($rows["image_size"]).'" height="40px;" width="40px;"></span>';
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
		<div class="col py-3 overflow-auto">
			<div class="container-fluid">
				<div class="row">
				  	<div class="col d-flex justify-content">
                        <div class="w-50">
                            <h2 class="text-dark text-start ps-3 fw-bold mt-4 ms-2 ">Account  Management</h2>
                        </div> 
                    </div>
                </div>
				<div class="tab-content" id="nav-tabContent">
					<?php

					if ($_GET['tab-accounts']=='students') {

						?>
					<nav>
						<div class="nav nav-pills mt-2" id="nav-tab" role="tablist">
							<button class="nav-link active w-50" id="nav-home-tab" data-bs-toggle="pill" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fas fa-user-graduate"></i> Students</button>
							<button class="nav-link w-50" id="nav-profile-tab" data-bs-toggle="pill" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-chalkboard-teacher"></i> Faculty Instructor</button>
						</div>
					</nav>

					<!-- table -->
					<div class="tab-pane fade show active mb-4" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
						<div class="row">
							<div class="col ">
								<div class="card">
									<div class="card-body rounded-3 m-4 table-responsive-xl">
										<div class="position-left d-flex justify-content-end mb-3">
										</div>
										<table class="table table-striped align-middle bg-light" id="student">
											<thead>
												<tr>
													<th scope="col">Student ID</th>
													<th scope="col">Fullname</th>
													<th scope="col">Section</th>
													<th scope="col">Role</th>
													<th scope="col">Email Address</th>
													<th scope="col" style="text-align: center;">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$query_row = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE role='student' AND status = 'active'");

												while ($rows = mysqli_fetch_assoc($query_row)) { ?>
												<tr>
													<td><?php echo $rows['user_id'];  ?></td>
													<td><?php echo $rows['last_name'];  ?>,&nbsp;<?php echo $rows['first_name'];  ?>&nbsp;<?php echo $rows['middle_name'];  ?></td>
													<td class="ps-4"><?php echo $rows['section'];  ?></td>
													<td><?php echo $rows['role'];  ?></td>
													<td><?php echo $rows['email_address']; ?></td>
													<td>
														<div class="d-flex flex-row justify-content-center">
															<button data-id='<?php echo $rows['acc_id'];  ?>' class="btn btn-primary  mx-2 viewbtn" data-bs-target="#ViewAccount" data-bs-toggle="modal" type="button"><i class="fas fa-eye"></i></button>
															<button data-id='<?php echo $rows['acc_id'];  ?>' class="btn btn-warning  mx-2 editbtn" data-bs-target="#EditAccount" data-bs-toggle="modal" type="button"><i class="fas fa-edit"></i></button>
															<a href="../php/archiveaccount.php?id=<?php echo $rows['acc_id']; ?>" class="btn btn-secondary mx-2 btn-del" ><i class="fas fa-trash"></i></a>
														</div>
													</td>
												</tr>
											  <?php } ?>
											</tbody>
										</table>
										<?php if (isset($_GET['m'])) : ?>
										<div class="flash-data" data-flashdata="<?= $_GET['m']; ?>"></div>
									<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade mb-4" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
						<div class="row">
							<div class="col ">
								<div class="card">
									<div class="card-body rounded-3 m-4 table-responsive-lg">
										<div class="position-left d-flex justify-content-end  mb-3">
											<button type="button" class="btn  px-3 pb-2 text-white" data-bs-toggle="modal" data-bs-target="#AddFaculty" style="margin-left: 55%; background-color: #8C0000;"><b><i class="fas fa-plus-circle"></i></b> ADD</button>
										</div>
										<table class="table table-striped align-middle bg-light text-align-middle" id="faculty">
											<thead>
												<tr>
													<th scope="col">Teacher ID</th>
													<th scope="col">Fullname</th>
													<th scope="col">Class Section</th>
													<th scope="col">Role</th>
													<th scope="col">Email Address</th>
													<th scope="col" style="text-align: center;">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php

												$query_raw = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE role='faculty' AND status = 'active'");

												while ($raws = mysqli_fetch_assoc($query_raw)) { ?>
												<tr>
													<td><?php echo $raws['user_id'];  ?></td>
													<td><?php echo $raws['last_name'];  ?>,&nbsp;<?php echo $raws['first_name'];  ?>&nbsp;<?php echo $raws['middle_name'];  ?></td>
													<td><?php echo $raws['section'];  ?></td>
													<td><?php echo $raws['role'];  ?></td>
													<td><?php echo $raws['email_address']; ?></td>
													<td>
														<div class="d-flex flex-row justify-content-center">
															<button data-id='<?php echo $raws['acc_id'];  ?>' class="btn btn-primary  mx-2 viewbtn" data-bs-target="#ViewAccount" data-bs-toggle="modal" type="button"><i class="fas fa-eye"></i></button>
															<button data-id='<?php echo $raws['acc_id'];  ?>' class="btn btn-warning  mx-2 editbtn" data-bs-target="#EditAccount" data-bs-toggle="modal" type="button"><i class="fas fa-edit"></i></button>
															<a href="../php/archiveaccount.php?id=<?php echo $raws['acc_id']; ?>" class="btn btn-secondary mx-2 btn-del" ><i class="fas fa-trash"></i></a>
														</div>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
										<?php if (isset($_GET['m'])) : ?>
										<div class="flash-data" data-flashdata="<?= $_GET['m']; ?>"></div>
									<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php 

					 } 
					 elseif ($_GET['tab-accounts']=='faculty') {
					 	?>
					 	<nav>
						<div class="nav nav-pills mt-2" id="nav-tab" role="tablist">
							<button class="nav-link w-50" id="nav-home-tab" data-bs-toggle="pill" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Students</button>
							<button class="nav-link active w-50" id="nav-profile-tab" data-bs-toggle="pill" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Faculty Instructor</button>
						</div>
					</nav>

					<!-- table -->
					<div class="tab-pane fade  mb-4" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
						<div class="row">
							<div class="col ">
								<div class="card">
									<div class="card-body rounded-3 m-4 table-responsive-lg">
										<div class="position-left d-flex justify-content-end mb-3">
										</div>
										<table class="table table-striped align-middle bg-light" id="student">
											<thead>
												<tr>
													<th scope="col">Student ID</th>
													<th scope="col">Fullname</th>
													<th scope="col">Section</th>
													<th scope="col">Role</th>
													<th scope="col">Email Address</th>
													<th scope="col" style="text-align: center;">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$query_row = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE role='student' AND status = 'active'");

												while ($rows = mysqli_fetch_assoc($query_row)) { ?>
												<tr>
													<td><?php echo $rows['user_id'];  ?></td>
													<td><?php echo $rows['last_name'];  ?>,&nbsp;<?php echo $rows['first_name'];  ?>&nbsp;<?php echo $rows['middle_name'];  ?></td>
													<td class="ps-4"><?php echo $rows['section'];  ?></td>
													<td><?php echo $rows['role'];  ?></td>
													<td><?php echo $rows['email_address'];  ?></td>
													<td>
														<div class="d-flex flex-row justify-content-center">
															<button data-id='<?php echo $rows['acc_id'];  ?>' class="btn btn-primary  mx-2 viewbtn" data-bs-target="#ViewAccount" data-bs-toggle="modal" type="button"><i class="fas fa-eye"></i></button>
															<button data-id='<?php echo $rows['acc_id'];  ?>' class="btn btn-warning  mx-2 editbtn" data-bs-target="#EditAccount" data-bs-toggle="modal" type="button"><i class="fas fa-edit"></i></button>
															<a href="../php/archiveaccount.php?id=<?php echo $rows['acc_id']; ?>" class="btn btn-secondary mx-2 btn-del" ><i class="fas fa-trash"></i></a>
														</div>
													</td>
												</tr>
											  <?php } ?>
											</tbody>
										</table>
										<?php if (isset($_GET['m'])) : ?>
										<div class="flash-data" data-flashdata="<?= $_GET['m']; ?>"></div>
									<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade show active mb-4" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
						<div class="row">
							<div class="col ">
								<div class="card">
									<div class="card-body rounded-3 m-4 table-responsive-lg">
										<div class="position-left d-flex justify-content-end  mb-3">
											<button type="button" class="btn  px-3 pb-2 text-white" data-bs-toggle="modal" data-bs-target="#AddFaculty" style="margin-left: 55%; background-color: #8C0000;"><b><i class="fas fa-plus-circle"></i></b> ADD</button>
										</div>
										<table class="table table-striped align-middle bg-light text-align-middle" id="faculty">
											<thead>
												<tr>
													<th scope="col">Teacher ID</th>
													<th scope="col">Fullname</th>
													<th scope="col" class="text-center">Class Section</th>
													<th scope="col">Role</th>
													<th scope="col">Email Address</th>
													<th scope="col" style="text-align: center;">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php

												$query_raw = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE role='faculty' AND status = 'active'");

												while ($raws = mysqli_fetch_assoc($query_raw)) { ?>
												<tr>
													<td><?php echo $raws['user_id'];  ?></td>
													<td><?php echo $raws['last_name'];  ?>,&nbsp;<?php echo $raws['first_name'];  ?>&nbsp;<?php echo $raws['middle_name'];  ?></td>
													<td style="padding-left: 70px;"><?php echo $raws['section'];  ?></td>
													<td><?php echo $raws['role'];  ?></td>
													<td><?php echo $raws['email_address'];  ?></td>
													<td>
														<div class="d-flex flex-row justify-content-center">
															<button data-id='<?php echo $raws['acc_id'];  ?>' class="btn btn-primary  mx-2 viewbtn" data-bs-target="#ViewAccount" data-bs-toggle="modal" type="button"><i class="fas fa-eye"></i></button>
															<button data-id='<?php echo $raws['acc_id'];  ?>' class="btn btn-warning  mx-2 editbtn" data-bs-target="#EditAccount" data-bs-toggle="modal" type="button"><i class="fas fa-edit"></i></button>
															<a href="../php/archiveaccount.php?id=<?php echo $raws['acc_id']; ?>" class="btn btn-secondary mx-2 btn-del" ><i class="fas fa-trash"></i></a>

														</div>
													</td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
										<?php if (isset($_GET['m'])) : ?>
										<div class="flash-data" data-flashdata="<?= $_GET['m']; ?>"></div>
									<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php 
					 }

					?>
					
				</div>
			</div>
		</div>
    </section>

        <!-- ADD Student Account -->
        <div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        	<div class="modal-dialog modal-lg">
        		<div class="modal-content">
        			<div class="modal-header">
        				<h5 class="modal-title fw-bold fs-3" id="exampleModalLabel">Add Student Account</h5>
        				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        			</div>
        			<div class="modal-body">
        				<div class="container">
        					<form class="form" method="post" action="../php/add_account.php" enctype="multipart/form-data">
        						<div class="col">
        							<div class="row">
        								<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 py-2 me-5">
        									<img src="../assets/pics/tempo.png" id="img" alt="preview" class="img-fluid img-thumbnail rounded-circle mb-2">
											<input type="file" name="image" class="form-control" id="fileimg" required="" accept=".jpg, .jpeg, .png">
											<label for="image_browser" class="d-flex justify-content-center mt-2 ps-1">Attach Picture</label>
        								</div>
        								<div class="col-xl-7 col-lg-6 col-md-12 col-sm-6 py-2">
        									<input type="hidden" name="category" value="student">
        									<label for="user-last" class="d-flex justify-content-center ps-1">Last Name</label>
        									<input type="text" name="last_name" class="form-control text-center"required>

        									<label for="user-first" class="d-flex justify-content-center ps-1">First Name</label>
        									<input type="text" name="first_name" class="form-control text-center" required>
        									<label for="user-middle" class="d-flex justify-content-center ps-1">Middle Name</label>
        									<input type="text" name="mid_name"  class="form-control text-center" required>
        								</div>
        							</div>
        							<div class="row">
        								<div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 py-2">
											<label for="user-id" class="d-flex justify-content-start ps-1">Role</label>
											<input type="text" name="role" value="Student" class="form-control" readonly="">
										</div>
        								<div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 py-2">
											<label for="user-bday" class="d-flex justify-content-start ps-1">Birth Date</label>
											<input type="date" name="birth_date" class="form-control" required="">
										</div>
										<div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 py-2">
											<label for="user-age" class="d-flex justify-content-start ps-1">Age</label>
											<input type="number" name="age" class="form-control" required="">
										</div>
										<div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 py-2">
											<label for="user-sex" class="d-flex justify-content-start ps-1">Gender</label>
											<div class="input-group">
												<select class="form-select" required="" name="gender">
													<option selected></option>
													<option value="Male">Male</option>
													<option value="Female">Female</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 py-2">
											<label for="user-id" class="d-flex justify-content-start ps-1">Student ID:</label>
											<input type="number" name="user_id" class="form-control" required="">
										</div>
										<div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 py-2">
											<label for="user-section" class="d-flex justify-content-start ps-1">Year & Section</label>
											<div class="input-group">
												<select class="form-select" required="" name="section">
													<option selected></option>
													<option value="4A">4A</option>
													<option value="4B">4B</option>
													<option value="4C">4C</option>
												</select>
											</div>
										</div>
										<div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 py-2">
											<label for="user-mobile" class="d-flex justify-content-start ps-1">Mobile Number</label>
											<input type="number" name="mobile_no" class="form-control" required="">
										</div>
									</div>
									<div class="row">
										<div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 py-2">
											<label for="user-email" class="d-flex justify-content-start ps-1">Email Address</label>
											<input type="Email" name="email_address" class="form-control check_email" required="">
											<small class="error_email text-danger"></small>

										</div>
									</div>
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 py-2">
										<label for="user-add" class="d-flex justify-content-start ps-1">Address</label>
										<textarea class="form-control" name="address" rows="2"></textarea>
									</div>
									<div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 py-2 mb-3">
										<label for="user-password" class="d-flex justify-content-start ps-1">Password</label>
										<input type="password" name="password" class="form-control" minlength="8" required="">
									</div>
								</div>
								<div class="modal-footer d-flex justify-content-center">
									<input type="submit" name="save" class="btn btn-success px-5 pb-2 text-white" value="Submit">
									<button type="button" class="btn btn-secondary btn  px-5 pb-2 text-white" data-bs-dismiss="modal">Close</button>
								</div>
							</form>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>


        <!--ADD Faculty Account-->
        <div class="modal fade" id="AddFaculty" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        	<div class="modal-dialog modal-lg">
        		<div class="modal-content">
        			<div class="modal-header">
        				<h5 class="modal-title fw-bold fs-3" id="exampleModalLabel">Add Faculty Account</h5>
        				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        			</div>
        			<div class="modal-body">
        				<div class="container">
        					<form class="form" method="post" action="../php/add_account.php" enctype="multipart/form-data">
        						<div class="col">
        							<div class="row">
        								<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 py-2 me-5">
        									<img src="../assets/pics/tempo.png" id="img_a" alt="preview" class=" rounded-circle mb-2" height="200px" width="200px">
											<input type="file" name="image" class="form-control" id="file_s" required="" accept=".jpg, .jpeg, .png">
											<label for="image_browser" class="d-flex justify-content-center mt-2 ps-1">Attach Picture</label>
        								</div>
        								<div class="col-xl-7 col-lg-6 col-md-12 col-sm-6 py-2">
        									<input type="hidden" name="category" value="faculty">
        									<label for="user-last" class="d-flex justify-content-center ps-1">Last Name</label>
        									<input type="text" name="last_name" class="form-control text-center text-capitalize" required>

        									<label for="user-first" class="d-flex justify-content-center ps-1">First Name</label>
        									<input type="text" name="first_name" class="form-control text-center text-capitalize" required>
        									<label for="user-middle" class="d-flex justify-content-center ps-1">Middle Name</label>
        									<input type="text" name="mid_name"  class="form-control text-center text-capitalize" required>
        								</div>
        							</div>
        							<div class="row">
        								<div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 py-2">
											<label for="user-id" class="d-flex justify-content-start ps-1">Role</label>
											<input type="text" name="role" value="Faculty" class="form-control" readonly="">
										</div>
        								<div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 py-2">
											<label for="user-bday" class="d-flex justify-content-start ps-1">Birth Date</label>
											<input type="date" name="birth_date" class="form-control" required="">
										</div>
										<div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 py-2">
											<label for="user-age" class="d-flex justify-content-start ps-1">Age</label>
											<input type="number" name="age" class="form-control" required="">
										</div>
										<div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 py-2">
											<label for="user-sex" class="d-flex justify-content-start ps-1">Gender</label>
											<div class="input-group">
												<select class="form-select" required="" name="gender">
													<option selected></option>
													<option value="Male">Male</option>
													<option value="Female">Female</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 py-2">
											<label for="user-id" class="d-flex justify-content-start ps-1">Teacher ID:</label>
											<input type="number" name="user_id" class="form-control" required="">
										</div>
										<div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 py-2">
											<label for="user-section" class="d-flex justify-content-start ps-1">Class Section</label>
											<div class="input-group">
												<select class="form-select" required="" name="section">
													<option selected></option>
													<option value="4A">4A</option>
													<option value="4B">4B</option>
													<option value="4C">4C</option>
												</select>
											</div>
										</div>
										<div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 py-2">
											<label for="user-mobile" class="d-flex justify-content-start ps-1">Mobile Number</label>
											<input type="number" name="mobile_no" class="form-control" required="">
										</div>
									</div>
									<div class="row">
										<div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 py-2">
											<label for="user-email" class="d-flex justify-content-start ps-1">Email Address</label>
											<input type="Email" name="email_address" class="form-control check_emails" required="">
											<small class="error_emails" style="color: red;"></small>
										</div>
									</div>
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 py-2">
										<label for="user-add" class="d-flex justify-content-start ps-1">Address</label>
										<textarea class="form-control" name="address" rows="2"></textarea>
									</div>
									<div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 py-2 mb-3">
										<label for="user-password" class="d-flex justify-content-start ps-1">Password</label>
										<input type="password" name="password" class="form-control" minlength="8" required="">
									</div>
								</div>
								<div class="modal-footer d-flex justify-content-center">
									<input type="submit" name="save" class="btn btn-success px-5 pb-2 text-white" value="Submit">
									<button type="button" class="btn btn-secondary btn  px-5 pb-2 text-white" data-bs-dismiss="modal">Close</button>
								</div>
							</form>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>


        <!-- View  Account -->
        <div class="modal fade" id="ViewAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        	<div class="modal-dialog modal-lg">
        		<div class="modal-content">
        			<div class="modal-header">
        				<h5 class="modal-title fw-bold fs-3" id="exampleModalLabel">Profile Information</h5>
        				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        			</div>
        			<div class="modal-body">
        				<div class="mods">
        					
        				</div>
        			</div>
        		</div>
        	</div>
        </div>


        <!-- Edit Account -->
        <div class="modal fade" id="EditAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        	<div class="modal-dialog modal-lg">
        		<div class="modal-content">
        			<div class="modal-header">
        				<h5 class="modal-title fw-bold fs-3" id="exampleModalLabel">Edit Information</h5>
        				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        			</div>
        			<div class="modal-body">
        				<div class="logs">

        				</div>
        			</div>
        		</div>
        	</div>
        </div>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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

<!-- View modal --->
 <script type="text/javascript">

   $(document).ready(function(){
    $('.viewbtn').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: '../php/viewaccount.php',
        type: 'post',
        data: {userid: userid},
        success: function(response){
          $('.mods').html(response);
          $('#ViewAccount').modal('show');
        }
      });
    });
   });
 </script>

 <!-- Edit modal --->
 <script type="text/javascript">

   $(document).ready(function(){
    $('.editbtn').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: '../php/editaccount.php',
        type: 'post',
        data: {userid: userid},
        success: function(response){
          $('.logs').html(response);
          $('#EditAccount').modal('show');
        }
      });
    });
   });
 </script>

 <script type="text/javascript">
 	fileimg.onchange = evt => {
 		const [file] = fileimg.files;
 		if (file) {
 			img.src = URL.createObjectURL(file);

 		}
 	}
 </script>
 
<script type="text/javascript">
 	$('.btn-del').on('click',function(e){

 		e.preventDefault();

 		const href = $(this).attr('href')

 		Swal.fire({

 			title: 'Are you Sure?',
 			text: 'Record will be deleted',
 			icon: "warning",
 			type:'Warning',
 			showCancelButton:true,
 			confirmButtonColor:'#3085d6',
 			cancelButtonColor:'#d33',
 			confirmButtonColor:'Delete Record',
 		}).then((result)=> {

 			if (result.value) {
 				document.location.href = href;

 			}
 		})
 	})

 	const flashdata = $('.flash-data').data('flashdata')
 	if (flashdata) {

 		Swal.fire({
 			type: 'success',
 			icon: "success",
 			title: 'Record Archive',
 			text: 'Record Has been Archive!',
 		})
 	}
 </script>
  <script type="text/javascript">
 	file_s.onchange = evt => {
 		const [file] = file_s.files;
 		if (file) {
 			img_a.src = URL.createObjectURL(file);

 		}
 	}
 </script>


 <!--checking email student -->

 <script type="text/javascript">
 	$(document).ready(function(){
 		$('.check_email').keyup(function(e){

 			var email= $('.check_email').val();

 			$.ajax({
 				type:"POST",
 				url:"../php/add_account.php",
 				data:{
 					"check_submit_btn":1,
 					"email_id":email,
 				},
 				success: function(response){

 					$('.error_email').text(response);
 				}
 			});

 		});
 	});
 </script>


  <!--checking email faculty -->

 <script type="text/javascript">
 	$(document).ready(function(){
 		$('.check_emails').keyup(function(e){

 			var emails= $('.check_emails').val();

 			$.ajax({
 				type:"POST",
 				url:"../php/add_account.php",
 				data:{
 					"check_btn":1,
 					"email_ids":emails,
 				},
 				success: function(response){

 					$('.error_emails').text(response);
 				}
 			});

 		});
 	});
 </script>




<script src="../js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../js/dt-1.10.25datatables.min.js"></script>
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
<script type="text/javascript">
  $(document).ready(function() {
  	 $('#student').DataTable({
  	 	paging: true
  	 });
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
  	 $('#faculty').DataTable({
  	 	paging: true
  	 });
  });
</script>

<?php

#add accounts
if (isset($_GET['addsuccess'])) {
	echo ' <script> swal("Account has been Saved!", " clicked the okay!", "success");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/admin/accounts.php?tab-accounts=students");
	</script>';
}
elseif (isset($_GET['adderror'])) {
	echo ' <script> swal("Account has not saved!", " clicked the okay!", "error");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/admin/accounts.php?tab-accounts=students");
	</script>';
}

#update accounts
if (isset($_GET['upsuc'])) {
	echo ' <script> swal("Account has been Changed!", " clicked the okay!", "success");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/admin/accounts.php");
	</script>';
}
elseif (isset($_GET['upsucer'])) {
	echo ' <script> swal("Account has not saved!", " clicked the okay!", "error");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/admin/accounts.php");
	</script>';
}
 
?> 
</html>