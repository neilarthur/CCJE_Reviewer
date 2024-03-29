<?php


session_start();
include_once '../php/conn.php';

if (!isset($_SESSION["login"]) || $_SESSION['login'] !=true) {
    header("location: ../php/index.php");
     exit;
}
elseif (!isset($_SESSION["role"]) || $_SESSION['role'] !='systemadmin') {
    header("location: ../php/index.php");
    exit;
}


$n=6;
function getName($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
 
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
 
    return $randomString;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Editing Preboard</title>
	<!-- Boostrap 5.2 -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/dash.css">
	<!-- Box Icons-->
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<!-- Font Awesome-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"rel="stylesheet"/>
	<!-- System Logo -->
    <link rel="icon" href="../assets/pics/system-ico.ico">
	<!-- Bootstrap CSS -->
	<link href="../css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/datatables-1.10.25.min.css" />
	 <link rel="stylesheet" href="../css/jquery.durationpicker.css">
	<style>
       .dp .dropdown-toggle::after {
            content: none;
        }
         .navbar .breadcrumb li a{
          color: #8C0000;
        }
         .my-custom-scrollbar {
		position: relative;
		height: 450px;
		overflow: auto;
		}
		.table-wrapper-scroll-y {
		display: block;
		}
    </style>
</head>
<body style="background-color: rgb(229, 229, 229);">
    <div class="sidebar close">
        <div class="logo-details mt-2">
            <img src="../assets/pics/CCJE.png" alt="" width="50" height="50" class="d-inline-block align-top ms-3 bg-white rounded-circle" ><span class="logo_name ms-2">CCJE Reviewer</span>
        </div>
        <hr style="color:rgb(255, 255, 255);">
        <ul class="nav-links fw-bold">
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
                <a href="testbank.php">
                    <i class="fas fa-list-ol"></i>
                    <span class="link_name">Question Bank</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="exam-manage.php">Question Bank</a></li>
                </ul>
            </li>
            <li class="navigation-list-item">
                <a href="testyourself.php">
                    <i class="fas fa-sticky-note"></i>
                    <span class="link_name">Manage Test </span>
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
                <a href="exam-manage.php">
                    <i class='bx bx-spreadsheet bx-sm'></i>
                    <span class="link_name">Exam Managment</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="exam-manage.php">Exam Management</a></li>
                </ul>
            </li>
            <li class="navigation-list-item">
                <a href="database.php">
                    <i class='bx bxs-data'></i>
                    <span class="link_name">Database</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="database.php">Database</a></li>
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
                <div class="icon-link">
                    <a href="#">
                        <i class="fas fa-archive"></i>
                        <span class="link_name">Archived</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow drop' ></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Archived</a></li>
                    <li><a href="archive_quizzes.php">Quiz & Longquiz</a></li>
                    <li><a href="archive_exam.php">Preboard exam</a></li>
                    <li><a href="archive_users.php?tab-accounts=students">User Accounts</a></li>
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
                    </div>';
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
					<nav class="navbar navbar-expand-lg navbar-light" style="margin-top: 10px;">
						<div class="container-fluid">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="../faculty/dashboard.php" style="text-decoration: none;">Home</a></li>
									<li class="breadcrumb-item"><a href="../faculty/preboard.php" style="text-decoration: none;">Preboard Examination</a></li>
									<li class="breadcrumb-item active" aria-current="page">Editing preboard</li>
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
	                            	
	                            	echo "<a class='dropdown-item d-flex align-items-center' >
                                <div class='me-4'>
                                     <div class='fa-stack fa-1x'>
                                      <i class='fa fa-circle fa-stack-2x ms-2'></i>
                                      <i class='fas fa-bell-slash fa-stack-1x ms-2 text-white'></i>
                                    </div> 
                                </div>
                                <div class=''>
                                    <div class='fw-bold h5 ms-4'>No notifications  yet</div>
                                    <p class='small text-gray-500' >When get notifications, they'll show up here</p>
                                </div>
                            </a>";
	                            }

	                            if (mysqli_num_rows($come) >= 0) {

	                            	foreach ($come as $item) {

	                            ?>
	                        <a class="dropdown-item d-flex align-items-center" href="../faculty/notification.php">
	                            <div class="me-4">
	                                 <div class="fa-stack fa-1x">
	                                  <i class="fa fa-circle fa-stack-2x ms-2"></i>
	                                  <i class="fas fa-user fa-stack-1x ms-2 text-white" ></i>
	                                </div> 
	                            </div>
	                            <div class="fw-bold">
	                                <div class="small text-gray-500"><?php  $life = date('M d, Y h:i:s a',strtotime($item['created']));
	                                 echo $life; ?></div>
	                                <span class="font-weight-bold"><?php echo $item['first_name']." ".$item['last_name']." has a message for you "; ?></span>
	                            </div>
	                            <?php
			                        }
			                    }
	                            ?>
		                          </a>
		                          <a class="dropdown-item text-center small text-gray-500" href="../faculty/notification.php">Show All Notifications</a>
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
		                        <li><a class="dropdown-item" href="../faculty/profile.php?acc_id=<?php echo $_SESSION["acc_id"] ?>"><i class="fas fa-user-circle fa-lg me-2" style="color: #8C0000;"></i> Profile</a></li>
		                        <li><a class="dropdown-item" href="../faculty/change-pass.php"><i class="fas fa-lock fa-lg me-2" style="color: #8C0000;"></i> Change Password</a></li>
		                        <li><a class="dropdown-item" href=""data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fas fa-sign-out-alt fa-lg me-2" style="color: #8C0000;"></i> Log out</a></li>
		                    </ul>
		                </div>
		            </form>
		        </div>
		        <!-- Main Content-->
		        <div class="col py-3 overflow-auto">
					<div class="container-fluid ">
						<form action="save_pre_data.php" method="POST">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body">
										<?php
                                        $id = $_GET['id'];

									     $preboard= mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question WHERE pre_exam_id = '$id'");
										while ($area =mysqli_fetch_assoc($preboard)) { ?>

											<h4 class="fw-bold">Editing preboard: Area of Examination - <?php echo $area['subjects']; ?></h4>
										<?php } ?>
										
										<div class="d-flex justify-content-between mt-3">
											<div class="d-flex flex-row">
												<?php
												$let = $_GET['id'];

											    $select = mysqli_query($sqlcon,"SELECT * FROM test_question,tbl_pre_question,tbl_pre_choose_quest WHERE (test_question.question_id=tbl_pre_choose_quest.question_id) AND (tbl_pre_question.pre_exam_id=tbl_pre_choose_quest.pre_exam_id) AND tbl_pre_choose_quest.pre_exam_id='$let' AND pre_choose_status='active'");
											    $preboard= mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question WHERE pre_exam_id = '$id'");

											    while ($rows = mysqli_fetch_assoc($preboard)) {
											    	$num = mysqli_num_rows($select);
													$total = $rows['total_question'];

													if (mysqli_num_rows($select) ==0) {
														echo '<p class="ms-2">Questions:
														<span class="badge bg-danger" style="font-size: 15px;"> '.$num.' out of '.$total.'</span></p> ';
													}
													elseif (mysqli_num_rows($select) >0) {
														echo '<p class="ms-2">Questions:
														<span class="badge bg-success" style="font-size: 15px;"> '.$num.' out of '.$total.'</span></p> ';
													}
											    }

												 ?>
												<span>
													<?php 
													  
													   $preboard= mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question WHERE pre_exam_id = '$id'");
													   while ($rows = mysqli_fetch_assoc($preboard)) {
													   	       if ($rows['Approval']=='approve') {
													            	echo '<p class="ms-1">|  <strong class="text-success ms-2">This preboard is now approved</strong></p>';
													           }
													           elseif ($rows['Approval']=='pending') {
													            	echo '<p class="ms-2">|  <strong class="text-warning ms-1">This preboard is not approved yet</strong></p>';
													            }
													            elseif ($rows['Approval']=='decline') {
													            	echo '<p class="ms-2">|  <strong class="text-danger ms-1">This preboard is has been decline</strong></p>';
													            }
													    }

													   ?>   
												</span>
											</div>
											<?php 

											$save= mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question WHERE stat_exam='Ready' AND pre_exam_id = '$id'");

											if (mysqli_num_rows($save) == 0) {
												
												echo '
												<input type="hidden" name="update" value="'.$_GET['id'].'">
											<input class="btn btn-success px-4 pb-2 disabled" type="submit" name="save" value="Save">';
											}
											elseif (mysqli_num_rows($save)>=0) {
												
												echo '<input type="hidden" name="update" value="'.$_GET['id'].'">
											<input class="btn btn-secondary px-4 pb-2" type="submit" name="save" value="Save" disabled>';
											}


											?>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 mt-2">
								<div class="card">
									<div class="card-body m-4">

											<?php
												
												if (isset($_SESSION['validate'])) { ?>
													
												<div class="alert alert-success alert-dismissible fade show" role="alert">
												  <strong><?php echo $_SESSION['validate']; ?></strong> 
												  <button type="button" class=" btn-close" data-bs-dismiss="alert" aria-label="Close">
												  </button>
												</div>
												<?php

												unset($_SESSION['validate']);
												}

												elseif (isset($_SESSION['exists'])) { ?>
												
												<div class="alert alert-success alert-dismissible fade show" role="alert">
												  <strong><?php echo $_SESSION['exists']; ?></strong> 
												  <button type="button" class=" btn-close" data-bs-dismiss="alert" aria-label="Close">
												  </button>
												</div>

												<?php 

												unset($_SESSION['exists']);
												}
											?>
										<div class="d-flex justify-content-between mb-3">
											<button data-id="<?php echo $id; ?>"  class="btn btn-warning px-3 pb-2 editinfo"  data-bs-toggle="modal" type="button"><i class="fas fa-edit"></i>
											</button>
											<div class="d-flex">
												<div class="dropdown me-2">
													<a class="btn btn-outline-white border-0 bg-white text-dark fw-bold dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Add</a>
													<?php 
												   $preboard= mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question WHERE pre_exam_id = '$id'");
												   $board = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_choose_quest WHERE pre_exam_id = '$id'");

												   $nums = mysqli_num_rows($board);

												   while ($rows = mysqli_fetch_assoc($preboard)) { 
												   	$total = $rows['total_question'];

												   	?>
												  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
												  	<?php
												  	$tot = $_GET['total'];

												  	if ($total == $nums) {
												  		echo "<li><a class='dropdown-item'><i class='fas fa-plus me-2'></i>a new Questions</a>
												    	 	</li>
												    	 	<div class='dropdown-divider'></div>
												    	 	<li><a class='dropdown-item' data-bs-toggle='#' data-bs-target='#'><i class='fas fa-plus me-2'></i>from Question Bank</a></li>
												    	 	<div class='dropdown-divider'></div>
												    	 	<li><a class='dropdown-item' data-bs-toggle='#' data-bs-target='#'><i class='fas fa-plus me-2'></i>a random question</a></li>
												    	 		";
												  	}
												  	else {
												  		echo "<li><a class='dropdown-item disabled' href='adding-preboard-question.php?id=$id&total=$tot'><i class='fas fa-plus me-2'></i>a new Questions </a></li>
												    		<div class='dropdown-divider'></div>
												    		<li><a class='dropdown-item disabled' data-bs-toggle='modal' data-bs-target='#exampleModal2'><i class='fas fa-plus me-2'></i>from Question Bank</a></li>
												    		<div class='dropdown-divider'></div>
												    	 	<li><a class='dropdown-item disabled' data-bs-toggle='modal' data-bs-target='#addRandom'><i class='fas fa-plus me-2'></i>a random question</a></li>";

												  	}

												  	 ?>
												  </ul>
												   <?php }  ?>
												</div>
												<div class="dropdown">
													<a class="btn btn-outline-white border-0 bg-white text-dark fw-bold dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-cog"></i>
													</a>
													<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
														<li><a class="dropdown-item userbtn disabled" data-bs-toggle='modal' data-bs-target="#userModal"><i class="fas fa-calendar-alt me-2"></i>Date & Time</a></li>
														<div class='dropdown-divider'></div>
														<li><a class="dropdown-item" data-bs-toggle='modal' data-bs-target='#resultModal'><i class="fas fa-chart-bar me-2"></i>Results</a></li>
													</ul>
												</div>
											</div>
										</div>
										<div class="table-responsive-xl">
											<table class="table bg-light table-hover" id="question">
												<thead>
													<tr>
														<th hidden="">ID</th>
														<th>No.</th>
														<th>Area of Exam</th>
														<th>Question</th>
														<th class="ps-5">Action</th>
												    </tr>
												</thead>
												<tbody>
												<?php
												$id = $_GET['id'];

										    	$select = mysqli_query($sqlcon,"SELECT * FROM test_question,tbl_pre_question,tbl_pre_choose_quest WHERE (test_question.question_id=tbl_pre_choose_quest.question_id) AND (tbl_pre_question.pre_exam_id=tbl_pre_choose_quest.pre_exam_id) AND tbl_pre_choose_quest.pre_exam_id='$id' AND pre_choose_status='active'");
										    	if (mysqli_num_rows($select) ==0) { ?>
										    		<tr class="table-danger">
												    	<td></td>
												    	<td></td>
												    	<td>No questions has been added yet</td>
												    	<td></td>
												    </tr> 
										    	<?php
												}
												elseif (mysqli_num_rows($select) >0) {
													$counter = 1;
													while ($rows = mysqli_fetch_assoc($select)) { 
												?>
													<tr>
														<td hidden=""><?php echo $rows['exam_choose_id'] ?></td>
												    	<td><?php echo $counter ;?></td>
												    	<td><?php echo $rows['subjects'];?></td>
												    	<td><?php echo $rows['questions_title'];?></td>
												    	<td>
												    		<div class="d-flex flex-row">
													      		<button data-id="<?php echo $rows['question_id']; ?>" type="button" class="btn btn-primary  mx-2 prev_btn" data-bs-toggle="modal"><i class="fas fa-search-plus"></i></button>
													      		<?php
													      		$del_quer = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question WHERE pre_exam_id='{$_GET['id']}'");
													      		while ($qwer = mysqli_fetch_assoc($del_quer)) {
													      		
														      		if ($qwer['stat_exam']=='No question') {
														      			
														      			echo '<button type="button" class="btn btn-secondary deletebtn  mx-2" data-bs-toggle="modal" ><i class="fas fa-trash-alt"></i></button>';
														      		}
														      		else {

														      			echo '<button type="button" class="btn btn-secondary  mx-2"><i class="fas fa-trash-alt"></i></button>';
														      		}
													      		}

													      		 ?>
		                                                	</div>
		                                                </td>
												    </tr>
												     <?php $counter++;  }  } ?> 
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
		</section>
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
	                    <form action="logout_faculty.php" class="hide" method="POST">
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
	    <!-- Delete Question -->
	    <div class="modal fade" id="ArchiveAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	    	<div class="modal-dialog">
	    		<div class="modal-content">
	    			<div class="modal-header flex-column border-0">
	    				<h5 class="modal-title fw-bold fs-4" id="exampleModalLabel "></h5>
	    				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	    				<div class="icon-box mt-3">
        					<i class="far fa-times-circle fa-5x text-danger"></i>
        				</div>
        				<h3 class="modal-title text-align-center mt-3 fw-bold">Are you sure?</h3>
	    			</div>
	    			<form class="form" action="../php/delete_pre_question.php" method="POST">
	    				<div class="modal-body">
	    					<div class="container d-flex justify-content-center">
	    						<input type="hidden" name="update_id" id="delete_id">
	    						<input type="hidden" name="total" value="<?php echo $_GET['total']?>">
	    						<input type="hidden" name="lets" value="<?php echo $_GET['id']?>">
	    						<p>Do you really want to delete these question?</p>
	    					</div>
	    					<div class="modal-footer border-0 d-flex justify-content-center">
	        					<input type="submit" name="save" class="btn btn-success px-5 pb-2 text-white" value="Yes">
	        					<button type="button" class="btn btn-danger  px-5 pb-2 text-white" data-bs-dismiss="modal">No</button>
							</div>
	    				</div>
	    			</form>
	    		</div>
	    	</div>
	    </div>

		<!--Add from the Question bank modal-->
		<div class="modal fade " data-bs-backdrop="true"  id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl  modal-fullscreen-xl-down ">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title fw-bold" id="exampleModalLabel">Add from the Question Bank</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form action="update_pre_board_question.php" method="POST">
							<div class="row">
								<div class="col-lg-6">
									<div class="input-group mt-2">
										<span class="input-group-text bg-white fw-bold">Area of Exam</span>
										<select class="form-select" name="subjects" id="subjects" required>
											<option selected value="">Select a Category</option>
											<option value="Criminal Jurisprudence">Criminal Jurisprudence</option>
											<option value="Law Enforcement">Law Enforcement</option>
											<option value="Criminalistics">Criminalistics</option>
											<option value="Crime Detection and Investigation">Crime Detection and Investigation</option>
											<option value="Criminal Sociology">Criminal Sociology</option>
											<option value="Correctional Administration">Correctional Administration</option>
										</select>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="input-group mt-2">
										<span class="input-group-text bg-white fw-bold">Level of Difficulty</span>
										<select class="form-select custom-select difficult" name="difficult" id="difficult" required>
											<option selected value="">Select Difficulty</option>
											<option value="Easy">Easy</option>
											<option  value="Moderate">Moderate</option>
											<option value="Hard">Hard</option>
										</select>
									</div>
								</div>
								<input type="hidden" name="prepared_by" value="<?php echo $_SESSION['acc_id']; ?>">
							</div>
							<div class="card mt-2">
								<div class="card-body">
									<div class="table-responsive-xl" id="test">
										<div class="table-wrapper-scroll-y my-custom-scrollbar">
											<table class="table bg-light table-hover" style="font-size: 15px;" id="pre_board">
												<thead>
													<tr>
														<th><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></th>	
														<th hidden>ID</th>
														<th scope="col">Question</th>
														<th scope="col">Action</th>
													</tr>
												</thead>
												<tbody>
													 <?php 

														     
												      $Slow = mysqli_query($sqlcon,"SELECT * FROM test_question");
												      while ($now = mysqli_fetch_assoc($Slow)) {

												        $_SESSION['exam'] = $now['question_id']; ?>
													<tr>
														<td><input type="checkbox" class="checkbox" name="chkl[]" id="question_id<?php echo $now['question_id'];  ?>"  value="<?php echo $_SESSION['exam'] ?>" data-id="<?php echo $now['question_id']; ?>"></td>
														<td hidden><?php echo $now['question_id']?></td>
														<td><?php echo $now['questions_title'] ?></td>
														<td><button data-id="<?php echo $now['question_id']; ?>" type="button" class="btn btn-primary popover-test view_btn" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="fas fa-eye"></i></button></td>
													</tr>

												 <?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

																	<?php

									$tots = $_GET['total'];

									$valss = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_choose_quest WHERE pre_exam_id = {$_GET['id']}");
									$val_runsd = mysqli_num_rows($valss);

									$val_totals = $tots - $val_runsd;

									?>
								<input type="hidden" name="total" value="<?php echo $val_totals; ?>">
								<input type="hidden" name="all_tot" value="<?php echo $_GET['total']; ?>">
								<button type="submit" name="create" class="btn btn-success">Add selected questions</button>
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Add Ramdom question Modal -->
		<div class="modal fade" id="addRandom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title fw-bold" id="exampleModalLabel">Add a random question</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form action="function_random_preboard.php" method="POST">
							<div class="card border-0">
								<div class="card-body mx-3">
									<div class="mb-2 row">
										<label for="Area" class="col-sm-4 col-form-label fw-bold">Area of Examination</label>
										<div class="col-sm-6"> 
											<select class="form-select" name="area_exam" id="area_exam">
												<option selected value="">Select Category</option>
												<option value="Criminal Jurisprudence">Criminal Jurisprudence</option>
												<option value="Law Enforcement">Law Enforcement</option>
												<option value="Criminalistics">Criminalistics</option>
												<option value="Crime Detection and Investigation">Crime Detection and Investigation</option>
												<option value="Criminal Sociology">Criminal Sociology</option>
												<option value="Correctional Administration">Correctional Administration</option>
											</select>
										</div>
									</div>
									<input class="form-control" type="hidden" name="prepared_by" value="<?php echo $_SESSION['acc_id'] ?>">
									<div class="row">
										<label for="number" class="col-sm-4 col-form-label fw-bold">Number of random question</label>
										<div class="col-sm-3">
											<select class="form-select" name="t_question" id="t_question">
												<?php

												$tts = $_GET['total'];

												$val = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_choose_quest WHERE pre_exam_id = {$_GET['id']}");
												$val_ruin = mysqli_num_rows($val);

												$val_totalae = $tts - $val_ruin;

												for($i =1; $i <= $val_totalae; $i+=1){
													echo '
													<option>'.$i.'</option>';
												}
												?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="card mt-2">
								<div class="card-body" id="preb">
									<p class="fw-bold">Questions matching this filter: 0 </p>
									<div class="table-responsive-xl">
										<div class="table-wrapper-scroll-y my-custom-scrollbar">
											<table class="table bg-light table-hover" style="font-size: 15px;" id="pre_board">
												<thead>
													<tr>	
														<th hidden>ID</th>
														<th scope="col">Question</th>
													</tr>
												</thead>
												<tbody>
													 <?php 

														     
												      $Slow = mysqli_query($sqlcon,"SELECT * FROM test_question");
												      while ($now = mysqli_fetch_assoc($Slow)) {

												        $_SESSION['exam'] = $now['question_id']; ?>
													<tr>
														
														<td hidden><?php echo $now['question_id']?></td>
														<td><?php echo $now['questions_title'] ?></td>
													</tr>

												 <?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<input type="hidden" name="test_id" value="<?php echo $_GET['id'] ?>">
								<input type="hidden" name="total" value="<?php echo $_GET['total'] ?>">
								<button type="submit" name="create" class="btn btn-success">Add random questions</button>
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- View Action Modal -->
		<div class="modal fade" id="exampleModalToggle2" data-bs-backdrop="true"  aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title fw-bold" id="exampleModalToggleLabel2">View question</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="logs">
							
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" data-bs-target="#exampleModal2" data-bs-toggle="modal" data-bs-dismiss="modal">Back to Add question</button>
					</div>
				</div>
			</div>
		</div>
		
		<!--Preview Question Modal -->
		<div class="modal fade" id="Viewmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header border-0">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="base">
							
						</div>
					</div>
					<div class="modal-footer border-0">
						<button type="button" class="btn btn-secondary pb-2 px-4" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Edit Information Modal -->
		<div class="modal fade" id="editinformation" data-bs-backdrop="static"  aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title fw-bold" id="exampleModalToggleLabel2">Exam Information</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="information">
							
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Time And Date modal -->
		<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<form action="date_time_preboard.php" method="POST">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title fw-bold" id="exampleModalLabel">Date and Time</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="card border-0">
								<div class="card-body">
									<div class="input-group mb-2">
										<input type="hidden" name="userover_id" value="<?php echo $_GET['id'] ?>">
										<input type="hidden" name="t_question" value="<?php echo $total ?>">
										<span class="input-group-text bg-white fw-bold">Open Quiz</span>
										<?php
										$date = mysqli_query($sqlcon,"SELECT * FROM accounts,tbl_pre_question WHERE acc_id = '{$_SESSION['acc_id']}'AND (tbl_pre_question.pre_exam_id='$id')");
										$get = mysqli_fetch_assoc($date);
										$open = strtotime($get['start_date']);
										$end = strtotime($get['end_date']);
										$total =($get['total_question']);
										 ?>
										<input type="datetime-local" name="start_time" class="form-control" required value="<?php echo date('Y-m-d\TH:i',$open); ?>">
									</div>
									<div class="input-group mb-2">
										<span class="input-group-text bg-white fw-bold">Close Quiz</span>
										<input type="datetime-local" name="close_time" class="form-control" required value="<?php echo date('Y-m-d\TH:i',$end); ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" name="sub" class="btn btn-success rounded px-4">Save</button>
							<button type="button" class="btn btn-secondary rounded px-4" data-bs-dismiss="modal">Cancel</button>
						</div>
					</div>
				</form>
			</div>
		</div>

		<!--Results Modal -->
		<div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title fw-bold" id="exampleModalLabel">Score Release</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="card border-0">
							<div class="card-body">
								<div class="table-responsive-xl">
									<table class="table table-hover bg-light table-striped" id="resultTab">
										<thead>
											<tr>
												<th scope="col">ID</th>
												<th scope="col">Fullname</th>
												<th scope="col">Section</th>
												<th scope="col">Score</th>
												<th scope="col">Percentage</th>
												<th scope="col">Remarks</th>
												<th scope="col">Date submitted</th>
											</tr>
										</thead>
										<tbody>
											<?php

											$accounts = mysqli_query($sqlcon,"SELECT * FROM accounts,tbl_pre_question WHERE acc_id = '{$_SESSION['acc_id']}'AND (tbl_pre_question.pre_exam_id='$id')");

											while ($row = mysqli_fetch_assoc($accounts)) {
												if ($row['section']=='4A'){

												  $id = $_GET['id'];
												  $result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts WHERE (tbl_exam_result.acc_id=accounts.acc_id) AND (tbl_exam_result.pre_exam_id='$id') AND(accounts.section='4A')");

												  while ($hows= mysqli_fetch_array($result)) { ?>
												  	<tr>
														<td><?php echo $hows['user_id']?></td>
														<td><?php echo $hows['last_name']." ".$hows['first_name']." ".$hows['middle_name']?></td>
														<td><?php echo $hows['section']?></td>
														<td><?php echo $hows['score']?></td>
														<td><?php echo $hows['score_percent']?> %</td>

														 <?php if ($hows['result']=='passed') { ?>
		                                                 <td><span class="badge bg-success text-uppercase" style="font-size: 14px;"><?php echo $hows['result'] ?></td>
			                                            <?php
			                                            }elseif ($hows['result']=='failed') { ?>
			                                                <td ><span class="badge bg-danger text-uppercase" style="font-size: 14px;"><?php echo $hows['result'] ?></span></td>
			                                            <?php
			                                            } 
			                                            ?>

														<?php 
														$id = $_GET['id'];
														$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts WHERE (tbl_exam_result.acc_id=accounts.acc_id) AND (tbl_exam_result.pre_exam_id='$id') AND(accounts.section='4A')");

														while ($rows= mysqli_fetch_assoc($result)) {
															date_default_timezone_set('Asia/Manila');

															 $submit = strtotime($rows['date_created']);

															 echo'<td>'. date("m-d-Y",$submit).'</td>';
														}
														 ?>
													</tr>

												<?php  }
											  }
											  elseif ($row['section']=='4B') {
											  	 $id = $_GET['id'];
												  $result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts WHERE (tbl_exam_result.acc_id=accounts.acc_id) AND (tbl_exam_result.pre_exam_id='$id') AND(accounts.section='4B')");

												  while ($hows= mysqli_fetch_array($result)) { ?>
												  	<tr>
														<td><?php echo $hows['user_id']?></td>
														<td><?php echo $hows['last_name']." ".$hows['first_name']." ".$hows['middle_name']?></td>
														<td><?php echo $hows['section']?></td>
														<td><?php echo $hows['score']?></td>
														<td><?php echo $hows['score_percent']?> %</td>

														 <?php if ($hows['result']=='passed') { ?>
		                                                 <td><span class="badge bg-success text-uppercase" style="font-size: 14px;"><?php echo $hows['result'] ?></td>
			                                            <?php
			                                            }elseif ($hows['result']=='failed') { ?>
			                                                <td ><span class="badge bg-danger text-uppercase" style="font-size: 14px;"><?php echo $hows['result'] ?></span></td>
			                                            <?php
			                                            } 
			                                            ?>

														<?php 
														$id = $_GET['id'];
														$result = mysqli_query($sqlcon,"SELECT * FROM tbl_quiz_result,accounts WHERE (tbl_quiz_result.acc_id=accounts.acc_id) AND (tbl_quiz_result.test_id='$id') AND(accounts.section='4A')");

														while ($rows= mysqli_fetch_assoc($result)) {
															date_default_timezone_set('Asia/Manila');

															 $submit = strtotime($rows['date_created']);

															 echo'<td>'. date("m-d-Y",$submit).'</td>';
														}
														 ?>
													</tr>

												<?php  }
											  		
											  }
											  elseif ($row['section']=='4C') {
											  	  $id = $_GET['id'];
												  $result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts WHERE (tbl_exam_result.acc_id=accounts.acc_id) AND (tbl_exam_result.pre_exam_id='$id') AND(accounts.section='4C')");

												  while ($hows= mysqli_fetch_assoc($result)) { ?>
												  	<tr>
														<td><?php echo $hows['user_id']?></td>
														<td><?php echo $hows['last_name']." ".$hows['first_name']." ".$hows['middle_name']?></td>
														<td><?php echo $hows['section']?></td>
														<td><?php echo $hows['score']?></td>
														<td><?php echo $hows['score_percent']?> %</td>

														 <?php if ($hows['result']=='passed') { ?>
		                                                 <td><span class="badge bg-success text-uppercase" style="font-size: 14px;"><?php echo $hows['result'] ?></td>
			                                            <?php
			                                            }elseif ($hows['result']=='failed') { ?>
			                                                <td ><span class="badge bg-danger text-uppercase" style="font-size: 14px;"><?php echo $hows['result'] ?></span></td>
			                                            <?php
			                                            } 
			                                            ?>

			                                            
			                                            <td>
			                                            	<?php

			                                            	echo date('M d, Y h:i:s a',strtotime($hows['date_created']));
			                                            	?>
			                                            </td>
													</tr>

												<?php  }
											  	}	
											}		
										?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

</body>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/dt-1.10.25datatables.min.js"></script>
<script src="../js/jquery.durationpicker.js"></script>
<script type="text/javascript">
 	$(document).ready(function() {
 		$('.deletebtn').on('click', function() {

 			$('#ArchiveAccount').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            console.log(data);
            $('#delete_id').val(data[0]);
        })
 	});
</script>
 <script type="text/javascript">

  // var of select input difficult

  // var of select input subject


 
  $('select').on('change', function() {
    var name = this.name;
    var difficult;
    var subjects;

       // alert(  name);



       if (name=="difficult") {
          difficult = this.value;
          subjects = $("#subjects").val();
       }else if (name=="subjects") {
          difficult =$("#difficult").val();
          subjects =  this.value;

       }else{
        return false;
       }
      

      $.ajax({    //create an ajax request to load_page.php
      type:"POST",
      url: "fetch.php",             
      dataType: "text",   //expect html to be returned  
      data:{difficult:difficult,subjects:subjects},               
      success: function(data){     
      $("#test").hide();    
      $("#test").fadeIn();             
      $("#test").html(data); 
        // alert(data);

      }

      });


  });

</script>
 <script type="text/javascript">

  // var of select input difficult

  // var of select input subject


 
  $('select').on('change', function() {
    var name = this.name;
    var area_exam;

       // alert(  name);



       if (name=="area_exam") {
          area_exam = this.value;
       }else{
        return false;
       }
      

      $.ajax({    //create an ajax request to load_page.php
      type:"POST",
      url: "update_filter.php",             
      dataType: "text",   //expect html to be returned  
      data:{area_exam:area_exam},               
      success: function(data){     
      $("#preb").hide();    
      $("#preb").fadeIn();             
      $("#preb").html(data); 
        // alert(data);

      }

      });


  });

</script>

 <!-- View modal --->
 <script type="text/javascript">

   $(document).ready(function(){
    $('.view_btn').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: '../php/view_modal_pre_editing.php',
        type: 'post',
        data: {userid: userid},
        success: function(response){
          $('.logs').html(response);
          $('#exampleModalToggle2').modal('show');
        }
      });
    });
   });
 </script>

  <!-- preview modal --->
 <script type="text/javascript">

   $(document).ready(function(){
    $('.prev_btn').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: '../php/prev_modal_pre_board.php',
        type: 'post',
        data: {userid: userid},
        success: function(response){
          $('.base').html(response);
          $('#Viewmodal').modal('show');
        }
      });
    });
   });
 </script>

 <!--Edit info modal -->
 <script type="text/javascript">
 	$(document).ready(function(){
 		$('.editinfo').click(function(){
 			var userid = $(this).data('id');

 			$.ajax({
 				url: '../php/editinfopreboard.php',
        		type: 'post',
        		data: {userid: userid},
        		success: function(response){
          		$('.information').html(response);
          		$('#editinformation').modal('show');
          	}
          });
    	});
   	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#question').DataTable({
			paging: true
		});
	});
</script>
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
</html>