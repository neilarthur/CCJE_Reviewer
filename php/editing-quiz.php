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

$sup_run = "SELECT DISTINCT subject_name, question_id FROM test_question order by question_id asc";

$resulted = mysqli_query($sqlcon, $sup_run);

$supp = "<select class='form-control mb-3' name='subjects' id='laid'>
        <option>Select Category</option>";
  while ($crow = mysqli_fetch_assoc($resulted)) {
    $supp .= "<option value=".$crow['question_id'].">".$crow['subject_name']."</option>";
  }

$supp .= "</select>";

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
	<title>Editing Quiz</title>
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
		<ul class="nav-links fw-bolder">
			<li class="navigation-list-item">
				<a href="../faculty/dashboard.php">
					<i class="fas fa-tachometer-alt"></i>
					<span class="link_name">Dashboard</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="../faculty/dashboard.php">Dashboard</a></li>
				</ul>
			</li>
			<li class="navigation-list-item">
				<a href="../faculty/testbank.php">
					<i class="fas fa-list-ol"></i>
					<span class="link_name">Question Bank</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="../faculty/testbank.php">Question Bank</a></li>
				</ul>
			</li>
			<li>
			<li class="navigation-list-item">
				<a href="../faculty/testyourself.php">
					<i class="fas fa-sticky-note"></i>
					<span class="link_name">Manage Test</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="../faculty/testyourself.php">Manage Test</a></li>
				</ul>
			</li>
			<li class="navigation-list-item">
				<a href="../faculty/preboard.php">
					<i class="fas fa-list-alt"></i>
					<span class="link_name">Pre-Board Examination</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="../faculty/preboard.php">Pre-Board Examination</a></li>
				</ul>
			</li>
			<li class="navigation-list-item">
				<a href="../faculty/examresults.php">
					<i class="fas fa-poll"></i>
					<span class="link_name">Exam Results</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="../faculty/examresults.php">Exam Results</a></li>
				</ul>
			</li>
			<li class="navigation-list-item">
				<a href="../faculty/accounts_manage.php">
					<i class='bx bxs-user-account bx-sm' ></i>
					<span class="link_name">Accounts</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="../faculty/accounts_manage.php">Accounts</a></li>
				</ul>
			</li>
			<li class="navigation-list-item">
				<a href="../faculty/log-history.php">
					<i class="fas fa-history"></i>
					<span class="link_name">Log History</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="../faculty/log-history.php">Logs History</a></li>
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
							<div class="profile_name"><a class="profile text-warning"href="../faculty/profile.php?acc_id=<?php echo $_SESSION["acc_id"] ?>"><?php echo $_SESSION["first_name"];?></a></div>
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
									<li class="breadcrumb-item"><a href="../faculty/dashboard.php" style="text-decoration: none;">Home</a></li>
									<li class="breadcrumb-item"><a href="../faculty/testyourself.php" style="text-decoration: none;">Manage Test</a></li>
									<li class="breadcrumb-item active" aria-current="page">Editing quiz</li>
								</ol>
							</nav>
						</div>
					</nav>
				</div>
				<form class="d-flex">
					<div class="dropdown dp mt-3">
		                    <a class="text-reset dropdown-toggle text-decoration-none" href="#"id="navbarDropdownMenuLink" role="button"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell fa-lg "></i>
		                        <span class=" top-0 start-100 translate-middle badge rounded-pill badge-notification bg-danger">1</span>
		                    </a>
		                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="border-radius: 10px;">
		                          <h6 class="dropdown-header text-dark ">Notifications</h6>
		                          <a class="dropdown-item d-flex align-items-center" href="#">
		                              <div class="me-4">
		                                   <div class="fa-stack fa-1x">
		                                    <i class="fa fa-circle fa-stack-2x ms-2"></i>
		                                    <i class="fas fa-user fa-stack-1x ms-2 text-white" ></i>
		                                  </div> 
		                              </div>
		                              <div class="fw-bold">
		                                  <div class="small text-gray-500">September 16, 2022</div>
		                                  <span class="font-weight-bold">Sir pagcaliwagan added an exam</span>
		                              </div>
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
						<form action="save_quiz.php" method="POST">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body">
									<?php

									$id = $_GET['id'];

									$quiz= mysqli_query($sqlcon,"SELECT * FROM choose_question WHERE test_id = '$id'");

										 while ($level = mysqli_fetch_assoc($quiz)) { ?>

										 	<h4 class="fw-bold">Editing quiz: Area of Exam -  <?php echo $level['subject_name']; ?></h4>
									    <?php }  ?>

										<div class="d-flex justify-content-between mt-3">
											<div class="d-flex flex-row">
												<?php

													$let = $_GET['id'];

													$quiz = mysqli_query($sqlcon,"SELECT * FROM test_question,choose_question, student_choice WHERE (test_question.question_id=student_choice.question_id) AND (choose_question.test_id=student_choice.test_id) AND student_choice.test_id='$let' AND question_stat='active'");

													$choose= mysqli_query($sqlcon,"SELECT * FROM choose_question WHERE test_id = '$id'");

													while ($rows = mysqli_fetch_assoc($choose)) {

													$num = mysqli_num_rows($quiz);
													$total = $rows['total_quest'];

													if (mysqli_num_rows($quiz) ==0) {
														
														echo '<p class="ms-2">Questions:
													<span class="badge bg-danger" style="font-size: 15px;">'.$num.' out of '.$total.'</span>';
													
												}
													elseif (mysqli_num_rows($quiz) >0) {
															echo '<p class="ms-2">Questions:
													<span class="badge bg-success" style="font-size: 15px;">'.$num.' out of '.$total.'</span>';
													}
												}
													
											?> 
												<span>
													<?php

													$id = $_GET['id'];

													$quiz= mysqli_query($sqlcon,"SELECT * FROM choose_question WHERE test_id = '$id'");

													 while ($level = mysqli_fetch_assoc($quiz)) { ?>

													<p class="ms-2">|  Level of difficulty: <?php echo $level['question_difficulty']; ?></p>
												</span>
												 <?php }  ?>
											</div>
											<input type="hidden" name="update" value="<?php echo $_GET['id']; ?>">
											<input class="btn btn-success px-4 pb-2" type="submit" name="save" value="Save">
											
										</div>
										
									</div>
								</div>
							</div>
							<div class="col-lg-12 mt-2">
								<div class="card">
									<div class="card-body m-4">
										<div class="d-flex justify-content-between mb-3">
											<button data-id="<?php echo $id; ?>" class="btn btn-warning px-3 pb-2 editinfo" data-bs-toggle="modal" type="button"><i class="fas fa-edit"></i>
											</button>
											<div class="dropdown me-2">
												<a class="btn btn-outline-white border-0 bg-white text-dark fw-bold dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Add</a>
												<?php 
											    $quiz= mysqli_query($sqlcon,"SELECT * FROM choose_question WHERE test_id = '$id'");

											    $quizs = mysqli_query($sqlcon,"SELECT * FROM student_choice WHERE test_id = '$id'");

											    $num = mysqli_num_rows($quizs);
											   while ($rows = mysqli_fetch_assoc($quiz)) { 

											   	$lows = $rows['total_quest'];


											   	?>

											  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											    	<?php

											    	$tots = $_GET['total'];

											    	if ($lows ==$num) {
											    	 	
											    	 	echo "<li><a class='dropdown-item'><i class='fas fa-plus me-2'></i>a new Questions</a>
											    	 	</li>
											    	 	<div class='dropdown-divider'></div>
											    	 	<li><a class='dropdown-item' data-bs-toggle='#' data-bs-target='#'><i class='fas fa-plus me-2'></i>from Question Bank</a></li>
											    	 	<div class='dropdown-divider'></div>
											    	 	<li><a class='dropdown-item' data-bs-toggle='#' data-bs-target='#'><i class='fas fa-plus me-2'></i>a random question</a></li>
											    	 		";
											    	}
											    	else {

											    		echo "<li><a class='dropdown-item' href='adding-quiz-question.php?id=$id&total=$tots'><i class='fas fa-plus me-2'></i>a new Questions </a></li>
											    		<div class='dropdown-divider'></div>
											    		<li><a class='dropdown-item' data-bs-toggle='modal' data-bs-target='#exampleModal2'><i class='fas fa-plus me-2'></i>from Question Bank</a></li>
											    		<div class='dropdown-divider'></div>
											    	 	<li><a class='dropdown-item' data-bs-toggle='modal' data-bs-target='#addRandom'><i class='fas fa-plus me-2'></i>a random question</a></li>";
											    	}
											    	?>
											  </ul>
											    <?php }  ?>
											</div>
										</div>
										<div class="table-responsive-xl">
											<style type="text/css">
												
											</style>
											<table class="table bg-light table-hover w-100 " id="#">
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
												    
												   

													$let = $_GET['id'];

													$quiz = mysqli_query($sqlcon,"SELECT DISTINCT * FROM test_question,choose_question, student_choice WHERE (test_question.question_id=student_choice.question_id) AND (choose_question.test_id=student_choice.test_id) AND student_choice.test_id='$let' AND question_stat='active'");

													if (mysqli_num_rows($quiz) ==0) { ?>
														<tr class="table-danger">
															<td></td>
													    	<td></td>
													    	<td>No questions has been added yet</td>
													    	<td></td>
													    </tr>
													<?php 
													} 
													elseif (mysqli_num_rows($quiz)>0) {
														$counter = 1;
														while ($rows = mysqli_fetch_assoc($quiz)) {
													?>
												
												    <tr>
												    	<td hidden=""><?php echo $rows['qy_id'] ?></td>
												    	<td><?php echo $counter ;?></td>
												    	<td><?php echo $rows['subject_name'];?></td>
												    	<td><?php echo $rows['questions_title'];?></td>
												    	<td>
												    		<div class="d-flex flex-row">
													      		<button data-id="<?php echo $rows['question_id']; ?>" type="button"class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-search-plus"></i></button>
		                                                		<button type="button" class="btn btn-secondary deletebtn  mx-2" data-bs-toggle="modal" ><i class="fas fa-trash-alt"></i></button>
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
		<!-- Logout Modal -->
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
	    <div class="modal fade" id="Delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
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
	    			<form class="form" action="../php/delete_test_yourself.php" method="POST">
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

		<!--Add Question from Question bank modal-->
		<div class="modal fade " data-bs-backdrop="true"  id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl  ">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title fw-bold" id="exampleModalLabel">Add from the Question Bank</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form action="function.php" id="form1" method="POST" onsubmit="return validate_question()">
							<div class="row">
								<div class="col-lg-6">
									<div class="input-group mt-2">
										<span class="input-group-text bg-white fw-bold">Area of Exam</span>
										<select class="form-select" name="subjects" id="subjects">
											<option selected value="Criminal Jurisprudence">Criminal Jurisprudence</option>
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
										<select class="form-select custom-select difficult" name="difficult" id="difficult" >
											<option selected value="">Select Difficulty</option>
											<option value="Easy">Easy</option>
											<option  value="Moderate">Moderate</option>
											<option value="Hard">Hard</option>
										</select>

																				<?php

										$get = $_GET['total'];

										$valid = "SELECT * FROM student_choice WHERE test_id = '{$_GET['id']}'";
										$valid_run = mysqli_query($sqlcon,$valid);

										$valid_row = mysqli_num_rows($valid_run);

										$valid_total = $get - $valid_row;
										?>

										<input type="text" name="total_questions" id="total_questions" value="<?php echo $valid_total; ?>">
									</div>
								</div>
								<input type="hidden" name="prepared_by" value="<?php echo $_SESSION['acc_id'] ?>">
								
							</div>
							<div class="card mt-2">
								<div class="card-body">
									<div class="table-responsive-xl" id="flex">
										<div class="table-wrapper-scroll-y my-custom-scrollbar">
											<table class="table table-hover bg-light" style="font-size: 15px;" id="example_test">
												<thead>
													<tr>
														<th><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></th>	
														<th scope="col">Question</th>
														<th scope="col">Action</th>
													</tr>
												</thead>
												<tbody>
													<?php 

															     
												      $test = mysqli_query($sqlcon,"SELECT * FROM test_question");
												      while ($now = mysqli_fetch_assoc($test)) {
												      	 $_SESSION['exam'] = $now['question_id']; ?>

													<tr>
														<td><input type="checkbox" class="form-check-input" name="chkl[]" id="question_id<?php echo $now['question_id'];  ?>"  value="<?php echo $_SESSION['exam'] ?>" data-id="<?php echo $now['question_id']; ?>"></td>
														<td><?php echo $now['questions_title'] ?></td>

														<td><button data-id="<?php echo $now['question_id']; ?>" type="button" class="btn btn-primary popover-test prev_btn"  data-bs-toggle="modal" data-bs-dismiss="modal"><i class="fas fa-eye"></i></button></td>
														
													</tr>
													   <?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<input type="hidden" name="test" value="<?php echo $_GET['id']; ?>">
								<input type="hidden" name="total" value="<?php echo $_GET['total']; ?>">
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
						<form action="function_random.php" method="POST">
							<div class="card border-0">
								<div class="card-body m-2">
									<div class="mb-2 row">
										<label for="Area" class="col-sm-4 col-form-label fw-bold">Area of Exam</label>
										<div class="col-sm-8"> 
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
									<div class="mb-2 row">
										<label for="level" class="col-sm-4 col-form-label fw-bold">Level of difficulty</label>
										<div class="col-sm-6">
											<select class="form-select custom-select difficult"  name="diff" id="diff" >
												<option selected value="">Select Difficulty</option>
												<option value="Easy">Easy</option>
												<option  value="Moderate">Moderate</option>
												<option value="Hard">Hard</option>
											</select>
										</div>
									</div>
									<input class="form-control" type="hidden" name="prepared_by" value="<?php echo $_SESSION['acc_id'] ?>">
									<div class="row">
										<label for="number" class="col-sm-4 col-form-label fw-bold">Number of random question</label>
										<div class="col-sm-4">
											<select class="form-select" name="total_quest" id="total_quest">
												
												<?php

												$tot = $_GET['total'];

												$val = mysqli_query($sqlcon,"SELECT * FROM student_choice WHERE test_id = {$_GET['id']}");
												$val_run = mysqli_num_rows($val);

												$val_total = $tot - $val_run;

												for($i =1; $i <= $val_total; $i+=1){
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
								<div class="card-body" id="coast">
									<p class="fw-bold">Questions matching this filter: 0</p>
									<div class="table-responsive-xl">
										<div class="table-wrapper-scroll-y my-custom-scrollbar">
											<table class="table table-hover bg-light" style="font-size: 15px;" id="standing">
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
								<input type="hidden" name="test_id" value="<?php echo $_GET['id']; ?>">
								<input type="hidden" name="total" value="<?php echo $_GET['total']; ?>">
								<button type="submit" name="create" class="btn btn-success">Add random questions</button>
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- View Action Modal -->
		<div class="modal fade" id="question_bank_prev" data-bs-backdrop="true"  aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title fw-bold" id="exampleModalToggleLabel2">View question</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="loggin">
							
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" data-bs-target="#exampleModal2" data-bs-toggle="modal" data-bs-dismiss="modal">Back to Add question</button>
					</div>
				</div>
			</div>
		</div>
		
		<!--Preview Question Modal -->
		<div class="modal fade" id="viewToggle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header border-0">
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="card">
							<div class="card-body bg-white">
								<div class="card m-2">
									<div class="card-body" style="background-color: rgb(219, 235, 247);">
										<div class="mugs">
											
										</div>					
						            </div>
						        </div>
						    </div>
						</div>
					</div>
					<div class="modal-footer border-0">
						<button type="button" class="btn btn-secondary pb-2 px-4" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>


		<!-- Edit Information Modal -->
		<div class="modal fade" id="editinformation" data-bs-backdrop="true"  aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title fw-bold" id="exampleModalToggleLabel2">Test Information</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="information">
							
						</div>
					</div>
				</div>
			</div>
		</div>
</body>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/dt-1.10.25datatables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
<script src="../js/jquery.durationpicker.js"></script>
<script type="text/javascript">
 	$(document).ready(function() {
 		$('.deletebtn').on('click', function() {

 			$('#Delete').modal('show');

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
      url: "fetchhub.php",             
      dataType: "text",   //expect html to be returned  
      data:{difficult:difficult,subjects:subjects},               
      success: function(data){     
      $("#flex").hide();    
      $("#flex").fadeIn();             
      $("#flex").html(data); 
        // alert(data);

      }

      });


  });

</script>

 <!-- preview modal --->
 <script type="text/javascript">

   $(document).ready(function(){
    $('.view_btn').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: '../php/view_quiz_test.php',
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


 <!-- learnss modal -->

 <script type="text/javascript">
 	$(document).ready(function(){
 		$('.prev_btn').click(function(){
 			var userid = $(this).data('id');

 			$.ajax({
 				url: '../php/prev_quiz_bank.php',
        		type: 'post',
        		data: {userid: userid},
        		success: function(response){
          		$('.loggin').html(response);
          		$('#question_bank_prev').modal('show');
          	}
          });
    	});
   	});
</script>

<!-- Edit info modal -->
 <script type="text/javascript">
 	$(document).ready(function(){
 		$('.editinfo').click(function(){
 			var userid = $(this).data('id');

 			$.ajax({
 				url: '../php/editinformation.php',
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

<!--- random javascript -->

 <script type="text/javascript">

  // var of select input difficult

  // var of select input subject

 
  $('select').on('change', function() {
    var name = this.name;
    var diff;
    var area_exam;

       // alert(  name);



       if (name=="diff") {
          diff = this.value;
          area_exam = $("#area_exam").val();

       }else if (name=="area_exam") {
          diff =$("#diff").val();
          area_exam =  this.value;

       }else{
        return false;
       }
      

      $.ajax({    //create an ajax request to load_page.php
      type:"POST",
      url: "random_question.php",             
      dataType: "text",   //expect html to be returned  
      data:{diff:diff,area_exam:area_exam},               
      success: function(data){     
      $("#coast").hide();    
      $("#coast").fadeIn();             
      $("#coast").html(data); 
        // alert(data);

      }

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


<script type="text/javascript">
  // $(".checkbox").on("click" ,function(){
    
  // })

  $(document).ready(function(){

    var $checkboxes = $('#example_test td input[type="checkbox"]');
        
    $checkboxes.change(function(){
        var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
        var total_question = $("#total_questions").val();
        var id = $(this).data("id");
        var check_box = $("question_id"+id)
        // alert(countCheckedCheckboxes);
        // alert(total_question);
        
        if (countCheckedCheckboxes>total_question) {
           if($(this).prop("checked") == true){
              alert("Questions already rich the limit of the test." );
             $(this).prop('checked', false);
            }
        }
    
    });

});
</script>

<?php 
#sweet alert of 3 add button 
if (isset($_GET['add_new_quest'])) {
  echo ' <script> swal(" add question succesful!", " clicked the okay!", "success");
  window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/php/editing-quiz.php");
  </script>';
}
elseif (isset($_GET['add__quest_from_bank'])) {
  echo ' <script> swal(" add question succesful!", " clicked the okay!", "success");
  window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/php/editing-quiz.php");
  </script>';
}
elseif (isset($_GET['generate_random_quest'])) {
  echo ' <script> swal("Generate Random Question succesful!", " clicked the okay!", "success");
  window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/php/editing-quiz.php");
  </script>';
}

?>
</html>