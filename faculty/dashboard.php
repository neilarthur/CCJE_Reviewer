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
	<title>Dashboard</title>
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
	<!-- JS Chart-->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<style>
       .dp .dropdown-toggle::after {
            content: none;
        }
        .navbar .breadcrumb li a{
		  color: #8C0000;
		}
    </style>
</head>
<body>
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
					<li><a class="link_name" href=testbank.php>Question Bank</a></li>
				</ul>
			</li>
			<li>
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
						<div class="profile_name"><a class="profile text-warning" href="profile.php?acc_id=<?php echo $_SESSION["acc_id"] ?>"><?php echo $_SESSION["first_name"];?></a></div>
						<div class="job"><?php echo $_SESSION["role"];  ?></div>
					</div>
				</div>
			</li>
		</div>
		<section class="home-section float-start" >
			<div class="home-content d-flex justify-content-between" style="background: white;">
				<div class="d-flex">
					<button style="border-style: none; background: white; height: 20px;" class="btn-sm mt-3">
						<i class='bx bx-menu' ></i>
					</button>
					<nav class="navbar navbar-expand-lg navbar-light" style="margin-top: 10px; margin-left: 12px;" >
						<div class="container-fluid">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashboard.php" style="text-decoration: none;">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
								</ol>
							</nav>
						</div>
					</nav>
				</div>
				<form class="d-flex">
					<!--- Notification -->
					<div class="dropdown dp mt-3">
		                <a class="text-reset dropdown-toggle text-decoration-none" href="#"id="navbarDropdownMenuLink" role="button"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell fa-lg "></i>
		                	<?php $come = mysqli_query($sqlcon,"SELECT * FROM tbl_response  WHERE response_stat='0' ORDER BY response_id DESC");
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

	                            <div>

	                                <div class="small text-gray-500"><?php  $life = date('F j, Y, g:i a',strtotime($item['created']));
	                                 echo $life; ?></div>
	                                <span class="fw-bold"><?php echo $item['first_name']." ".$item['last_name']."&nbsp;has a message from you"; ?></span>
	                                
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
			<div class="container-fluid py-3 px-4">
				<div class="row">
					<!-- Students Card Example -->
					<div class="col-lg-3 col-xs-6 mb-3">
						<div class="card border-left-dark shadow h-100 py-1" style="background-color: rgb(221, 75, 57);">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-white text-uppercase mb-2">
											<?php
											$acc= mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");

											while ($rows=mysqli_fetch_assoc($acc)) {
												if ($rows['section']=='4A') {
													$query = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE role='student'AND status='active' AND(accounts.section='4A')");
													 
													 $row = mysqli_num_rows($query);
													  echo'<h2  class=" mb-0 fw-bold"><b>'.$row.' </b></h2>';
												}
												elseif ($rows['section']=='4B') {
													$query = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE role='student'AND status='active' AND(accounts.section='4B')");
													 $row = mysqli_num_rows($query);
													  echo'<h2  class=" mb-0 fw-bold"><b>'.$row.' </b></h2>';
												}
												elseif ($rows['section']=='4C') {
													$query = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE role='student'AND status='active' AND(accounts.section='4C')");
													 $row = mysqli_num_rows($query);
													  echo'<h2  class=" mb-0 fw-bold"><b>'.$row.' </b></h2>';
												}
												
											} ?>
                                            Students
	                                    </div>
	                                </div>
	                                <div class="col-auto mt-2 text-white">
	                                    <i class="fas fa-user-graduate fa-3x"></i>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="col-lg-3 col-xs-6 mb-3">
						<div class="card border-left-dark shadow h-100 py-1" style="background-color: rgb(243, 156, 18 );">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-white text-uppercase mb-2">
											<?php 

											$acc= mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");

											while ($rows=mysqli_fetch_assoc($acc)) {
												if ($rows['section']=='4A') {
													$exams = mysqli_query($sqlcon,"SELECT * FROM accounts,choose_question WHERE (accounts.acc_id = choose_question.prepared_by) AND(accounts.section='4A') AND (choose_question.status='active')");

													$row = mysqli_num_rows($exams);

													echo'<h2  class=" mb-0 fw-bold"><b>'.$row.' </b></h2>';
												}
												elseif ($rows['section']=='4B') {
													$exams = mysqli_query($sqlcon,"SELECT * FROM accounts,choose_question WHERE (accounts.acc_id = choose_question.prepared_by) AND(accounts.section='4B') AND (choose_question.status='active')");

													$row = mysqli_num_rows($exams);

													echo'<h2  class=" mb-0 fw-bold"><b>'.$row.' </b></h2>';
												}
												elseif ($rows['section']=='4C') {
													$exams = mysqli_query($sqlcon,"SELECT * FROM accounts,choose_question WHERE (accounts.acc_id = choose_question.prepared_by) AND(accounts.section='4C') AND (choose_question.status='active')");
													$row = mysqli_num_rows($exams);

													echo'<h2  class=" mb-0 fw-bold"><b>'.$row.' </b></h2>';
												}
											} ?>
	                                        Quiz and Long Quiz
	                                    </div>
	                                </div>
	                                <div class="col-auto mt-2 text-white">
	                                    <i class="far fa-sticky-note fa-3x"></i>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                 <div class="col-lg-3 col-xs-6 mb-3">
						<div class="card border-left-dark shadow h-100 py-1" style="background-color: rgb(0, 115, 183);">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-white text-uppercase mb-2">
											<?php 
											$acc = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");

											while ($rows=mysqli_fetch_assoc($acc)) {
												if ($rows['section']=='4A') {
													$preboard = mysqli_query($sqlcon,"SELECT * FROM accounts,tbl_pre_question WHERE (accounts.acc_id = tbl_pre_question.prepared_by) AND (accounts.section='4A')  AND (tbl_pre_question.pre_board_status='active')");

                                                    $row = mysqli_num_rows($preboard);
                                                    echo'<h2  class=" mb-0 fw-bold"><b>'.$row.' </b></h2>';
												}
												elseif ($rows['section']=='4B') {
													$preboard = mysqli_query($sqlcon,"SELECT * FROM accounts,tbl_pre_question WHERE (accounts.acc_id = tbl_pre_question.prepared_by) AND (accounts.section='4B')  AND (tbl_pre_question.pre_board_status='active')");

                                                    $row = mysqli_num_rows($preboard);
                                                    echo'<h2  class=" mb-0 fw-bold"><b>'.$row.' </b></h2>';
												}
												elseif ($rows['section']=='4C') {
													$preboard = mysqli_query($sqlcon,"SELECT * FROM accounts,tbl_pre_question WHERE (accounts.acc_id = tbl_pre_question.prepared_by) AND (accounts.section='4C')  AND (tbl_pre_question.pre_board_status='active')");

                                                    $row = mysqli_num_rows($preboard);
                                                    echo'<h2  class=" mb-0 fw-bold"><b>'.$row.' </b></h2>';
												}
											} ?>
	                                        Preboard Exam
	                                    </div>
	                                </div>
	                                <div class="col-auto mt-2 text-white">
	                                    <i class="far fa-list-alt fa-3x"></i>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                 <div class="col-lg-3 col-xs-6 mb-3">
						<div class="card border-left-dark shadow h-100 py-1" style="background-color: rgb(0, 192, 239);">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-white text-uppercase mb-2">
											<?php 
											$acc = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}' AND role = 'faculty'");

											while ($rows = mysqli_fetch_assoc($acc)) {
												if ($rows['section']=='4A') {
													$question = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND (test_question.status='active') AND (accounts.section='4A')");

													$row = mysqli_num_rows($question);
													echo'<h2  class=" mb-0 fw-bold"><b>'.$row.' </b></h2>';

												}
												elseif ($rows['section']=='4B') {
	                                                $question = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND (test_question.status='active') AND (accounts.section='4B')");
													$row = mysqli_num_rows($question);
													echo'<h2  class=" mb-0 fw-bold"><b>'.$row.' </b></h2>';
												}
												elseif ($rows['section']=='4C') {
													$question = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND (test_question.status='active') AND (accounts.section='4C')");

													$row = mysqli_num_rows($question);
													echo'<h2  class=" mb-0 fw-bold"><b>'.$row.' </b></h2>';
												}
											} ?>
	                                        Questions
	                                    </div>
	                                </div>
	                                <div class="col-auto mt-2 text-white">
	                                    <i class="fas fa-question fa-3x"></i>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                 <div class="col-lg-4">
	                 	<div class="card h-100">
                           <div class="card-body">
                           	<h5 class="card-title fw-bold">Question Count</h5>
                            <?php

                            $acc = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}' AND role = 'faculty'");
                            while ($rows =mysqli_fetch_assoc($acc)) {
                            	if ($rows['section']=='4B'){

                            		$question = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND(test_question.subject_name='Criminal Jurisprudence ') AND (test_question.status='active') AND (accounts.section='4B')");

                            		$rows_count_value = mysqli_num_rows($question);

                            		$question1 = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND(test_question.subject_name='Law Enforcement') AND (test_question.status='active') AND (accounts.section='4B')");

                            		$rows_count_value1 = mysqli_num_rows($question1);

                            		$question2 = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND(test_question.subject_name='Criminalistics') AND (test_question.status='active') AND (accounts.section='4B')");

                            		$rows_count_value2 = mysqli_num_rows($question2);

                            		$question3 = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND(test_question.subject_name='Crime Detection and Investigation') AND (test_question.status='active') AND (accounts.section='4B')");

                           			 $rows_count_value3 = mysqli_num_rows($question3);

                           			 $question4 = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND(test_question.subject_name='Criminal Sociology') AND (test_question.status='active') AND (accounts.section='4B')");

                           			 $rows_count_value4 = mysqli_num_rows($question4);

                           			  $question5 = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND(test_question.subject_name='Correctional Administration') AND (test_question.status='active') AND (accounts.section='4B')");

                            		$rows_count_value5 = mysqli_num_rows($question5);

                            	}
                            	elseif ($rows['section']=='4C') {
                            		$question = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND(test_question.subject_name='Criminal Jurisprudence ') AND (test_question.status='active') AND (accounts.section='4C')");

                            		$rows_count_value = mysqli_num_rows($question);

                            		$question1 = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND(test_question.subject_name='Law Enforcement') AND (test_question.status='active') AND (accounts.section='4C')");

                            		$rows_count_value1 = mysqli_num_rows($question1);

                            		$question2 = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND(test_question.subject_name='Criminalistics') AND (test_question.status='active') AND (accounts.section='4C')");

                            		$rows_count_value2 = mysqli_num_rows($question2);

                            		$question3 = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND(test_question.subject_name='Crime Detection and Investigation') AND (test_question.status='active') AND (accounts.section='4C')");

                           			 $rows_count_value3 = mysqli_num_rows($question3);

                           			 $question4 = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND(test_question.subject_name='Criminal Sociology') AND (test_question.status='active') AND (accounts.section='4C')");

                           			 $rows_count_value4 = mysqli_num_rows($question4);

                           			  $question5 = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND(test_question.subject_name='Correctional Administration') AND (test_question.status='active') AND (accounts.section='4C')");

                            		$rows_count_value5 = mysqli_num_rows($question5);
                            	}
                            	elseif ($rows['section']=='4A') {
                            		$question = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND(test_question.subject_name='Criminal Jurisprudence ') AND (test_question.status='active') AND (accounts.section='4A')");

                            		$rows_count_value = mysqli_num_rows($question);

                            		$question1 = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND(test_question.subject_name='Law Enforcement') AND (test_question.status='active') AND (accounts.section='4A')");

                            		$rows_count_value1 = mysqli_num_rows($question1);

                            		$question2 = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND(test_question.subject_name='Criminalistics') AND (test_question.status='active') AND (accounts.section='4A')");

                            		$rows_count_value2 = mysqli_num_rows($question2);

                            		$question3 = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND(test_question.subject_name='Crime Detection and Investigation') AND (test_question.status='active') AND (accounts.section='4A')");

                           			 $rows_count_value3 = mysqli_num_rows($question3);

                           			 $question4 = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND(test_question.subject_name='Criminal Sociology') AND (test_question.status='active') AND (accounts.section='4A')");

                           			 $rows_count_value4 = mysqli_num_rows($question4);

                           			  $question5 = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND(test_question.subject_name='Correctional Administration') AND (test_question.status='active') AND (accounts.section='4A')");

                            		$rows_count_value5 = mysqli_num_rows($question5);
                            	}
                            }
                            
                             ?>
                            <!-- Pie Chart-->
                            <canvas id="pie-chart" style="position: relative; height:40px; width:80px"></canvas>

                            <script >
                                new Chart(document.getElementById("pie-chart"), {
                                    type: 'pie',
                                     data: {
                                        labels: ["Criminal Jurisprudence ", "Law Enforcement", "Criminalistics ","Crime Detection and Investigation "," Criminal Sociology "," Correctional Administration"],
                                        datasets: [{
                                            
                                            backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#775FEC","#FF6666","#FFAA00"],
                                            data: [<?php echo $rows_count_value ?>,<?php echo $rows_count_value1 ?>,<?php echo $rows_count_value2 ?>,<?php echo $rows_count_value3 ?>,<?php echo $rows_count_value4 ?>,<?php echo $rows_count_value5 ?>]
                                        }]
                                    },
                                    options: {
                                     title: {
                                        display: true,
                                        text: 'Percentage of Each Section of Examination'
                                    }
                                }
                            });
                            </script>
                         </div>
                      </div>
                   </div>
                   <div class="col-lg-8">
                   	 <div class="card h-100">
                   	  	<div class="card-body">
                   			<?php

                   	  		 $acc = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}' AND role = 'faculty'");
                   	  		 while ($rows =mysqli_fetch_assoc($acc)) {
                   	  		 	if ($rows ['section'] == '4A') {
                   	  		 		 // Criminal Sociology //
		                            $query = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Criminal Sociology') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4A')");

		                            $fetch = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id) AND(tbl_pre_question.subjects = 'Criminal Sociology') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4A')");
		                            $percent = mysqli_num_rows($fetch);

		                            // Criminal Jurisprudence//
		                            $query1 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Criminal Jurisprudence')AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4A') ");

		                            $fetch1 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id) AND(tbl_pre_question.subjects = 'Criminal Jurisprudence') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4A')");

		                            $percent1 = mysqli_num_rows($fetch1);

		                            // Law Enforcement//
		                            $query2 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Law Enforcement') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4A')");

		                            $fetch2 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id) AND(tbl_pre_question.subjects = 'Law Enforcement') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4A')");
		                            $percent2 = mysqli_num_rows($fetch2);

		                              // Criminalistics//
		                            $query3 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Criminalistics') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4A')");

		                            $fetch3 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id) AND(tbl_pre_question.subjects = 'Criminalistics') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4A')");
		                            $percent3 = mysqli_num_rows($fetch3);

		                               // Crime and Detection//
		                            $query4 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Crime and Detection') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4A')");

		                            $fetch4 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id) AND(tbl_pre_question.subjects = 'Crime and Detection') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4A')");
		                            $percent4 = mysqli_num_rows($fetch4);

		                              // Correctional Administration//
		                            $query5 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Correctional Administration') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4A')");

		                            $fetch5 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id) AND(tbl_pre_question.subjects = 'Correctional Administration') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4A')");
		                            $percent5 = mysqli_num_rows($fetch5);
                   	  		 	}
                   	  		 	elseif ($rows ['section'] == '4B') {
                   	  		 		 // Criminal Sociology //
		                            $query = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Criminal Sociology') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4B')");

		                            $fetch = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id) AND(tbl_pre_question.subjects = 'Criminal Sociology') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4B')");
		                            $percent = mysqli_num_rows($fetch);

		                            // Criminal Jurisprudence//
		                            $query1 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Criminal Jurisprudence')AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4B') ");

		                            $fetch1 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id) AND(tbl_pre_question.subjects = 'Criminal Jurisprudence') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4B')");

		                            $percent1 = mysqli_num_rows($fetch1);

		                            // Law Enforcement//
		                            $query2 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Law Enforcement') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4B')");

		                            $fetch2 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id) AND(tbl_pre_question.subjects = 'Law Enforcement') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4B')");
		                            $percent2 = mysqli_num_rows($fetch2);

		                              // Criminalistics//
		                            $query3 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Criminalistics') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4B')");

		                            $fetch3 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id) AND(tbl_pre_question.subjects = 'Criminalistics') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4B')");
		                            $percent3 = mysqli_num_rows($fetch3);

		                               // Crime and Detection//
		                            $query4 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Crime and Detection') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4B')");

		                            $fetch4 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id) AND(tbl_pre_question.subjects = 'Crime and Detection') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4B')");
		                            $percent4 = mysqli_num_rows($fetch4);

		                              // Correctional Administration//
		                            $query5 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Correctional Administration') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4B')");

		                            $fetch5 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id) AND(tbl_pre_question.subjects = 'Correctional Administration') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4B')");
		                            $percent5 = mysqli_num_rows($fetch5);
                   	  		 	}
                   	  		 	elseif ($rows ['section'] == '4C') {
                   	  		 		// Criminal Sociology //
		                            $query = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Criminal Sociology') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4C')");

		                            $fetch = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id) AND(tbl_pre_question.subjects = 'Criminal Sociology') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4C')");
		                            $percent = mysqli_num_rows($fetch);

		                            // Criminal Jurisprudence//
		                            $query1 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Criminal Jurisprudence')AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4C') ");

		                            $fetch1 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id) AND(tbl_pre_question.subjects = 'Criminal Jurisprudence') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4C')");

		                            $percent1 = mysqli_num_rows($fetch1);

		                            // Law Enforcement//
		                            $query2 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Law Enforcement') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4C')");

		                            $fetch2 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id) AND(tbl_pre_question.subjects = 'Law Enforcement') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4C')");
		                            $percent2 = mysqli_num_rows($fetch2);

		                              // Criminalistics//
		                            $query3 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Criminalistics') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4C')");

		                            $fetch3 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id) AND(tbl_pre_question.subjects = 'Criminalistics') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4C')");
		                            $percent3 = mysqli_num_rows($fetch3);

		                               // Crime and Detection//
		                            $query4 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Crime and Detection') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4C')");

		                            $fetch4 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id) AND(tbl_pre_question.subjects = 'Crime and Detection') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4C')");
		                            $percent4 = mysqli_num_rows($fetch4);

		                              // Correctional Administration//
		                            $query5 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Correctional Administration') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4C')");

		                            $fetch5 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id) AND(tbl_pre_question.subjects = 'Correctional Administration') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.section='4C')");
		                            $percent5 = mysqli_num_rows($fetch5);
                   	  		 	}
                   	  		 }

                           

                            while ($row= mysqli_fetch_assoc($query) ) {
                                 if ($percent == 0) {
                                    $percent =1;
                                    $per [] = $row['num'] /$percent;
                                }
                                else{
                                    $per [] = $row['num'] /$percent;
                                }
                                
                            }
                            while ($row1= mysqli_fetch_assoc($query1)) {
                                if ($percent1 == 0) {
                                    $percent1 =1;
                                    $per1 [] = $row1['num'] /$percent1;
                                }
                                else{
                                    $per1 [] = $row1['num'] /$percent1;
                                }
                            }
                             while ($row2= mysqli_fetch_assoc($query2)) {
                                if ($percent2 == 0) {
                                    $percent2 =1;
                                    $per2 [] = $row2['num'] /$percent2;
                                }
                                else{
                                    $per2 [] = $row2['num'] /$percent2;
                                }
                            }
                             while ($row3= mysqli_fetch_assoc($query3)) {
                                if ($percent3 == 0) {
                                    $percent3 =1;
                                    $per3 [] = $row3['num'] /$percent3;
                                }
                                else{
                                    $per3 [] = $row3['num'] /$percent3;
                                }
                            }
                            while ($row4= mysqli_fetch_assoc($query4)) {
                                if ($percent4 == 0) {
                                    $percent4 =1;
                                    $per4 [] = $row4['num'] /$percent4;
                                }
                                else{
                                    $per4 [] = $row4['num'] /$percent4;
                                }
                            }
                             while ($row5= mysqli_fetch_assoc($query5)) {
                                if ($percent5 == 0) {
                                    $percent5 =1;
                                    $per5 [] = $row5['num'] /$percent5;
                                }
                                else{
                                    $per5 [] = $row5['num'] /$percent5;
                                }
                            }
                             ?>
                   			<canvas id="myChart" style="position: relative; height:40px; width:80px"></canvas>
                   			<script type="text/javascript">
                   				const ctx = document.getElementById('myChart').getContext('2d');
								const myChart = new Chart(ctx, {
								    type: 'bar',
								    data: {
								        labels: ["Class Preboard Exam Percentage"],
								        datasets: [{
								             label: "Criminal Jurisprudence ",
									         backgroundColor: "#3e95cd",
									         data: <?php echo json_encode($per1) ?>,
									      },{
									         label: "Law Enforcement",
									         backgroundColor: "#8e5ea2",
									         data: <?php echo json_encode($per2) ?>,
									      },{
									         label: "Criminalistics",
									         backgroundColor: "#3cba9f",
									         data: <?php echo json_encode($per3) ?>,
									      },{
									         label: "Crime Detection and Investigation",
									         backgroundColor: "#775FEC",
									         data: <?php echo json_encode($per4) ?>,
									      },{
									         label: "Criminal Sociology",
									         backgroundColor: "#FF6666",
									         data: <?php echo json_encode($per) ?>,
									      },{
									         label: "Correctional Administration",
									         backgroundColor: "#FFAA00",
									         data: <?php echo json_encode($per5) ?>,

								        }]
								    },
								    options: {
								        scales: {
                                            y: {
                                                min: 0,
                                                max: 100,
                                                ticks: {
                                                    stepSize: 20,
                                                    callback: function(value, index, values) {
                                                        return value + " %";
                                                    }            
                                                }
                                            }
                                        }
								    }
								});

                   			</script>
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
	$(document).ready(function(){
		$("#navbarDropdownMenuLink").on("click",function(){
			$.ajax({
				url:"readnotification.php",
				success: function(come){
					console.log(come);
				}
			});
		});
	});
</script>

<?php 
#Login success
if (isset($_GET['loginsuccess'])) {
  echo ' <script> swal("Login succesful!", " clicked the okay!", "success");
  window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/faculty/dashboard.php");
  </script>';
}
?>
</html>