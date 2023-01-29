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
	<title>Exam Results</title>
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
	<!-- Font Awesome -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"rel="stylesheet"/>
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
					<li><a class="link_name" href=testbank.php>Question Bank</a></li>
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
					<div class="profile-content">
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
									<li class="breadcrumb-item"><a href="dashboard.php" style="text-decoration: none;">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Exam Results</li>
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
	                                <span class="font-weight-bold"><?php echo $item['first_name']." ".$item['last_name']." has a message for you "; ?></span>
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
								<h2 class="text-dark text-start ps-3 fw-bold mt-4 ms-3">Examination Results</h2>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3">
							<div class="card mt-2">
								<div class="card-body">
									<p class="h4 text-uppercase fw-bold text-center">Categories</p>
									<nav class="tab-content text-uppercase" style="font-size: 15px;">
										<div class="nav nav-pills" id="nav-tab" role="tablist">
											<button class="nav-link active w-100 border border-dark px-5 pb-2 rounded mt-2" id="nav-criminal-jurisprudence-tab" data-bs-toggle="pill" data-bs-target="#nav-criminal" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fas fa-voicemail me-2"></i>Criminal Jurisprudence</button>
											<button class="nav-link w-100 border border-dark px-5 pb-2 rounded mt-2" id="nav-law-tab" data-bs-toggle="pill" data-bs-target="#nav-law-enforcement" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-book me-2"></i>Law Enforcement</button>
											<button class="nav-link w-100 border border-dark px-5 pb-2 rounded mt-2" id="nav-crimalistics-tab" data-bs-toggle="pill" data-bs-target="#nav-criminalistics" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fas fa-balance-scale me-2"></i>Criminalistics</button>
											<button class="nav-link w-100 border border-dark px-5 pb-2 rounded mt-2 text-left" id="nav-crime-tab" data-bs-toggle="pill" data-bs-target="#nav-crime" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fas fa-search me-2"></i>Crime Detection & Investigation</button>
											<button class="nav-link w-100 border border-dark px-5 pb-2 rounded mt-2" id="nav-sociology-tab" data-bs-toggle="pill" data-bs-target="#nav-sociology" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fas fa-handshake me-2"></i>Criminal Sociology</button>
											<button class="nav-link w-100 border border-dark px-5 pb-2 rounded mt-2" id="nav-correctional-tab" data-bs-toggle="pill" data-bs-target="#nav-correctional" type="button" role="tab" aria-controls="nav-contact" aria-selected="false"><i class="fas fa-gavel me-2"></i>Correctional Administration</button>
										</div>
									</nav>
								</div>
							</div>
					    </div>
					    <div class="col-lg-9">
					    	<div class="tab-content" id="nav-tabContent">
					    		<div class="tab-pane fade show active" id="nav-criminal" role="tabpanel" aria-labelledby="nav-criminal-jurisprudence-tab">
						    		<div class="card mt-2">
							    		<div class="card-body rounded-3 table-responsive-xl">
							    		<?php
							    		
							    			$accounts6 = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");

												while ($block6 = mysqli_fetch_assoc($accounts6)) {
													
													if ($block6['section']=='4C') {

														$record6 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts,tbl_pre_question WHERE (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.pre_exam_id = tbl_pre_question.pre_exam_id) AND (tbl_pre_question.subjects = 'Criminal Jurisprudence') AND (tbl_pre_question.pre_board_status='active') AND (tbl_pre_question.prepared_by='{$_SESSION['acc_id']}')");

														if (mysqli_num_rows($record6) == 0) {
															
															echo '<div class="dropdown mb-2 d-flex justify-content-end">
							    				
												    				<button class="btn btn-secondary dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" disabled>
												    					Download
												    				</button>
												    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

												    					<li><a class="dropdown-item" href="#"><i class="fas fa-download me-2"></i>Download Results</a></li>
												    					<li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Results</a></li>
												    				</ul>
												    			</div>';
														}
														elseif (mysqli_num_rows($record6) > 0) {


															$recs6 = mysqli_fetch_assoc($record6);

															echo '<div class="dropdown mb-2 d-flex justify-content-end">

													    				<button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8C0000;">
													    					Download
													    				</button>
													    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

													    					<form action="download_juris.php" method="POST">
													    						<input type="hidden" name="file_type" value="xlsx">
													    						<li><button type="submit" name="export_excel_btn" class="dropdown-item"><i class="fas fa-download me-2"></i>Download Results</button></li>
													    					</form>
													    					<li><a class="dropdown-item" href="print_juris.php?id='.$recs6['pre_exam_id'].'&sec='.$block6['section'].'" target="_blank"><i class="fas fa-print me-2"></i>Print Results</a></li>
													    				</ul>
													    			</div>';
														}

													}
													elseif ($block6['section']=='4B') {
														
														$record6 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts,tbl_pre_question WHERE (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.pre_exam_id = tbl_pre_question.pre_exam_id)  AND (tbl_pre_question.subjects = 'Criminal Jurisprudence') AND (tbl_pre_question.pre_board_status='active') AND (tbl_pre_question.prepared_by='{$_SESSION['acc_id']}')");

														if (mysqli_num_rows($record6) == 0) {
															
															echo '<div class="dropdown mb-2 d-flex justify-content-end">
							    				
												    				<button class="btn btn-secondary dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" disabled>
												    					Download
												    				</button>
												    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

												    					<form action="download_juris.php" method="POST">
												    						<input type="hidden" name="file_type" value="xlsx">
												    						<li><button type="submit" name="export_excel_btn" class="dropdown-item"><i class="fas fa-download me-2"></i>Download Results</button></li>
												    					</form>
												    					<li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Results</a></li>
												    				</ul>
												    			</div>';
														}
														elseif (mysqli_num_rows($record6) > 0) {

															$recs6 = mysqli_fetch_assoc($record6);

															echo '<div class="dropdown mb-2 d-flex justify-content-end">

													    				<button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8C0000;">
													    					Download
													    				</button>
													    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

													    					<form action="download_juris.php" method="POST">
													    						<input type="hidden" name="file_type" value="xlsx">
													    						<li><button type="submit" name="export_excel_btn" class="dropdown-item"><i class="fas fa-download me-2"></i>Download Results</button></li>
													    					</form>
													    					<li><a class="dropdown-item" href="print_juris.php?id='.$recs6['pre_exam_id'].'&sec='.$block6['section'].'" target="_blank"><i class="fas fa-print me-2"></i>Print Results</a></li>
													    				</ul>
													    			</div>';
														}

													}
													elseif ($block6['section']=='4A') {
														
														$record6 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts,tbl_pre_question WHERE (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.pre_exam_id = tbl_pre_question.pre_exam_id) AND (tbl_pre_question.subjects = 'Criminal Jurisprudence') AND (tbl_pre_question.pre_board_status='active') AND (tbl_pre_question.prepared_by='{$_SESSION['acc_id']}')");

														if (mysqli_num_rows($record6) == 0) {
															
															echo '<div class="dropdown mb-2 d-flex justify-content-end">
							    				
												    				<button class="btn btn-secondary dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" disabled>
												    					Download
												    				</button>
												    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

												    					<form action="download_juris.php" method="POST">
												    						<input type="hidden" name="file_type" value="xlsx">
												    						<li><button type="submit" name="export_excel_btn" class="dropdown-item"><i class="fas fa-download me-2"></i>Download Results</button></li>
												    					</form>
												    					<li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Results</a></li>
												    				</ul>
												    			</div>';
														}
														elseif (mysqli_num_rows($record6) > 0) {

															$recs6 = mysqli_fetch_assoc($record6);

															echo '<div class="dropdown mb-2 d-flex justify-content-end">

													    				<button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8C0000;">
													    					Download
													    				</button>
													    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

													    					<form action="download_juris.php" method="POST">
													    						<input type="hidden" name="file_type" value="xlsx">
													    						<li><button type="submit" name="export_excel_btn" class="dropdown-item"><i class="fas fa-download me-2"></i>Download Results</button></li>
													    					</form>
													    					<li><a class="dropdown-item" href="print_juris.php?id='.$recs6['pre_exam_id'].'&sec='.$block6['section'].'" target="_blank"><i class="fas fa-print me-2"></i>Print Results</a></li>
													    				</ul>
													    			</div>';
														}
													}
												}
							    				?>
						    				<table class="table table-hover align-middle" width="100%" id="resultTab">
												<thead>
													<tr>
														<th scope="col">No.</th>
														<th scope="col">Name</th>
														<th scope="col">Section</th>
														<th scope="col">Area of Exam</th>
														<th scope="col">Score</th>
														<th scope="col">Percentage</th>
														<th scope="col">Remarks</th>
														<th scope="col">Action</th>
													</tr>
												</thead>
												<tbody>
													<?php 
													$accounts = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");

													while ($row = mysqli_fetch_assoc($accounts)) {
														if ($row['section']=='4C') {
															$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND(tbl_pre_question.subjects = 'Criminal Jurisprudence') AND(accounts.section='4C') AND (tbl_pre_question.pre_board_status='active') ORDER BY accounts.last_name ASC");

															$counter = 1;
															while ($rows = mysqli_fetch_assoc($result)) { ?>
																<tr>
																	<td><?php echo $counter ;?></td>
					                                                <td><?php echo $rows['last_name']." ".$rows['first_name']." ".$rows['middle_name']?></td>
					                                                <td><?php echo $rows['section'] ?></td>
					                                                <td><?php echo $rows['subjects'] ?></td>
					                                                 <td><?php echo $rows['score'] ?></td>
					                                                <td><?php echo $rows['score_percent'] ?>%</td>
					                                                <?php
						                                                $remarks = $rows['result'];
						                                                if ($remarks =="passed") { ?>
						                                                <td class="text-uppercase text-success fw-bold"><h5><span class="badge bg-success"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }
						                                                elseif ($remarks =="failed") { ?>
						                                                <td class="text-uppercase text-danger fw-bold"><h5><span class="badge bg-danger"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }  ?>
					                                                <td>
					                                                	<div class="d-flex flex-row">
					                                                		<button data-id="<?php echo $rows['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
					                                                	</div>
					                                                </td>
					                                            </tr>

															<?php $counter++; } ?>

													  <?php	}
													  elseif ($row['section']=='4B') {

													  	$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND(tbl_pre_question.subjects = 'Criminal Jurisprudence') AND(accounts.section='4B') and (tbl_pre_question.pre_board_status='active') ORDER BY accounts.last_name ASC");
													  	    $counter = 1;
															while ($rows = mysqli_fetch_assoc($result)) { ?>
																<tr>
																	<td><?php echo $counter ;?></td>
					                                                <td><?php echo $rows['last_name']." ".$rows['first_name']." ".$rows['middle_name']?></td>
					                                                <td><?php echo $rows['section'] ?></td>
					                                                <td><?php echo $rows['subjects'] ?></td>
					                                                 <td><?php echo $rows['score'] ?></td>
					                                                <?php
						                                                $remarks = $rows['result'];
						                                                if ($remarks =="passed") { ?>
						                                                <td class="text-uppercase text-success fw-bold"><h5><span class="badge bg-success"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }
						                                                elseif ($remarks =="failed") { ?>
						                                                <td class="text-uppercase text-danger fw-bold"><h5><span class="badge bg-danger"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }  ?>
					                                                <td class="text-uppercase text-success fw-bold"><?php echo $rows['result'] ?></td>
					                                                <td>
					                                                	<div class="d-flex flex-row">
					                                                		<button data-id="<?php echo $rows['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
					                                                	</div>
					                                                </td>
					                                            </tr>

															<?php $counter++; } ?>

													 <?php }
													 elseif ($row['section']=='4A') {
													 	$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND(tbl_pre_question.subjects = 'Criminal Jurisprudence') AND(accounts.section='4A') and (tbl_pre_question.pre_board_status='active') ORDER BY accounts.last_name ASC");
													 	 $counter = 1;
														while ($rows = mysqli_fetch_assoc($result)) { ?>
															<tr>
																<td><?php echo $counter ;?></td>
				                                                <td><?php echo $rows['last_name']." ".$rows['first_name']." ".$rows['middle_name']?></td>
				                                                <td><?php echo $rows['section'] ?></td>
				                                                <td><?php echo $rows['subjects'] ?></td>
				                                                <td><?php echo $rows['score'] ?></td>
				                                                <td><?php echo $rows['score_percent'] ?>%</td>
				                                                <?php
					                                                $remarks = $rows['result'];
					                                                if ($remarks =="passed") { ?>
					                                                <td class="text-uppercase text-success fw-bold"><h5><span class="badge bg-success"><?php echo $rows['result'] ?></span></h5></td>
					                                            <?php }
					                                                elseif ($remarks =="failed") { ?>
					                                                <td class="text-uppercase text-danger fw-bold"><h5><span class="badge bg-danger"><?php echo $rows['result'] ?></span></h5></td>
					                                            <?php }  ?>
				                                                <td>
				                                                	<div class="d-flex flex-row">
				                                                		<button data-id="<?php echo $rows['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
				                                                	</div>
				                                                </td>
				                                            </tr>

															<?php $counter++; } ?>
													 <?php }
													}

													?>
		                                        </tbody>
		                                    </table>
							    		</div>
							    	</div>
						    	</div>
						    	<div class="tab-pane fade" id="nav-law-enforcement" role="tabpanel" aria-labelledby="nav-law-enforcement">
					    		<div class="card mt-2">
							    		<div class="card-body rounded-3 table-responsive-xl">
							    		<?php

							    			$accounts5 = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");

												while ($block5 = mysqli_fetch_assoc($accounts5)) {
													
													if ($block5['section']=='4C') {

														$record5 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts,tbl_pre_question WHERE (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.pre_exam_id = tbl_pre_question.pre_exam_id) AND (tbl_pre_question.subjects = 'Law Enforcement') AND (tbl_pre_question.pre_board_status='active') AND (tbl_pre_question.prepared_by='{$_SESSION['acc_id']}')");

														if (mysqli_num_rows($record5) == 0) {
															
															echo '<div class="dropdown mb-2 d-flex justify-content-end">
							    				
												    				<button class="btn btn-secondary dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" disabled>
												    					Download
												    				</button>
												    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

												    					<li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Results</a></li>
												    				</ul>
												    			</div>';
														}
														elseif (mysqli_num_rows($record5) > 0) {

															$recs5 = mysqli_fetch_assoc($record5);

															echo '<div class="dropdown mb-2 d-flex justify-content-end">

													    				<button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8C0000;">
													    					Download
													    				</button>
													    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

													    					<form action="download_law.php" method="POST">
													    						<input type="hidden" name="file_type" value="xlsx">
													    						<li><button type="submit" name="export_excel_btn" class="dropdown-item"><i class="fas fa-download me-2"></i>Download Results</button></li>
													    					</form>
													    					<li><a class="dropdown-item" href="print_law.php?id='.$recs5['pre_exam_id'].'&sec='.$block5['section'].'" target="_blank"><i class="fas fa-print me-2"></i>Print Results</a></li>
													    				</ul>
													    			</div>';
														}

													}
													elseif ($block5['section']=='4B') {
														
														$record5 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts,tbl_pre_question WHERE (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.pre_exam_id = tbl_pre_question.pre_exam_id)  AND (tbl_pre_question.subjects = 'Law Enforcement') AND (tbl_pre_question.pre_board_status='active') AND (tbl_pre_question.prepared_by='{$_SESSION['acc_id']}')");

														if (mysqli_num_rows($record5) == 0) {
															
															echo '<div class="dropdown mb-2 d-flex justify-content-end">
							    				
												    				<button class="btn btn-secondary dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" disabled>
												    					Download
												    				</button>
												    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
												    					<li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Results</a></li>
												    				</ul>
												    			</div>';
														}
														elseif (mysqli_num_rows($record5) > 0) {

															$recs5 = mysqli_fetch_assoc($record5);

															echo '<div class="dropdown mb-2 d-flex justify-content-end">

													    				<button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8C0000;">
													    					Download
													    				</button>
													    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

													    					<form action="download_law.php" method="POST">
													    						<input type="hidden" name="file_type" value="xlsx">
													    						<li><button type="submit" name="export_excel_btn" class="dropdown-item"><i class="fas fa-download me-2"></i>Download Results</button></li>
													    					</form>
													    					<li><a class="dropdown-item" href="print_law.php?id='.$recs5['pre_exam_id'].'&sec='.$block5['section'].'" target="_blank"><i class="fas fa-print me-2"></i>Print Results</a></li>
													    				</ul>
													    			</div>';
														}

													}
													elseif ($block5['section']=='4A') {
														
														$record5 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts,tbl_pre_question WHERE (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.pre_exam_id = tbl_pre_question.pre_exam_id) AND (tbl_pre_question.subjects = 'Law Enforcement') AND (tbl_pre_question.pre_board_status='active') AND (tbl_pre_question.prepared_by='{$_SESSION['acc_id']}')");

														if (mysqli_num_rows($record5) == 0) {
															
															echo '<div class="dropdown mb-2 d-flex justify-content-end">
							    				
												    				<button class="btn btn-secondary dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" disabled>
												    					Download
												    				</button>
												    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

												    					
												    					<li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Results</a></li>
												    				</ul>
												    			</div>';
														}
														elseif (mysqli_num_rows($record5) > 0) {

															$recs5 = mysqli_fetch_assoc($record5);

															echo '<div class="dropdown mb-2 d-flex justify-content-end">

													    				<button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8C0000;">
													    					Download
													    				</button>
													    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

													    					<form action="download_law.php" method="POST">
													    						<input type="hidden" name="file_type" value="xlsx">
													    						<li><button type="submit" name="export_excel_btn" class="dropdown-item"><i class="fas fa-download me-2"></i>Download Results</button></li>
													    					</form>
													    					<li><a class="dropdown-item" href="print_law.php?id='.$recs5['pre_exam_id'].'&sec='.$block5['section'].'" target="_blank"><i class="fas fa-print me-2"></i>Print Results</a></li>
													    				</ul>
													    			</div>';
														}
													}
												}
							    				?>
						    				<table class="table table-hover align-middle" width="100%" id="lawTab">
												<thead>
													<tr>
														<th scope="col">No.</th>
														<th scope="col">Name</th>
														<th scope="col">Section</th>
														<th scope="col">Area of Exam</th>
														<th scope="col">Score</th>
														<th scope="col">Percentage</th>
														<th scope="col">Remarks</th>
														<th scope="col">Action</th>
													</tr>
												</thead>
												<tbody>
													<?php 
													$accounts = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");

													while ($row = mysqli_fetch_assoc($accounts)) {
														if ($row['section']=='4C') {
															$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND(tbl_pre_question.subjects = 'Law Enforcement') AND(accounts.section='4C') AND (tbl_pre_question.pre_board_status='active') ORDER BY accounts.last_name ASC");

															$counter = 1;
															while ($rows = mysqli_fetch_assoc($result)) { ?>
																<tr>
																	<td><?php echo $counter ;?></td>
					                                                <td><?php echo $rows['last_name']." ".$rows['first_name']." ".$rows['middle_name']?></td>
					                                                <td><?php echo $rows['section'] ?></td>
					                                                <td><?php echo $rows['subjects'] ?></td>
					                                                 <td><?php echo $rows['score'] ?></td>
					                                                <td><?php echo $rows['score_percent'] ?>%</td>
					                                                <?php
						                                                $remarks = $rows['result'];
						                                                if ($remarks =="passed") { ?>
						                                                <td class="text-uppercase text-success fw-bold"><h5><span class="badge bg-success"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }
						                                                elseif ($remarks =="failed") { ?>
						                                                <td class="text-uppercase text-danger fw-bold"><h5><span class="badge bg-danger"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }  ?>
					                                                <td>
					                                                	<div class="d-flex flex-row">
					                                                		<button data-id="<?php echo $rows['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
					                                                	</div>
					                                                </td>
					                                            </tr>

															<?php $counter++; } ?>

													  <?php	}
													  elseif ($row['section']=='4B') {

													  	$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND(tbl_pre_question.subjects = 'Law Enforcement') AND(accounts.section='4B') AND (tbl_pre_question.pre_board_status='active') ORDER BY accounts.last_name ASC");
													  	    $counter = 1;
															while ($rows = mysqli_fetch_assoc($result)) { ?>
																<tr>
																	<td><?php echo $counter ;?></td>
					                                                <td><?php echo $rows['last_name']." ".$rows['first_name']." ".$rows['middle_name']?></td>
					                                                <td><?php echo $rows['section'] ?></td>
					                                                <td><?php echo $rows['subjects'] ?></td>
					                                                 <td><?php echo $rows['score'] ?></td>
					                                                <td><?php echo $rows['score_percent'] ?>%</td>
					                                                <?php
						                                                $remarks = $rows['result'];
						                                                if ($remarks =="passed") { ?>
						                                                <td class="text-uppercase text-success fw-bold"><h5><span class="badge bg-success"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }
						                                                elseif ($remarks =="failed") { ?>
						                                                <td class="text-uppercase text-danger fw-bold"><h5><span class="badge bg-danger"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }  ?>
					                                                <td>
					                                                	<div class="d-flex flex-row">
					                                                		<button data-id="<?php echo $rows['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
					                                                	</div>
					                                                </td>
					                                            </tr>

															<?php $counter++; } ?>

													 <?php }
													 elseif ($row['section']=='4A') {
													 	$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND(tbl_pre_question.subjects = 'Law Enforcement') AND(accounts.section='4A') AND (tbl_pre_question.pre_board_status='active') ORDER BY accounts.last_name ASC");
													 	 $counter = 1;
														while ($rows = mysqli_fetch_assoc($result)) { ?>
															<tr>
																<td><?php echo $counter ;?></td>
				                                                <td><?php echo $rows['last_name']." ".$rows['first_name']." ".$rows['middle_name']?></td>
				                                                <td><?php echo $rows['section'] ?></td>
				                                                <td><?php echo $rows['subjects'] ?></td>
				                                                 <td><?php echo $rows['score'] ?></td>
				                                                <td><?php echo $rows['score_percent'] ?>%</td>
				                                                <?php
					                                                $remarks = $rows['result'];
					                                                if ($remarks =="passed") { ?>
					                                                <td class="text-uppercase text-success fw-bold"><h5><span class="badge bg-success"><?php echo $rows['result'] ?></span></h5></td>
					                                            <?php }
					                                                elseif ($remarks =="failed") { ?>
					                                                <td class="text-uppercase text-danger fw-bold"><h5><span class="badge bg-danger"><?php echo $rows['result'] ?></span></h5></td>
					                                            <?php }  ?>
				                                                <td>
				                                                	<div class="d-flex flex-row">
				                                                		<button data-id="<?php echo $rows['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
				                                                	</div>
				                                                </td>
				                                            </tr>

															<?php $counter++; } ?>
													 <?php }
													}

													?>
		                                        </tbody>
		                                    </table>
							    		</div>
							    	</div>
					    	   </div>
					    	   <div class="tab-pane fade" id="nav-criminalistics" role="tabpanel" aria-labelledby="nav-criminalistics">
					    		    <div class="card mt-2">
							    		<div class="card-body rounded-3 table-responsive-xl">
							    										    										    				<?php

												$accounts4 = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");

												while ($block4 = mysqli_fetch_assoc($accounts4)) {
													
													if ($block4['section']=='4C') {

														$record4 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts,tbl_pre_question WHERE (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.pre_exam_id = tbl_pre_question.pre_exam_id) AND (tbl_pre_question.subjects = 'Criminalistics') AND (tbl_pre_question.pre_board_status='active') AND (tbl_pre_question.prepared_by='{$_SESSION['acc_id']}')");

														if (mysqli_num_rows($record4) == 0) {
															
															echo '<div class="dropdown mb-2 d-flex justify-content-end">
							    				
												    				<button class="btn btn-secondary dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" disabled>
												    					Download
												    				</button>
												    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

												    					<li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Results</a></li>
												    				</ul>
												    			</div>';
														}
														elseif (mysqli_num_rows($record4) > 0) {

															$recs4 = mysqli_fetch_assoc($record4);

															echo '<div class="dropdown mb-2 d-flex justify-content-end">

													    				<button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8C0000;">
													    					Download
													    				</button>
													    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

													    					<form action="download_criminal.php" method="POST">
													    						<input type="hidden" name="file_type" value="xlsx">
													    						<li><button type="submit" name="export_excel_btn" class="dropdown-item"><i class="fas fa-download me-2"></i>Download Results</button></li>
													    					</form>
													    					<li><a class="dropdown-item" href="print_crimanalist.php?id='.$recs4['pre_exam_id'].'&sec='.$block4['section'].'" target="_blank"><i class="fas fa-print me-2"></i>Print Results</a></li>
													    				</ul>
													    			</div>';
														}

													}
													elseif ($block4['section']=='4B') {
														
														$record4 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts,tbl_pre_question WHERE (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.pre_exam_id = tbl_pre_question.pre_exam_id)  AND (tbl_pre_question.subjects = 'Criminalistics') AND (tbl_pre_question.pre_board_status='active') AND (tbl_pre_question.prepared_by='{$_SESSION['acc_id']}')");

														if (mysqli_num_rows($record4) == 0) {
															
															echo '<div class="dropdown mb-2 d-flex justify-content-end">
							    				
												    				<button class="btn btn-secondary dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" disabled>
												    					Download
												    				</button>
												    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

												    					<li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Results</a></li>
												    				</ul>
												    			</div>';
														}
														elseif (mysqli_num_rows($record4) > 0) {

															$recs4 = mysqli_fetch_assoc($record4);

															echo '<div class="dropdown mb-2 d-flex justify-content-end">

													    				<button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8C0000;">
													    					Download
													    				</button>
													    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

													    					<form action="download_criminal.php" method="POST">
													    						<input type="hidden" name="file_type" value="xlsx">
													    						<li><button type="submit" name="export_excel_btn" class="dropdown-item"><i class="fas fa-download me-2"></i>Download Results</button></li>
													    					</form>
													    					<li><a class="dropdown-item" href="print_criminalist.php?id='.$recs4['pre_exam_id'].'&sec='.$block4['section'].'" target="_blank"><i class="fas fa-print me-2"></i>Print Results</a></li>
													    				</ul>
													    			</div>';
														}

													}
													elseif ($block4['section']=='4A') {
														
														$record4 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts,tbl_pre_question WHERE (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.pre_exam_id = tbl_pre_question.pre_exam_id) AND (tbl_pre_question.subjects = 'Criminalistics') AND (tbl_pre_question.pre_board_status='active') AND (tbl_pre_question.prepared_by='{$_SESSION['acc_id']}')");

														if (mysqli_num_rows($record4) == 0) {
															
															echo '<div class="dropdown mb-2 d-flex justify-content-end">
							    				
												    				<button class="btn btn-secondary dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" disabled>
												    					Download
												    				</button>
												    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

												    					<li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Results</a></li>
												    				</ul>
												    			</div>';
														}
														elseif (mysqli_num_rows($record4) > 0) {


															$recs4 = mysqli_fetch_assoc($record4);


															echo '<div class="dropdown mb-2 d-flex justify-content-end">

													    				<button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8C0000;">
													    					Download
													    				</button>
													    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

													    					<form action="download_criminal.php" method="POST">
													    						<input type="hidden" name="file_type" value="xlsx">
													    						<li><button type="submit" name="export_excel_btn" class="dropdown-item"><i class="fas fa-download me-2"></i>Download Results</button></li>
													    					</form>
													    					<li><a class="dropdown-item" href="print_criminalist.php?id='.$recs4['pre_exam_id'].'&sec='.$block4['section'].'" target="_blank"><i class="fas fa-print me-2"></i>Print Results</a></li>
													    				</ul>
													    			</div>';
														}
													}
												}
							    				?>
						    				<table class="table table-hover align-middle" width="100%" id="criminalTab">
												<thead>
													<tr>
														<th scope="col">No.</th>
														<th scope="col">Name</th>
														<th scope="col">Section</th>
														<th scope="col">Area of Exam</th>
														<th scope="col">Score</th>
														<th scope="col">Percentage</th>
														<th scope="col">Remarks</th>
														<th scope="col">Action</th>
													</tr>
												</thead>
												<tbody>
													<?php 
													$accounts = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");

													while ($row = mysqli_fetch_assoc($accounts)) {
														if ($row['section']=='4C') {
															$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND(tbl_pre_question.subjects = 'Criminalistics') AND(accounts.section='4C') AND (tbl_pre_question.pre_board_status='active') ORDER BY accounts.last_name ASC");

															$counter = 1;
															while ($rows = mysqli_fetch_assoc($result)) { ?>
																<tr>
																	<td><?php echo $counter ;?></td>
					                                                <td><?php echo $rows['last_name']." ".$rows['first_name']." ".$rows['middle_name']?></td>
					                                                <td><?php echo $rows['section'] ?></td>
					                                                <td><?php echo $rows['subjects'] ?></td>
					                                                 <td><?php echo $rows['score'] ?></td>
					                                                <td><?php echo $rows['score_percent'] ?>%</td>
					                                                <?php
						                                                $remarks = $rows['result'];
						                                                if ($remarks =="passed") { ?>
						                                                <td class="text-uppercase text-success fw-bold"><h5><span class="badge bg-success"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }
						                                                elseif ($remarks =="failed") { ?>
						                                                <td class="text-uppercase text-danger fw-bold"><h5><span class="badge bg-danger"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }  ?>
					                                                <td>
					                                                	<div class="d-flex flex-row">
					                                                		<button data-id="<?php echo $rows['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
					                                                	</div>
					                                                </td>
					                                            </tr>

															<?php $counter++; } ?>

													  <?php	}
													  elseif ($row['section']=='4B') {

													  	$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND(tbl_pre_question.subjects = 'Criminalistics') AND(accounts.section='4B') AND (tbl_pre_question.pre_board_status='active') ORDER BY accounts.last_name ASC");
													  	    $counter = 1;
															while ($rows = mysqli_fetch_assoc($result)) { ?>
																<tr>
																	<td><?php echo $counter ;?></td>
					                                                <td><?php echo $rows['last_name']." ".$rows['first_name']." ".$rows['middle_name']?></td>
					                                                <td><?php echo $rows['section'] ?></td>
					                                                <td><?php echo $rows['subjects'] ?></td>
					                                                <td><?php echo $rows['score'] ?></td>
					                                                <td><?php echo $rows['score_percent'] ?>%</td>
					                                               <?php
						                                                $remarks = $rows['result'];
						                                                if ($remarks =="passed") { ?>
						                                                <td class="text-uppercase text-success fw-bold"><h5><span class="badge bg-success"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }
						                                                elseif ($remarks =="failed") { ?>
						                                                <td class="text-uppercase text-danger fw-bold"><h5><span class="badge bg-danger"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }  ?>
					                                                <td>
					                                                	<div class="d-flex flex-row">
					                                                		<button data-id="<?php echo $rows['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
					                                                	</div>
					                                                </td>
					                                            </tr>

															<?php $counter++; } ?>

													 <?php }
													 elseif ($row['section']=='4A') {
													 	$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND(tbl_pre_question.subjects = 'Criminalistics') AND(accounts.section='4A') AND (tbl_pre_question.pre_board_status='active') ORDER BY accounts.last_name ASC");
													 	 $counter = 1;
														while ($rows = mysqli_fetch_assoc($result)) { ?>
															<tr>
																<td><?php echo $counter ;?></td>
				                                                <td><?php echo $rows['last_name']." ".$rows['first_name']." ".$rows['middle_name']?></td>
				                                                <td><?php echo $rows['section'] ?></td>
				                                                <td><?php echo $rows['subjects'] ?></td>
				                                                 <td><?php echo $rows['score'] ?></td>
				                                                <td><?php echo $rows['score_percent'] ?>%</td>
				                                               <?php
					                                                $remarks = $rows['result'];
					                                                if ($remarks =="passed") { ?>
					                                                <td class="text-uppercase text-success fw-bold"><h5><span class="badge bg-success"><?php echo $rows['result'] ?></span></h5></td>
					                                            <?php }
					                                                elseif ($remarks =="failed") { ?>
					                                                <td class="text-uppercase text-danger fw-bold"><h5><span class="badge bg-danger"><?php echo $rows['result'] ?></span></h5></td>
					                                            <?php }  ?>
				                                                <td>
				                                                	<div class="d-flex flex-row">
				                                                		<button data-id="<?php echo $rows['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
				                                                	</div>
				                                                </td>
				                                            </tr>

															<?php $counter++; } ?>
													 <?php }
													}

													?>
		                                        </tbody>
		                                    </table>
							    		</div>
							    	</div>
					    	    </div>
					    	    <div class="tab-pane fade" id="nav-crime" role="tabpanel" aria-labelledby="nav-crime">
					    		    <div class="card mt-2">
							    		<div class="card-body rounded-3 table-responsive-xl">
							    										    				<?php

												$accounts3 = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");

												while ($block3 = mysqli_fetch_assoc($accounts3)) {
													
													if ($block3['section']=='4C') {

														$record3 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts,tbl_pre_question WHERE (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.pre_exam_id = tbl_pre_question.pre_exam_id) AND (tbl_pre_question.subjects = 'Crime Detection and Investigation') AND (tbl_pre_question.pre_board_status='active') AND (tbl_pre_question.prepared_by='{$_SESSION['acc_id']}')");

														if (mysqli_num_rows($record3) == 0) {
															
															echo '<div class="dropdown mb-2 d-flex justify-content-end">
							    				
												    				<button class="btn btn-secondary dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" disabled>
												    					Download
												    				</button>
												    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

												    					<li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Results</a></li>
												    				</ul>
												    			</div>';
														}
														elseif (mysqli_num_rows($record3) > 0) {

															$recs3 = mysqli_fetch_assoc($record3);

															echo '<div class="dropdown mb-2 d-flex justify-content-end">

													    				<button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8C0000;">
													    					Download
													    				</button>
													    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

													    					<form action="download_crime_detect.php" method="POST">
													    						<input type="hidden" name="file_type" value="xlsx">
													    						<li><button type="submit" name="export_excel_btn" class="dropdown-item"><i class="fas fa-download me-2"></i>Download Results</button></li>
													    					</form>
													    					<li><a class="dropdown-item" href="print_crime_detect.php?id='.$recs3['pre_exam_id'].'&sec='.$block3['section'].'" target="_blank"><i class="fas fa-print me-2"></i>Print Results</a></li>
													    				</ul>
													    			</div>';
														}

													}
													elseif ($block3['section']=='4B') {
														
														$record3 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts,tbl_pre_question WHERE (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.pre_exam_id = tbl_pre_question.pre_exam_id)  AND (tbl_pre_question.subjects = 'Crime Detection and Investigation') AND (tbl_pre_question.pre_board_status='active') AND (tbl_pre_question.prepared_by='{$_SESSION['acc_id']}')");

														if (mysqli_num_rows($record3) == 0) {
															
															echo '<div class="dropdown mb-2 d-flex justify-content-end">
							    				
												    				<button class="btn btn-secondary dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" disabled>
												    					Download
												    				</button>
												    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

												    					<li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Results</a></li>
												    				</ul>
												    			</div>';
														}
														elseif (mysqli_num_rows($record3) > 0) {

															$recs3 = mysqli_fetch_assoc($record3);

															echo '<div class="dropdown mb-2 d-flex justify-content-end">

													    				<button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8C0000;">
													    					Download
													    				</button>
													    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

													    					<form action="download_crime_detect.php" method="POST">
													    						<input type="hidden" name="file_type" value="xlsx">
													    						<li><button type="submit" name="export_excel_btn" class="dropdown-item"><i class="fas fa-download me-2"></i>Download Results</button></li>
													    					</form>
													    					<li><a class="dropdown-item" href="print_crime_detect.php?id='.$recs3['pre_exam_id'].'&sec='.$block3['section'].'" target="_blank"><i class="fas fa-print me-2"></i>Print Results</a></li>
													    				</ul>
													    			</div>';
														}

													}
													elseif ($block3['section']=='4A') {
														
														$record3 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts,tbl_pre_question WHERE (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.pre_exam_id = tbl_pre_question.pre_exam_id) AND (tbl_pre_question.subjects = 'Crime Detection and Investigation') AND (tbl_pre_question.pre_board_status='active') AND (tbl_pre_question.prepared_by='{$_SESSION['acc_id']}')");

														if (mysqli_num_rows($record3) == 0) {
															
															echo '<div class="dropdown mb-2 d-flex justify-content-end">
							    				
												    				<button class="btn btn-secondary dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" disabled>
												    					Download
												    				</button>
												    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

												    					<li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Results</a></li>
												    				</ul>
												    			</div>';
														}
														elseif (mysqli_num_rows($record3) > 0) {


															$recs3 = mysqli_fetch_assoc($record3);

															echo '<div class="dropdown mb-2 d-flex justify-content-end">

													    				<button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8C0000;">
													    					Download
													    				</button>
													    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

													    					<form action="download_crime_detect.php" method="POST">
													    						<input type="hidden" name="file_type" value="xlsx">
													    						<li><button type="submit" name="export_excel_btn" class="dropdown-item"><i class="fas fa-download me-2"></i>Download Results</button></li>
													    					</form>

													    					<li><a class="dropdown-item" href="print_crime_detect.php?id='.$recs3['pre_exam_id'].'&sec='.$block3['section'].'" target="_blank"><i class="fas fa-print me-2"></i>Print Results</a></li>
													    				</ul>
													    			</div>';
														}
													}
												}
							    				?>
						    				<table class="table table-hover align-middle" width="100%" id="crimeTab">
												<thead>
													<tr>
														<th scope="col">No.</th>
														<th scope="col">Name</th>
														<th scope="col">Section</th>
														<th scope="col">Area of Exam</th>
														<th scope="col">Score</th>
														<th scope="col">Percentage</th>
														<th scope="col">Remarks</th>
														<th scope="col">Action</th>
													</tr>
												</thead>
												<tbody>
													<?php 
													$accounts = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");

													while ($row = mysqli_fetch_assoc($accounts)) {
														if ($row['section']=='4C') {
															$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND(tbl_pre_question.subjects = 'Crime Detection and Investigation') AND(accounts.section='4C') AND (tbl_pre_question.pre_board_status='active') ORDER BY accounts.last_name ASC");

															$counter = 1;
															while ($rows = mysqli_fetch_assoc($result)) { ?>
																<tr>
																	<td><?php echo $counter ;?></td>
					                                                <td><?php echo $rows['last_name']." ".$rows['first_name']." ".$rows['middle_name']?></td>
					                                                <td><?php echo $rows['section'] ?></td>
					                                                <td><?php echo $rows['subjects'] ?></td>
					                                                 <td><?php echo $rows['score'] ?></td>
					                                                <td><?php echo $rows['score_percent'] ?>%</td>
					                                                <?php
						                                                $remarks = $rows['result'];
						                                                if ($remarks =="passed") { ?>
						                                                <td class="text-uppercase text-success fw-bold"><h5><span class="badge bg-success"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }
						                                                elseif ($remarks =="failed") { ?>
						                                                <td class="text-uppercase text-danger fw-bold"><h5><span class="badge bg-danger"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }  ?>
					                                                <td>
					                                                	<div class="d-flex flex-row">
					                                                		<button data-id="<?php echo $rows['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
					                                                	</div>
					                                                </td>
					                                            </tr>

															<?php $counter++; } ?>

													  <?php	}
													  elseif ($row['section']=='4B') {

													  	$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND(tbl_pre_question.subjects = 'Crime Detection and Investigation') AND(accounts.section='4B') AND (tbl_pre_question.pre_board_status='active') ORDER BY accounts.last_name ASC");
													  	    $counter = 1;
															while ($rows = mysqli_fetch_assoc($result)) { ?>
																<tr>
																	<td><?php echo $counter ;?></td>
					                                                <td><?php echo $rows['last_name']." ".$rows['first_name']." ".$rows['middle_name']?></td>
					                                                <td><?php echo $rows['section'] ?></td>
					                                                <td><?php echo $rows['subjects'] ?></td>
					                                                 <td><?php echo $rows['score'] ?></td>
					                                                <td><?php echo $rows['score_percent'] ?>%</td>
					                                               <?php
						                                                $remarks = $rows['result'];
						                                                if ($remarks =="passed") { ?>
						                                                <td class="text-uppercase text-success fw-bold"><h5><span class="badge bg-success"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }
						                                                elseif ($remarks =="failed") { ?>
						                                                <td class="text-uppercase text-danger fw-bold"><h5><span class="badge bg-danger"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }  ?>
					                                                <td>
					                                                	<div class="d-flex flex-row">
					                                                		<button data-id="<?php echo $rows['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
					                                                	</div>
					                                                </td>
					                                            </tr>

															<?php $counter++; } ?>

													 <?php }
													 elseif ($row['section']=='4A') {
													 	$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND(tbl_pre_question.subjects = 'Crime Detection and Investigation') AND(accounts.section='4A') AND (tbl_pre_question.pre_board_status='active') ORDER BY accounts.last_name ASC");
													 	 $counter = 1;
														while ($rows = mysqli_fetch_assoc($result)) { ?>
															<tr>
																<td><?php echo $counter ;?></td>
				                                                <td><?php echo $rows['last_name']." ".$rows['first_name']." ".$rows['middle_name']?></td>
				                                                <td><?php echo $rows['section'] ?></td>
				                                                <td><?php echo $rows['subjects'] ?></td>
				                                                 <td><?php echo $rows['score'] ?></td>
				                                                <td><?php echo $rows['score_percent'] ?>%</td>
				                                                <?php
					                                                $remarks = $rows['result'];
					                                                if ($remarks =="passed") { ?>
					                                                <td class="text-uppercase text-success fw-bold"><h5><span class="badge bg-success"><?php echo $rows['result'] ?></span></h5></td>
					                                            <?php }
					                                                elseif ($remarks =="failed") { ?>
					                                                <td class="text-uppercase text-danger fw-bold"><h5><span class="badge bg-danger"><?php echo $rows['result'] ?></span></h5></td>
					                                            <?php }  ?>
				                                                <td>
				                                                	<div class="d-flex flex-row">
				                                                		<button data-id="<?php echo $rows['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
				                                                	</div>
				                                                </td>
				                                            </tr>

															<?php $counter++; } ?>
													 <?php }
													}

													?>
		                                        </tbody>
		                                    </table>
							    		</div>
							    	</div>
					    	    </div>
					    	    <div class="tab-pane fade" id="nav-sociology" role="tabpanel" aria-labelledby="nav-sociology">
					    		    <div class="card mt-2">
							    		<div class="card-body rounded-3 table-responsive-xl">
							    				
							    				<?php

												$accounts2 = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");

												while ($block2 = mysqli_fetch_assoc($accounts2)) {
													
													if ($block2['section']=='4C') {

														$record2 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts,tbl_pre_question WHERE (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.pre_exam_id = tbl_pre_question.pre_exam_id) AND (tbl_pre_question.subjects = 'Criminal Sociology') AND (tbl_pre_question.pre_board_status='active') AND (tbl_pre_question.prepared_by='{$_SESSION['acc_id']}')");

														if (mysqli_num_rows($record2) == 0) {
															
															echo '<div class="dropdown mb-2 d-flex justify-content-end">
							    				
												    				<button class="btn btn-secondary dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" disabled>
												    					Download
												    				</button>
												    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">


												    					<li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Results</a></li>
												    				</ul>
												    			</div>';
														}
														elseif (mysqli_num_rows($record2) > 0) {

															$recs1 = mysqli_fetch_assoc($record2);

															echo '<div class="dropdown mb-2 d-flex justify-content-end">

													    				<button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8C0000;">
													    					Download
													    				</button>
													    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

													    					<form action="download.php" method="POST">
													    						<input type="hidden" name="file_type" value="xlsx">
													    						<li><button type="submit" name="export_excel_btn" class="dropdown-item"><i class="fas fa-download me-2"></i>Download Results</button></li>
													    					</form>
													    					<li><a class="dropdown-item" href="print_crim_juris.php?id='.$recs1['pre_exam_id'].'&sec='.$block2['section'].'" target="_blank"><i class="fas fa-print me-2"></i>Print Results</a></li>
													    				</ul>
													    			</div>';
														}

													}
													elseif ($block2['section']=='4B') {
														
														$record2 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts,tbl_pre_question WHERE (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.pre_exam_id = tbl_pre_question.pre_exam_id) AND (tbl_pre_question.subjects = 'Criminal Sociology') AND (tbl_pre_question.pre_board_status='active') AND (tbl_pre_question.prepared_by='{$_SESSION['acc_id']}')");

														if (mysqli_num_rows($record2) == 0) {
															
															echo '<div class="dropdown mb-2 d-flex justify-content-end">
							    				
												    				<button class="btn btn-secondary dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" disabled>
												    					Download
												    				</button>
												    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

												    					<li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Results</a></li>
												    				</ul>
												    			</div>';
														}
														elseif (mysqli_num_rows($record2) > 0) {

															$recs1 = mysqli_fetch_assoc($record2);

															echo '<div class="dropdown mb-2 d-flex justify-content-end">

													    				<button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8C0000;">
													    					Download
													    				</button>
													    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

													    					<form action="download.php" method="POST">
													    						<input type="hidden" name="file_type" value="xlsx">
													    						<li><button type="submit" name="export_excel_btn" class="dropdown-item"><i class="fas fa-download me-2"></i>Download Results</button></li>
													    					</form>
													    					<li><a class="dropdown-item" href="print_crim_juris.php?id='.$recs1['pre_exam_id'].'&sec='.$block2['section'].'" target="_blank"><i class="fas fa-print me-2"></i>Print Results</a></li>
													    				</ul>
													    			</div>';
														}

													}
													elseif ($block2['section']=='4A') {
														
														$record2 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts,tbl_pre_question WHERE (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.pre_exam_id = tbl_pre_question.pre_exam_id) AND (tbl_pre_question.subjects = 'Criminal Sociology') AND (tbl_pre_question.pre_board_status='active') AND (tbl_pre_question.prepared_by='{$_SESSION['acc_id']}')");

														if (mysqli_num_rows($record2) == 0) {
															
															echo '<div class="dropdown mb-2 d-flex justify-content-end">
							    				
												    				<button class="btn btn-secondary dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" disabled>
												    					Download
												    				</button>
												    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

												    					<li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Results</a></li>
												    				</ul>
												    			</div>';
														}
														elseif (mysqli_num_rows($record2) > 0) {

															$recs1 = mysqli_fetch_assoc($record2);

															echo '<div class="dropdown mb-2 d-flex justify-content-end">

													    				<button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8C0000;">
													    					Download
													    				</button>
													    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

													    					<form action="download.php" method="POST">
													    						<input type="hidden" name="file_type" value="xlsx">
													    						<li><button type="submit" name="export_excel_btn" class="dropdown-item"><i class="fas fa-download me-2"></i>Download Results</button></li>
													    					</form>
													    					<li><a class="dropdown-item" href="print_crim_juris.php?id='.$recs1['pre_exam_id'].'&sec='.$block2['section'].'" target="_blank"><i class="fas fa-print me-2"></i>Print Results</a></li>
													    				</ul>
													    			</div>';
														}
													}
												}
							    				?>
							    			
						    				<table class="table table-hover align-middle" width="100%" id="socTab">
												<thead>
													<tr>
														<th scope="col">No.</th>
														<th scope="col">Name</th>
														<th scope="col">Section</th>
														<th scope="col">Area of Exam</th>
														<th scope="col">Score</th>
														<th scope="col">Percentage</th>
														<th scope="col">Remarks</th>
														<th scope="col">Action</th>
													</tr>
												</thead>
												<tbody>
													<?php 
													$accounts = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");

													while ($row = mysqli_fetch_assoc($accounts)) {
														if ($row['section']=='4C') {
															$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND(tbl_pre_question.subjects = 'Criminal Sociology') AND (accounts.section='4C') AND(tbl_pre_question.pre_board_status='active')  ORDER BY accounts.last_name ASC");

															$counter = 1;
															while ($rows = mysqli_fetch_assoc($result)) { ?>
																<tr>
																	<td><?php echo $counter ;?></td>
					                                                <td><?php echo $rows['last_name']." ".$rows['first_name']." ".$rows['middle_name']?></td>
					                                                <td><?php echo $rows['section'] ?></td>
					                                                <td><?php echo $rows['subjects'] ?></td>
					                                                 <td><?php echo $rows['score'] ?></td>
					                                                <td><?php echo $rows['score_percent'] ?>%</td>
					                                                <?php
						                                                $remarks = $rows['result'];
						                                                if ($remarks =="passed") { ?>
						                                                <td class="text-uppercase text-success fw-bold"><h5><span class="badge bg-success"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }
						                                                elseif ($remarks =="failed") { ?>
						                                                <td class="text-uppercase text-danger fw-bold"><h5><span class="badge bg-danger"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }  ?>
					                                                <td>
					                                                	<div class="d-flex flex-row">
					                                                		<button data-id="<?php echo $rows['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
					                                                	</div>
					                                                </td>
					                                            </tr>

															<?php $counter++; } ?>

													  <?php	}
													  elseif ($row['section']=='4B') {

													  	$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND(tbl_pre_question.subjects = 'Criminal Sociology') AND(accounts.section='4B') AND (tbl_pre_question.pre_board_status='active') ORDER BY accounts.last_name ASC");
													  	    $counter = 1;
															while ($rows = mysqli_fetch_assoc($result)) { ?>
																<tr>
																	<td><?php echo $counter ;?></td>
					                                                <td><?php echo $rows['last_name']." ".$rows['first_name']." ".$rows['middle_name']?></td>
					                                                <td><?php echo $rows['section'] ?></td>
					                                                <td><?php echo $rows['subjects'] ?></td>
					                                                 <td><?php echo $rows['score'] ?></td>
					                                                <td><?php echo $rows['score_percent'] ?>%</td>
					                                                <?php
						                                                $remarks = $rows['result'];
						                                                if ($remarks =="passed") { ?>
						                                                <td class="text-uppercase text-success fw-bold"><h5><span class="badge bg-success"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }
						                                                elseif ($remarks =="failed") { ?>
						                                                <td class="text-uppercase text-danger fw-bold"><h5><span class="badge bg-danger"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }  ?>
					                                                <td>
					                                                	<div class="d-flex flex-row">
					                                                		<button data-id="<?php echo $rows['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
					                                                	</div>
					                                                </td>
					                                            </tr>

															<?php $counter++; } ?>

													 <?php }
													 elseif ($row['section']=='4A') {
													 	$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND(tbl_pre_question.subjects = 'Criminal Sociology') AND(accounts.section='4A') AND (tbl_pre_question.pre_board_status='active') ORDER BY accounts.last_name ASC");
													 	 $counter = 1;
														while ($rows = mysqli_fetch_assoc($result)) { ?>
															<tr>
																<td><?php echo $counter ;?></td>
				                                                <td><?php echo $rows['last_name']." ".$rows['first_name']." ".$rows['middle_name']?></td>
				                                                <td><?php echo $rows['section'] ?></td>
				                                                <td><?php echo $rows['subjects'] ?></td>
				                                                 <td><?php echo $rows['score'] ?></td>
				                                                <td><?php echo $rows['score_percent'] ?>%</td>
				                                                <?php
					                                                $remarks = $rows['result'];
					                                                if ($remarks =="passed") { ?>
					                                                <td class="text-uppercase text-success fw-bold"><h5><span class="badge bg-success"><?php echo $rows['result'] ?></span></h5></td>
					                                            <?php }
					                                                elseif ($remarks =="failed") { ?>
					                                                <td class="text-uppercase text-danger fw-bold"><h5><span class="badge bg-danger"><?php echo $rows['result'] ?></span></h5></td>
					                                            <?php }  ?>
				                                                <td>
				                                                	<div class="d-flex flex-row">
				                                                		<button data-id="<?php echo $rows['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
				                                                	</div>
				                                                </td>
				                                            </tr>

															<?php $counter++; } ?>
													 <?php }
													}

													?>
		                                        </tbody>
		                                    </table>
							    		</div>
							    	</div>
					    	    </div>
					    	    <div class="tab-pane fade" id="nav-correctional" role="tabpanel" aria-labelledby="nav-correctional">
					    		    <div class="card mt-2">
							    		<div class="card-body rounded-3 table-responsive-xl">
							    		<?php

												$accounts1 = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");

												while ($block1 = mysqli_fetch_assoc($accounts1)) {
													
													if ($block1['section']=='4C') {

														$record1 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts,tbl_pre_question WHERE (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.pre_exam_id = tbl_pre_question.pre_exam_id) AND (tbl_pre_question.subjects = 'Correctional Administration') AND (tbl_pre_question.pre_board_status='active') AND (tbl_pre_question.prepared_by='{$_SESSION['acc_id']}')");

														if (mysqli_num_rows($record1) == 0) {
															
															echo '<div class="dropdown mb-2 d-flex justify-content-end">
							    				
												    				<button class="btn btn-secondary dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" disabled>
												    					Download
												    				</button>
												    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

												    					<li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Results</a></li>
												    				</ul>
												    			</div>';
														}
														elseif (mysqli_num_rows($record1) > 0) {

															$recs2 = mysqli_fetch_assoc($record1);

															echo '<div class="dropdown mb-2 d-flex justify-content-end">

													    				<button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8C0000;">
													    					Download
													    				</button>
													    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

													    					<form action="download_correctional.php" method="POST">
													    						<input type="hidden" name="file_type" value="xlsx">
													    						<li><button type="submit" name="export_excel_btn" class="dropdown-item"><i class="fas fa-download me-2"></i>Download Results</button></li>
													    					</form>
													    					<li><a class="dropdown-item" href="print_facul_res.php?id='.$recs2['pre_exam_id'].'&sec='.$block1['section'].'" target="_blank"><i class="fas fa-print me-2"></i>Print Results</a></li>
													    				</ul>
													    			</div>';
														}

													}
													elseif ($block1['section']=='4B') {
														
														$record1 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts,tbl_pre_question WHERE (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.pre_exam_id = tbl_pre_question.pre_exam_id) AND (tbl_pre_question.subjects = 'Correctional Administration') AND (tbl_pre_question.pre_board_status='active') AND (tbl_pre_question.prepared_by='{$_SESSION['acc_id']}')");

														if (mysqli_num_rows($record1) == 0) {
															
															echo '<div class="dropdown mb-2 d-flex justify-content-end">
							    				
												    				<button class="btn btn-secondary dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" disabled>
												    					Download
												    				</button>
												    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

												    					<li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Results</a></li>
												    				</ul>
												    			</div>';
														}
														elseif (mysqli_num_rows($record1) > 0) {

															$recs2 = mysqli_fetch_assoc($record1);

															echo '<div class="dropdown mb-2 d-flex justify-content-end">

													    				<button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8C0000;">
													    					Download
													    				</button>
													    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

													    					<form action="download_correctional.php" method="POST">
													    						<input type="hidden" name="file_type" value="xlsx">
													    						<li><button type="submit" name="export_excel_btn" class="dropdown-item"><i class="fas fa-download me-2"></i>Download Results</button></li>
													    					</form>
													    					<li><a class="dropdown-item" href="print_facul_res.php?id='.$recs2['pre_exam_id'].'&sec='.$block1['section'].'" target="_blank"><i class="fas fa-print me-2"></i>Print Results</a></li>
													    				</ul>
													    			</div>';
														}

													}
													elseif ($block1['section']=='4A') {
														
														$record1 = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts,tbl_pre_question WHERE (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.pre_exam_id = tbl_pre_question.pre_exam_id) AND (tbl_pre_question.subjects = 'Correctional Administration') AND (tbl_pre_question.pre_board_status='active') AND (tbl_pre_question.prepared_by='{$_SESSION['acc_id']}')");

														if (mysqli_num_rows($record1) == 0) {
															
															echo '<div class="dropdown mb-2 d-flex justify-content-end">
							    				
												    				<button class="btn btn-secondary dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" disabled>
												    					Download
												    				</button>
												    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

												    					<li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Results</a></li>
												    				</ul>
												    			</div>';
														}
														elseif (mysqli_num_rows($record1) > 0) {


															$recs2 = mysqli_fetch_assoc($record1);

															echo '<div class="dropdown mb-2 d-flex justify-content-end">

													    				<button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #8C0000;">
													    					Download
													    				</button>
													    				<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

													    					<form action="download_correctional.php" method="POST">
													    						<input type="hidden" name="file_type" value="xlsx">
													    						<li><button type="submit" name="export_excel_btn" class="dropdown-item"><i class="fas fa-download me-2"></i>Download Results</button></li>
													    					</form>
													    					<li><a class="dropdown-item" href="print_facul_res.php?id='.$recs2['pre_exam_id'].'&sec='.$block1['section'].'" target="_blank"><i class="fas fa-print me-2"></i>Print Results</a></li>
													    				</ul>
													    			</div>';
														}
													}
												}
							    				?>
						    				<table class="table table-hover align-middle" width="100%" id="corrTab">
												<thead>
													<tr>
														<th scope="col">No.</th>
														<th scope="col">Name</th>
														<th scope="col">Section</th>
														<th scope="col">Area of Exam</th>
														<th scope="col">Score</th>
														<th scope="col">Percentage</th>
														<th scope="col">Remarks</th>
														<th scope="col">Action</th>
													</tr>
												</thead>
												<tbody>
													<?php 
													$accounts = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");

													while ($row = mysqli_fetch_assoc($accounts)) {
														if ($row['section']=='4C') {
															$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND(tbl_pre_question.subjects = 'Correctional Administration') AND(accounts.section='4C') AND (tbl_pre_question.pre_board_status='active') ORDER BY accounts.last_name ASC");

															$counter = 1;
															while ($rows = mysqli_fetch_assoc($result)) { ?>
																<tr>
																	<td><?php echo $counter ;?></td>
					                                                <td><?php echo $rows['last_name']." ".$rows['first_name']." ".$rows['middle_name']?></td>
					                                                <td><?php echo $rows['section'] ?></td>
					                                                <td><?php echo $rows['subjects'] ?></td>
					                                                 <td><?php echo $rows['score'] ?></td>
					                                                <td><?php echo $rows['score_percent'] ?>%</td>
					                                                <?php
						                                                $remarks = $rows['result'];
						                                                if ($remarks =="passed") { ?>
						                                                <td class="text-uppercase text-success fw-bold"><h5><span class="badge bg-success"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }
						                                                elseif ($remarks =="failed") { ?>
						                                                <td class="text-uppercase text-danger fw-bold"><h5><span class="badge bg-danger"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }  ?>
					                                                <td>
					                                                	<div class="d-flex flex-row">
					                                                		<button data-id="<?php echo $rows['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
					                                                	</div>
					                                                </td>
					                                            </tr>

															<?php $counter++; } ?>

													  <?php	}
													  elseif ($row['section']=='4B') {

													  	$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND(tbl_pre_question.subjects = 'Correctional Administration') AND(accounts.section='4B') AND (tbl_pre_question.pre_board_status='active') ORDER BY accounts.last_name ASC");
													  	    $counter = 1;
															while ($rows = mysqli_fetch_assoc($result)) { ?>
																<tr>
																	<td><?php echo $counter ;?></td>
					                                                <td><?php echo $rows['last_name']." ".$rows['first_name']." ".$rows['middle_name']?></td>
					                                                <td><?php echo $rows['section'] ?></td>
					                                                <td><?php echo $rows['subjects'] ?></td>
					                                                 <td><?php echo $rows['score'] ?></td>
					                                                <td><?php echo $rows['score_percent'] ?>%</td>
					                                                <?php
						                                                $remarks = $rows['result'];
						                                                if ($remarks =="passed") { ?>
						                                                <td class="text-uppercase text-success fw-bold"><h5><span class="badge bg-success"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }
						                                                elseif ($remarks =="failed") { ?>
						                                                <td class="text-uppercase text-danger fw-bold"><h5><span class="badge bg-danger"><?php echo $rows['result'] ?></span></h5></td>
						                                            <?php }  ?>
					                                                <td>
					                                                	<div class="d-flex flex-row">
					                                                		<button data-id="<?php echo $rows['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
					                                                	</div>
					                                                </td>
					                                            </tr>

															<?php $counter++; } ?>

													 <?php }
													 elseif ($row['section']=='4A') {
													 	$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND(tbl_pre_question.subjects = 'Correctional Administration') AND(accounts.section='4A') AND (tbl_pre_question.pre_board_status='active') ORDER BY accounts.last_name ASC");
													 	 $counter = 1;
														while ($rows = mysqli_fetch_assoc($result)) { ?>
															<tr>
																<td><?php echo $counter ;?></td>
				                                                <td><?php echo $rows['last_name']." ".$rows['first_name']." ".$rows['middle_name']?></td>
				                                                <td><?php echo $rows['section'] ?></td>
				                                                <td><?php echo $rows['subjects'] ?></td>
				                                                 <td><?php echo $rows['score'] ?></td>
				                                                <td><?php echo $rows['score_percent'] ?>%</td>
				                                                <?php
					                                                $remarks = $rows['result'];
					                                                if ($remarks =="passed") { ?>
					                                                <td class="text-uppercase text-success fw-bold"><h5><span class="badge bg-success"><?php echo $rows['result'] ?></span></h5></td>
					                                            <?php }
					                                                elseif ($remarks =="failed") { ?>
					                                                <td class="text-uppercase text-danger fw-bold"><h5><span class="badge bg-danger"><?php echo $rows['result'] ?></span></h5></td>
					                                            <?php }  ?>
				                                                <td>
				                                                	<div class="d-flex flex-row">
				                                                		<button data-id="<?php echo $rows['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
				                                                	</div>
				                                                </td>
				                                            </tr>

															<?php $counter++; } ?>
													 <?php }
													}

													?>
		                                        </tbody>
		                                    </table>
							    		</div>
							    	</div>
					    	    </div>
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
	     <!--View Result Modal -->
		<div class="modal fade" id="viewToggle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title fw-bold">View Result</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="mugs">
						
					</div>					           
					<div class="modal-footer border-0">
						<button type="button" class="btn btn-danger pb-2 px-4" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>


</body>
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
<script src="../js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../js/dt-1.10.25datatables.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
  	 $('#resultTab').DataTable({
  	 	paging: true
  	 });
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
  	 $('#lawTab').DataTable({
  	 	paging: true
  	 });
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
  	 $('#criminalTab').DataTable({
  	 	paging: true
  	 });
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
  	 $('#crimeTab').DataTable({
  	 	paging: true
  	 });
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
  	 $('#socTab').DataTable({
  	 	paging: true
  	 });
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
  	 $('#corrTab').DataTable({
  	 	paging: true
  	 });
  });
</script>
<script type="text/javascript">

   $(document).ready(function(){
    $('.view_btn').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: '../php/view_exam_results.php',
        type: 'post',
        data: {userid: userid},
        success: function(response){
          $('.mugs').html(response);
          $('#viewToggle').modal('show');
        }
      });
    });
   });
 </script>
</html>