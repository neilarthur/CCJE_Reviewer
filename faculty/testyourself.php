

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



$lay_run = "SELECT DISTINCT level_difficulty, question_id FROM test_question order by question_id asc";

$results = mysqli_query($sqlcon, $lay_run);

$suppd = "<select class='form-control mb-3' name='level_difficulty'>
        <option>Select Category</option>";
  while ($crow = mysqli_fetch_assoc($results)) {
    $suppd .= "<option value='".$crow['question_id']."'>".$crow['level_difficulty']."</option>";
  }

$suppd .= "</select>";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Test Yourself</title>
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
    <!-- Time duration -->
    <link rel="stylesheet" href="../css/jquery.durationpicker.css">
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
					<span class="link_name">Pre-Board Examnination</span>
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
					<li><a class="link_name" href="log-history.php">Logs History</a></li>
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
									<li class="breadcrumb-item active" aria-current="page">Manage Test</li>
								</ol>
							</nav>
						</div>
					</nav>
				</div>
				<form class="d-flex">
					<div class="dropdown dp mt-3">
		                <a class="text-reset dropdown-toggle text-decoration-none" href="#"id="navbarDropdownMenuLink" role="button"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell fa-lg "></i>
		                     <?php $come = mysqli_query($sqlcon,"SELECT * FROM tbl_response  WHERE response_stat='0' ORDER BY response_id DESC");
		                	?>
		                    <span class=" top-0 start-100 translate-middle badge rounded-pill badge-notification bg-danger"><?php echo mysqli_num_rows($come); ?></span>
		                </a>
		                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="border-radius: 10px;">
	                        <h6 class="dropdown-header text-dark ">Notifications</h6>
	                        <a class="dropdown-item d-flex align-items-center" href="#">
	                        	<?php

	                            $come = mysqli_query($sqlcon,"SELECT * FROM tbl_response,choose_question,accounts WHERE (tbl_response.test_id = choose_question.test_id) AND (choose_question.prepared_by ='{$_SESSION['acc_id']}') AND (tbl_response.acc = accounts.acc_id) ORDER BY response_id DESC");

	                            if (mysqli_num_rows($come)==0) {
	                            	
	                            	echo "<h5 class='text-center'>No notification Found</h5>";
	                            }

	                            if (mysqli_num_rows($come) >= 0) {

	                            	foreach ($come as $item) {

	                            ?>
	                            <div class="me-4">
	                                 <div class="fa-stack fa-1x">
	                                  <i class="fa fa-circle fa-stack-2x ms-2"></i>
	                                  <i class="fas fa-user fa-stack-1x ms-2 text-white" ></i>
	                                </div> 
	                            </div>
	                            <div class="fw-bold">
	                                <div class="small text-gray-500"><?php  $life = date('M d, Y h:i:s a',strtotime($item['created']));
	                                 echo $life; ?></div>
	                                <span class="font-weight-bold"><?php echo $item['first_name']." ".$item['last_name']." Message to you "; ?></span>
	                            </div>
	                            <?php
			                        }
			                    }
	                            ?>
	                        </a>
	                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Notifications</a>
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
								<h2 class="text-dark text-start ps-3 fw-bold mt-4 ms-2">Test Management</h2>
							</div>
						</div>
						<div class="row">
							<div class="col ">
								<div class="card">
									<div class="card-body rounded-3 table-responsive-xl">
										<div class="d-flex justify-content-end mb-3">
											<button type="button" class="btn px-3 pb-2 text-white" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: #8C0000;"><i class="fas fa-plus me-1"></i>ADD</button>
										</div>
										<table class="table table-hover align-items-middle bg-light m-2" width="100%" id="examTab">
												<thead>
												<tr>
													<th hidden=""></th>
													<th scope="col">Title</th>
													<th scope="col">Area of Examination</th>
													<th scope="col">Class Section</th>
													<th scope="col">Total Questions</th>
													<th scope="col">Time Limit</th>
													<th scope="col" style="padding-left: 30px;">Status</th>
													<th scope="col" style="text-align: center;">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php

												$xam = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");

												while ($lows = mysqli_fetch_assoc($xam)) {
													

													if ($lows['section']=='4A') {
														
														$exams = mysqli_query($sqlcon,"SELECT * FROM accounts,choose_question WHERE (accounts.acc_id = choose_question.prepared_by) AND(accounts.section='4A') AND (choose_question.status='active')");

														while ($rows = mysqli_fetch_assoc($exams)) {

															$sec = $rows['time_limit'];

															$mins = $sec / 60 ; ?>

															<tr>
																<td hidden=""><?php echo $rows['test_id']; ?></td>
																<td><?php echo $rows['quiz_title'];?></td>
																<td scope="row"><?php echo $rows['subject_name'];?></td>
																<td class="ps-5"><?php echo $rows['section']; ?></td>
																<td class="ps-5"><?php echo $rows['total_quest']?></td>
																<td><?php echo $mins; ?> mins</td>

																
																<?php 


													            #Status 
													            if ($rows['stat_question']=='No question') {
													            	echo '<td><span class="badge bg-danger p-2" style="font-size: 15px;">No Question</span></td>';
													            }
													            elseif ($rows['stat_question']=='Ready') {
													            	echo '<td class="ps-4"><span class="badge bg-success p-2" style="font-size: 15px;">Ready</span></td>';
													            }

													            ?>
																<td>
																	<div class="d-flex flex-row justify-content-center">

																		<a href="view_question.php?id=<?php echo $rows['test_id']?>" class="btn btn-primary mx-2" ><i class="fas fa-search-plus"></i></a>

																		<a href="../php/editing-quiz.php?id=<?php echo $rows['test_id']?>&total=<?php echo $rows['total_quest']; ?>" class="btn btn-warning mx-2" ><i class="fas fa-pen"></i></a>

																		<button class="btn btn-secondary mx-2 deletebtn" data-bs-toggle="modal" type="button"><i class="fas fa-trash"></i></button>
																	</div>
																</td>
															</tr>
															<?php
														}
													}elseif ($lows['section']=='4B') {

														$exams = mysqli_query($sqlcon,"SELECT * FROM accounts,choose_question WHERE (accounts.acc_id = choose_question.prepared_by) AND (accounts.section='4B') AND (choose_question.status='active')");

														while ($rows = mysqli_fetch_assoc($exams)) {

															$sec = $rows['time_limit'];

															$mins = $sec / 60 ; ?>

															<tr>
																<td hidden=""><?php echo $rows['test_id']; ?></td>
																<td><?php echo $rows['quiz_title'];?></td>
																<td scope="row"><?php echo $rows['subject_name'];?></td>
																<td class="ps-5"><?php echo $rows['section']; ?></td>
																<td class="ps-5"><?php echo $rows['total_quest']?></td>
																<td><?php echo $mins; ?> mins</td>


																<?php 


													            #Status 
													            if ($rows['stat_question']=='No question') {
													            	echo '<td><span class="badge bg-danger p-2" style="font-size: 15px;">No Question</span></td>';
													            }
													            elseif ($rows['stat_question']=='Ready') {
													            	echo '<td class="ps-4"><span class="badge bg-success p-2" style="font-size: 15px;">Ready</span></td>';
													            }

													            ?>
																<td>
																	<div class="d-flex flex-row justify-content-center">

																		<a href="view_question.php?id=<?php echo $rows['test_id']?>" class="btn btn-primary mx-2" ><i class="fas fa-search-plus"></i></a>

																		<a href="../php/editing-quiz.php?id=<?php echo $rows['test_id']?>" class="btn btn-warning mx-2" ><i class="fas fa-pen"></i></a>

																		<button class="btn btn-secondary mx-2 deletebtn" data-bs-toggle="modal" type="button"><i class="fas fa-trash"></i></button>
																	</div>
																</td>
															</tr>
															<?php
														}
													}elseif ($lows['section']=='4C') {

														$exams = mysqli_query($sqlcon,"SELECT * FROM accounts,choose_question WHERE (accounts.acc_id = choose_question.prepared_by) AND (accounts.section='4C') AND (choose_question.status='active')");

														while ($rows = mysqli_fetch_assoc($exams)) {


															$sec = $rows['time_limit'];

															$mins = $sec / 60 ; ?>


															<tr>
																<td hidden=""><?php echo $rows['test_id']; ?></td>
																<td><?php echo $rows['quiz_title'];?></td>
																<td scope="row"><?php echo $rows['subject_name'];?></td>
																<td class="ps-5"><?php echo $rows['section']; ?></td>
																<td class="ps-5"><?php echo $rows['total_quest']?></td>
																<td><?php echo $mins; ?> mins</td>

																<?php 


													            #Status 
													            if ($rows['stat_question']=='No question') {
													            	echo '<td><span class="badge bg-danger p-2" style="font-size: 15px;">No Question</span></td>';
													            }
													            elseif ($rows['stat_question']=='Ready') {
													            	echo '<td class="ps-4"><span class="badge bg-success p-2" style="font-size: 15px;">Ready</span></td>';
													            }

													            ?>
																<td>
																	<div class="d-flex flex-row justify-content-center">
																		<a href="../php/preview.php?id=<?php echo $rows['test_id']?>" class="btn btn-primary mx-2" ><i class="fas fa-search-plus"></i></a>
																		
																		<a href="../php/editing-quiz.php?id=<?php echo $rows['test_id']?>&total=<?php echo $rows['total_quest']; ?>" class="btn btn-warning mx-2" ><i class="fas fa-pen"></i></a>

																		<button class="btn btn-secondary mx-2 deletebtn" data-bs-toggle="modal" type="button"><i class="fas fa-trash"></i></button>
																	</div>
																</td>
															</tr>
														<?php
														}
													}
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
		</section>
		<!-- Archive Account -->
		<div class="modal fade" id="ArchiveAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
			<div class="modal-dialog">
	    		<div class="modal-content">
	    			<div class="modal-header flex-column border-0">
	    				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        				<div class="icon-box mt-3">
        					<i class="far fa-times-circle fa-5x text-danger"></i>
        				</div>
        				<h4 class="modal-title text-align-center mt-3 fw-bold">Are you sure?</h4>
	    			</div>
	    			<form class="form" action="../php/del_test.php" method="POST">
	    				<div class="modal-body">
	    					<div class="container d-flex justify-content-center">
	    						<input type="hidden" name="update_id" id="delete_id">
	    						<p>Do you really want to delete these record</p>
	    					</div>
	    					<div class="modal-footer d-flex justify-content-center border-0">
	        					<input type="submit" name="save" class="btn btn-success px-5 pb-2 text-white rounded-pill" value="YES">
	        					<button type="button" class="btn btn-danger  px-5 pb-2 text-white rounded-pill" data-bs-dismiss="modal">NO</button>
							</div>
	    				</div>
	    			</form>
	    		</div>
	    	</div>
	    </div>
	     <!--ADD Modal -->
	    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    	<div class="modal-dialog modal-xl">
	    		<form action="../php/test_yourself.php" id="form1" method="POST" >
			    <div class="modal-content">
			      <div class="modal-header border-0">
			        <h4 class="modal-title fw-bold text-uppercase" id="exampleModalLabel">Test Information</h4>
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			      </div>
			      <div class="modal-body">

			      	<div class="row">
			      		<div class="col-lg-6">
			      			<div class="card h-100">
			      				<div class="card-body">
			      					<label  class="form-label fw-bold">Title</label>
			      					<input type="text" class="form-control mb-3" name="title" placeholder="Untitled form" required>
			      					<label  class="form-label fw-bold">Description</label>
			      					<textarea type="text" class="form-control " name="description" placeholder="Answer the following" rows="7" required></textarea>
			      				</div>
			      			</div>
			      		</div>
			      		<div class="col-lg-6">
			      			<div class="card">
			      				<div class="card-body">
			      					<div class="input-group">
			      						<span class="input-group-text  border-0 bg-white fw-bold">Section</span>
										<select class="form-select " name="class_section" required>
											<option selected value="4A">4A</option>
											<option value="4B">4B</option>
											<option value="4C">4C</option>
										</select>
									</div>
									<div class="input-group mt-2">
										<span class="input-group-text border-0 bg-white fw-bold">Type of Test</span>
										<select class="form-select" name="type_exam" required>
											<option selected alue="Quiz">Quiz</option>
											<option value="LongQuiz">Long Quiz</option>
										</select>
									</div>
									<div class="input-group mt-2">
										<span class="input-group-text border-0 bg-white fw-bold">Area of Exam</span>
										<select class="form-select" name="subjects" id="subjects" required>
											<option selected value="">Select Category</option>
											<option value="Criminal Jurisprudence">Criminal Jurisprudence</option>
											<option value="Law Enforcement">Law Enforcement</option>
											<option value="Criminalistics">Criminalistics</option>
											<option value="Crime Detection and Investigation">Crime Detection and Investigation</option>
											<option value="Criminal Sociology">Criminal Sociology</option>
											<option value="Correctional Administration">Correctional Administration</option>
										</select>
									</div>
									<div class="input-group mt-2">
										<span class="input-group-text border-0 bg-white fw-bold">Level of difficulty</span>
										<select class="form-select custom-select difficult" name="difficult" id="difficult" required>
											<option selected value="">Select Difficulty</option>
											<option value="Easy">Easy</option>
											<option  value="Moderate">Moderate</option>
											<option value="Hard">Hard</option>
										</select>
										<input type="hidden" name="hidden_exam" id="hidden_exam" />
									</div>
									<div class="input-group mt-2">
										<span class="input-group-text border-0 bg-white fw-bold">Total of questions</span>
										<select class="form-control" name="t_question" id="total_questions" required>
											<?php
              								for($i = 5; $i <= 50; $i+=5){

              									echo ' <option>'.$i.'</option>';
              								}
              								?>

										</select>
									</div>
									<div class="mt-2">
										<div class="input-group ">
											<span class="input-group-text border-0 bg-white fw-bold me-3">Time limit</span>
											<label id="btn-example4"  type="text" hidden  style="font-size: 13px;"></label>
											<input name="time_limit" class="form-control" required/>
					                    </div>
			      					</div>
			      					<input type="hidden" name="prepared_by" value="<?php echo $_SESSION['acc_id'] ?>">
			      					<div class="input-group mt-2">
			      						<span class="input-group-text border-0 bg-white fw-bold">Open the quiz</span>
			      					    <input type="datetime-local" name="start_time" class="form-control" required=>
			      					</div>
			      					<div class="input-group mt-2">
			      						<input type="hidden" name="history_acc" value="<?php echo $_SESSION['acc_id']; ?>">
			      						<span class="input-group-text border-0 bg-white fw-bold">Close the quiz</span>
			      					    <input type="datetime-local" name="close_time" class="form-control" required= >
			      					</div>
			      				</div>
			      			</div>
			      		</div>
			      	</div>
			      </div>
			      <div class="modal-footer d-flex justify-content-center border-0 mt-3 mb-2">
			      	<button type="submit" name="create" onclick="getInputValue();"  class="btn btn-success" ><i class="fas fa-save me-2"></i>Save and Display</button>
			        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>Cancel</button>
			      </div>
			    </div>
			</form>
		    </div>
		</div>
	     <!-- Edit question -->
	     <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        	<div class="modal-dialog modal-lg">
        		<div class="modal-content">
	    			<div class="modal-header">
	    				<h5 class="modal-title fw-bold fs-3" id="exampleModalLabel">Edit Information</h5>
	    				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	    			</div>

	    			<div class="logs">
	    				
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
 <!-- Edit modal --->
 <script type="text/javascript">

   $(document).ready(function(){
    $('.editbtn').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: '../php/edit_test_yourself.php?acc=<?php echo $_SESSION['acc_id']; ?>',
        type: 'post',
        data: {userid: userid},
        success: function(response){
          $('.logs').html(response);
          $('#edit').modal('show');
        }
      });
    });
   });
 </script>
 <script>
$(document).ready(function() {

	function getInputValue() {  // A method is used to get input value
     let value = document.getElementById("btn-example4").value;
     alert(value);     // Display the value
   }
   
    $('input[name=time_limit]').durationpicker({showDays: false})
    .on("change", function(){
        $('#btn-example4').text( $(this).val() +"(secs)");
    });

});
</script>
<script src="../js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../js/jquery.durationpicker.js"></script>
<script type="text/javascript" src="../js/dt-1.10.25datatables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  	 $('#examTab').DataTable({
  	 	paging: true
  	 });
  });
</script>
<?php 
#Add Test
if (isset($_GET['testsuccess'])) {
	echo ' <script> swal("Quiz has been Saved!", " clicked the okay!", "success");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/faculty/testyourself.php");
	</script>';
}
elseif (isset($_GET['testerror'])) {
	echo ' <script> swal("Quiz has been not saved!", " clicked the okay!", "error");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/faculty/testyourself.php");
	</script>';
}
?>
</html>