<?php

session_start();
include_once '../php/conn.php';

if (!isset($_SESSION["login"]) || $_SESSION['login'] !=true) {
    header("location: ../php/index.php");
     exit;
}
elseif (!isset($_SESSION["role"]) || $_SESSION['role'] !='faculty') {
    header("location: ../php/index.php");
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Accounts</title>
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
<body style="background-color: rgb(229, 229, 229);">
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
				<a href="testbank.php">
					<i class="fas fa-list-ol"></i>
					<span class="link_name">Question Bank</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="testbank.php">Question Bank</a></li>
				</ul>
			</li>
			<li>
			<li class="navigation-list-item">
				<a href="testyourself.php">
					<i class="fas fa-sticky-note"></i>
					<span class="link_name">Manage Test</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="testyourself.php">Manage Test</a></li>
				</ul>
			</li>
			<li class="navigation-list-item">
				<a href="preboard.php">
					<i class="fas fa-list-alt"></i>
					<span class="link_name">Pre-Board Examination</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="preboard.php">Pre-Board Examination</a></li>
				</ul>
			</li>
			<li class="navigation-list-item">
				<a href="examresults.php">
					<i class="fas fa-poll"></i>
					<span class="link_name">Exam Results</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="examresults.php">Exam Results</a></li>
				</ul>
			</li>
			<li class="navigation-list-item">
				<a href="accounts_manage.php">
					<i class='bx bxs-user-account bx-sm' ></i>
					<span class="link_name">Accounts</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="accounts_manage.php">Accounts</a></li>
				</ul>
			</li>
			<li class="navigation-list-item">
				<a href="log-history.php">
					<i class="fas fa-history"></i>
					<span class="link_name">Log History</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="log-history.php">Log History</a></li>
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
					    </div>';

                     	?>
					    
						<?php }

                        ?>
						<div class="name-job">
							<div class="profile_name"><a class="profile text-warning"href="profile.php?acc_id=<?php echo $_SESSION["acc_id"] ?>"><?php echo $_SESSION["first_name"];?></a></div>
							<div class="job"><?php echo $_SESSION["role"];?></div>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<section class="home-section float-start">
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
									<li class="breadcrumb-item active" aria-current="page">Accounts</li>
								</ol>
							</nav>
						</div>
					</nav>
				</div>
				<form class="d-flex">
					<div class="dropdown dp mt-3">
		                <a class="text-reset dropdown-toggle text-decoration-none" href="#"id="navbarDropdownMenuLink" role="button"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell fa-lg "></i>
		                    <?php 
		                    $come = mysqli_query($sqlcon,"SELECT * FROM tbl_response  WHERE response_stat='0' ORDER BY response_id DESC");
		                	?>
		                    <span class=" top-0 start-100 translate-middle badge rounded-pill badge-notification bg-danger"><?php echo mysqli_num_rows($come); ?></span>
		                </a>
		                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="border-radius: 10px;">
	                        <h6 class="dropdown-header text-dark ">Notifications</h6>
	                        	<?php

	                            $come = mysqli_query($sqlcon,"SELECT * FROM tbl_response,choose_question,accounts WHERE (tbl_response.test_id = choose_question.test_id) AND (choose_question.prepared_by ='{$_SESSION['acc_id']}') AND (tbl_response.acc = accounts.acc_id) ORDER BY response_id DESC");

	                            if (mysqli_num_rows($come)==0) {
	                            	
	                            	echo "<h5 class='text-center'>No notification Found</h5>";
	                            }

	                            if (mysqli_num_rows($come) >= 0) {

	                            	foreach ($come as $item) {

	                            ?>
	                        <a class="dropdown-item d-flex align-items-center" href="notification.php">
	                            <div class="me-4">
	                                 <div class="fa-stack fa-1x">
	                                  <i class="fa fa-circle fa-stack-2x ms-2"></i>
	                                  <i class="fas fa-user fa-stack-1x ms-2 text-white" ></i>
	                                </div> 
	                            </div>
	                            <div class="fw-bold">
	                                <div class="small text-gray-500"><?php  $life = date('F j, Y, g:i a',strtotime($item['created']));
	                                 echo $life; ?></div>
	                                <span class="font-weight-bold"><?php echo $item['first_name']." ".$item['last_name']." Message to you "; ?></span>
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
			<div class="col py-3 overflow-auto ms-3 me-3">
				<div class="container-fluid">
					<div class="row">
						<div class="col d-flex justify-content">
							<div class="w-50">
								<h2 class="text-dark text-start ps-3 fw-bold mt-4 "> Account Management</h2>
							</div>
						</div>
						<div class="row">
							<div class="col ">
								<div class="card">	
									<div class="card-body rounded-3 m-2 table-responsive-lg">
										<div class="position-left d-flex justify-content-end mb-3">
										</div>
										<table class="table table-striped align-middle bg-light" width="100%" id="accountTab">
											<thead>
												<tr>
													<th scope="col">Student ID</th>
													<th scope="col">Fullname</th>
													<th scope="col">Year & Section</th>
													<th scope="col">Email Address</th>
													<th scope="col" class="ps-3">Status</th>
													<th scope="col" style="text-align: center;">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php

												$accounts = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");

												

												while ($row = mysqli_fetch_assoc($accounts)) { 
													if ($row['section']=='4A') {
														$acc = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE role='student' AND(accounts.section='4A')");

														while ($rows = mysqli_fetch_assoc($acc)) {?>
															<tr>
																<td><?php echo $rows['user_id'];  ?></td>
																<td><?php echo $rows['last_name'];  ?>, &nbsp;<?php echo $rows['first_name'];  ?>&nbsp; <?php echo $rows['middle_name'];  ?></td>
																<td><?php echo $rows['section'];  ?></td>
																<td><?php echo $rows['email_address']?></td>
																<td>
																	<?php
																	if ($rows['status']=='active') {
																		
																		echo '<span class="badge bg-success p-2 px-2" style="font-size: 15px;">Approve</span>';
																	}
																	elseif ($rows['status']=='pending') {
																		echo '<span class="badge bg-warning text-dark p-2 px-2" style="font-size: 15px;">Pending</span>';
																	}
																	?>
																</td>
																<td>
																	<div class="d-flex flex-row justify-content-center">
																		<button data-id='<?php echo $rows['acc_id'];  ?>' class="btn btn-primary  mx-2 viewbtn" data-bs-toggle="modal" type="button"><i class="fas fa-eye"></i></button>
																		<button data-id='<?php echo $rows['acc_id'];  ?>' class="btn btn-warning  mx-2 editbtn" data-bs-toggle="modal" type="button"><i class="fas fa-edit"></i></button>
																	<?php
																		$approve = $rows['status'];
																		if ($approve == "pending") { ?>
																		<button data-id='<?php echo $rows['acc_id']; ?>' class="btn btn-success mx-2 approvebtn" data-bs-toggle="modal" type="button"><i class="fas fa-check-circle"></i></button>
																	<?php }
																	   elseif ($approve == "active") {
																	 ?>
																	 <button data-id='<?php echo $rows['acc_id']; ?>' class="btn btn-secondary mx-2 approvebtn" data-bs-toggle="modal" type="button" disabled ><i class="fas fa-check-circle"></i></button>
																	<?php } ?>
																		<a href="../php/facul_archive_account.php?id=<?= $rows['acc_id']; ?>" class="btn btn-secondary mx-2 btn-del" ><i class="fas fa-trash"></i></a>

																	</div>
																</td>
															</tr>
													<?php }
												}elseif ($row['section']=='4B') {
													$acc = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE role='student' AND(accounts.section='4B')");
													while ( $rows = mysqli_fetch_assoc($acc)) { ?>
														   <tr>
																<td><?php echo $rows['user_id'];  ?></td>
																<td><?php echo $rows['last_name'];  ?>, &nbsp;<?php echo $rows['first_name'];  ?>&nbsp; <?php echo $rows['middle_name'];  ?></td>
																<td><?php echo $rows['section'];  ?></td>
																<td><?php echo $rows['email_address']?></td>
																<td>
																	<?php
																	if ($rows['status']=='active') {
																		
																		echo '<span class="badge bg-success p-2 px-2" style="font-size: 15px;">Approve</span>';
																	}
																	elseif ($rows['status']=='pending') {
																		echo '<span class="badge bg-warning text-dark p-2 px-2" style="font-size: 15px;">Pending</span>';
																	}
																	?>
																</td>
																<td>
																	<div class="d-flex flex-row justify-content-center">
																		<button data-id='<?php echo $rows['acc_id'];  ?>' class="btn btn-primary  mx-2 viewbtn" data-bs-toggle="modal" type="button"><i class="fas fa-eye"></i></button>
																		<button data-id='<?php echo $rows['acc_id'];  ?>' class="btn btn-warning  mx-2 editbtn" data-bs-toggle="modal" type="button"><i class="fas fa-edit"></i></button>
																	<?php
																		$approve = $rows['status'];
																		if ($approve == "pending") { ?>
																		<button data-id='<?php echo $rows['acc_id']; ?>' class="btn btn-success mx-2 approvebtn" data-bs-toggle="modal" type="button"><i class="fas fa-check-circle"></i></button>
																	<?php }
																	   elseif ($approve == "active") {
																	 ?>
																	 <button data-id='<?php echo $rows['acc_id']; ?>' class="btn btn-secondary mx-2 approvebtn" data-bs-toggle="modal" type="button" disabled ><i class="fas fa-check-circle"></i></button>
																	<?php } ?>

																		<a href="../php/facul_archive_account.php?id=<?= $rows['acc_id']; ?>" class="btn btn-secondary mx-2 btn-del" ><i class="fas fa-trash"></i></a>

																	</div>
																</td>
															</tr>
													<?php }
												}elseif ($row['section']=='4C') {
													$acc = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE role='student'  AND (accounts.section='4C')");
													while ( $rows = mysqli_fetch_assoc($acc)) { ?>
														 <tr>
														 		<!---- ---- ----->
																<td><?php echo $rows['user_id'];  ?></td>
																<td><?php echo $rows['last_name'];  ?>, &nbsp;<?php echo $rows['first_name'];  ?>&nbsp; <?php echo $rows['middle_name'];  ?></td>
																<td><?php echo $rows['section'];  ?></td>
																<td><?php echo $rows['email_address']?></td>
																<td>
																	<?php
																	if ($rows['status']=='active') {
																		
																		echo '<span class="badge bg-success p-2 px-2" style="font-size: 15px;">Approve</span>';
																	}
																	elseif ($rows['status']=='pending') {
																		echo '<span class="badge bg-warning text-dark p-2 px-2" style="font-size: 15px;">Pending</span>';
																	}
																	?>
																</td>
																<td>
																	<div class="d-flex flex-row justify-content-center">
																		<button data-id='<?php echo $rows['acc_id'];  ?>' class="btn btn-primary  mx-2 viewbtn" data-bs-toggle="modal" type="button"><i class="fas fa-eye"></i></button>
																		<button data-id='<?php echo $rows['acc_id'];  ?>' class="btn btn-warning  mx-2 editbtn" data-bs-toggle="modal" type="button"><i class="fas fa-edit"></i></button>
																	<?php
																		$approve = $rows['status'];
																		if ($approve == "pending") { ?>
																		<button data-id='<?php echo $rows['acc_id']; ?>' class="btn btn-success mx-2 approvebtn" data-bs-toggle="modal" type="button"><i class="fas fa-check-circle"></i></button>
																	<?php }
																	   elseif ($approve == "active") {
																	 ?>
																	 <button data-id='<?php echo $rows['acc_id']; ?>' class="btn btn-secondary mx-2 approvebtn" data-bs-toggle="modal" type="button" disabled ><i class="fas fa-check-circle"></i></button>
																	<?php } ?>

																		<a href="../php/facul_archive_account.php?id=<?= $rows['acc_id']; ?>" class="btn btn-secondary mx-2 btn-del" ><i class="fas fa-trash"></i></a>

																	</div>
																</td>
															</tr>
													<?php }
												}

											} ?>
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
                </div>
			</div>
		</div>
	</section>
	 <!-- ADD Student Account -->
    <div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog modal-lg">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title fw-bold fs-3" id="exampleModalLabel">Add Student Account</h5>
    				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    			</div>
    			<div class="modal-body">
    				<div class="container">
    					<form class="form" method="POST" action="../php/facul_student_acc.php" enctype="multipart/form-data">
    						<div class="col">
    							<div class="row">
    								<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 py-2 me-5">
    									<img src="../assets/pics/tempo.png" id="img" alt="preview" class="img-fluid img-thumbnail rounded-circle mb-2">
										<input type="file" name="image" class="form-control" id="fileimg" required="" accept=".jpg, .jpeg, .png">
										<label for="image_browser" class="d-flex justify-content-center mt-2 ps-1">Attach Picture</label>
    								</div>
    								<div class="col-xl-7 col-lg-6 col-md-12 col-sm-6 py-2">
    									<label for="user-last" class="d-flex justify-content-center ps-1">Last Name</label>
    									<input type="text" name="last_name" class="form-control text-center text-capitalize"required>

    									<label for="user-first" class="d-flex justify-content-center ps-1">First Name</label>
    									<input type="text" name="first_name" class="form-control text-center text-capitalize" required>
    									<label for="user-middle" class="d-flex justify-content-center ps-1">Middle Name</label>
    									<input type="text" name="middle_name"  class="form-control text-center text-capitalize" required>
    								</div>
    							</div>
    							<div class="row">
    								<div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 py-2">
										<label for="user-id" class="d-flex justify-content-start ps-1">Role</label>
										<input type="text" name="role" value="Student" class="form-control" readonly="">
									</div>
    								<div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 py-2">
										<label for="user-bday" class="d-flex justify-content-start ps-1">Birthdate</label>
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
										<input type="text" name="email_address" class="form-control" required="">
									</div>
								</div>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 py-2">
									<label for="user-add" class="d-flex justify-content-start ps-1">Address</label>
									<textarea class="form-control" name="address" rows="2"></textarea>
								</div>
								<div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 py-2">
									<label for="user-password" class="d-flex justify-content-start ps-1">Password</label>
									<input type="password" name="password" class="form-control" minlength="8" required="">
									<input type="hidden" name="login_id" value="<?php echo $_SESSION['acc_id']; ?>">
								</div>
							</div>
							<div class="modal-footer border-0 d-flex justify-content-center mt-2">
								<button type="submit" name="save" class="btn btn-success px-5 pb-2 text-white"><i class="fas fa-check me-2"></i>Submit</button>
    							<button type="button" class="btn btn-danger btn  px-5 pb-2 text-white" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>Close</button>
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

    <!-- Approve Modal -->
		<div class="modal fade"  id="approve" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
			<div class="modal-dialog modal-dialog-centered">
	    		<div class="modal-content">
	    			<div class="modal-header flex-column border-0">
	    				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        				<div class="icon-box mt-3">
        				</div>
        				<h3 class="modal-title text-align-center mt-3 fw-bold">Are you sure</h3>
        				<p class="h5 modal-title text-align-center mt-2">Do want to approve these account?</p>
	    			</div>
	    			<div class="appbtn">
	    				
	    			</div>
	    		</div>
	    	</div>
	    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header flex-column border-0 bg-danger">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="icon-box mt-2 mb-2">
                    	<i class="fas fa-exclamation-circle fa-5x text-white"></i>
                    </div>
                </div>
                <div class="modal-body text-center mt-2">
                    <h4 class="fw-bold">Do you really wish to leave or log out?</h4>
                </div>
                <div class="modal-footer border-0">
                    <form action="../php/logout_faculty.php" class="hide" method="POST">
                    	<input type="hidden" name="id" value="<?php echo $_SESSION['acc_id']  ?>">
						<input type="hidden" name="times" value="<?php echo $_SESSION['login_id']  ?>">
						<div>
							<button type="submit" class="btn btn-success">YES</button>
							<button type="button" class="btn btn-danger mx-2" data-bs-dismiss="modal">NO</button>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>

   
</body>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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


<!-- View modal --->
 <script type="text/javascript">

   $(document).ready(function(){
    $('.viewbtn').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: '../php/view_facul_account.php',
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

 <!-- View modal --->
 <script type="text/javascript">

   $(document).ready(function(){
    $('.approvebtn').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: '../php/approve_modal.php',
        type: 'post',
        data: {userid: userid},
        success: function(response){
          $('.appbtn').html(response);
          $('#approve').modal('show');
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
        url: '../php/edit_facul_account.php?$edit=<?php echo $_SESSION['login_id']; ?>',
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
	fileimg.onchange = evt => {
		const [file] = fileimg.files;
		if (file) {
			img.src = URL.createObjectURL(file);

		}
	}
</script>





<script src="../js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../js/dt-1.10.25datatables.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
  	 $('#accountTab').DataTable({
  	 	paging: true
  	 });
  });
</script>
<?php 
#add accounts
if (isset($_GET['addsuccess'])) {
	echo ' <script> swal("Account has been Saved!", " clicked the okay!", "success");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/faculty/accounts_manage.php");
	</script>';
}
elseif (isset($_GET['adderror'])) {
	echo ' <script> swal("Account has not saved!", " clicked the okay!", "error");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/faculty/accounts_manage.php");
	</script>';
}
#update accounts
if (isset($_GET['upsuc'])) {
	echo ' <script> swal("Account has been Changed!", " clicked the okay!", "success");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/faculty/accounts_manage.php");
	</script>';
}
elseif (isset($_GET['upsucer'])) {
	echo ' <script> swal("Account has not saved!", " clicked the okay!", "error");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/faculty/accounts_manage.php");
	</script>';
}
elseif (isset($_GET['approvescc'])) {
	echo ' <script> swal("Approve successfully!", " clicked the okay!", "success");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/faculty/accounts_manage.php");
	</script>';
}
 
?> 

</html>