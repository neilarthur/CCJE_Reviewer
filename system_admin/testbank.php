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




$lob_run = "SELECT first_name,acc_id FROM accounts WHERE role ='systemadmin' order by acc_id asc";

$results = mysqli_query($sqlcon, $lob_run);

$supps = "<select class='form-control mb-3' name='acc'>
        <option>Select Category</option>";
  while ($crow = mysqli_fetch_assoc($results)) {
    $supps .= "<option value='".$crow['acc_id']."'>".$crow['first_name']."</option>";
  }

$supps .= "</select>";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Test Bank</title>
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
                <div class="icon-link">
                    <a href="#">
                        <i class="fas fa-archive"></i>
                        <span class="link_name">Archived</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow drop' ></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Archived</a></li>
                    <li><a href="#">Quiz & Longquiz</a></li>
                    <li><a href="#">Preboard exam</a></li>
                    <li><a href="#">User Accounts</a></li>
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
									<li class="breadcrumb-item"><a href="dashboard.php" style="text-decoration: none;">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Question Bank</li>
								</ol>
							</nav>
						</div>
					</nav>
				</div>
				<form class="d-flex">
					<div class="dropdown dp mt-3">
	                    <a class="text-reset dropdown-toggle text-decoration-none" href="#"id="navbarDropdownMenuLink" role="button"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell fa-lg"></i>
	                            <?php 

	                            $comers = mysqli_query($sqlcon,"SELECT * FROM tbl_notification  WHERE notif_status='0' ORDER BY notif_id DESC");
	                            ?>
	                            <span class=" top-0 start-100 translate-middle badge rounded-pill badge-notification bg-danger"><?php echo mysqli_num_rows($comers); ?></span>
	                    </a>
	                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="border-radius: 10px;">
	                        <h6 class="dropdown-header text-dark ">Notifications</h6>
	                            <?php

	                                $comers = mysqli_query($sqlcon,"SELECT * FROM tbl_notification,accounts WHERE (tbl_notification.acc_id = accounts.acc_id) AND (accounts.role='faculty')");

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
			<div class="col py-3 overflow-auto ms-3 me-3">
				<div class="container-fluid">
					<div class="row">
						<div class="col d-flex justify-content">
							<div class="w-50">
								<h2 class="text-dark text-start ps-3 fw-bold mt-4 ms-2">Test Questionaire</h2>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="card">
									<div class="card-body rounded-3 table-responsive-xl">
										<div class="d-flex justify-content-between mb-3">
											<div class="col-lg-5">
												<div class="input-group mt-2">
													<span class="input-group-text custom-select mb-3 bg-white">Sort By</span>
													<select class="form-select custom-select mb-3" name="subjects" id="subjects" required>
														<option selected value="">Select Category</option>
														<option value="Criminal Jurisprudence">Criminal Jurisprudence</option>
														<option value="Law Enforcement">Law Enforcement</option>
														<option value="Criminalistics">Criminalistics</option>
														<option value="Crime Detection and Investigation">Crime Detection and Investigation</option>
														<option value="Criminal Sociology">Criminal Sociology</option>
														<option value="Correctional Administration">Correctional Administration</option>
													</select>
													<span class="input-group-text custom-select mb-3 bg-white">In</span>
													<div class="col-lg-4">
														<select class="form-select custom-select mb-3  difficult" name="difficult" id="difficult">
															<option selected value="">Select Difficulty</option>
															<option value="Easy">Easy</option>
															<option  value="Moderate">Moderate</option>
															<option value="Hard">Hard</option>
														</select>
													</div>
												</div>
											</div>
											<div class="fw-bold">
												<?php
									                if(isset($_SESSION['message']))
									                {
									                    echo "<h4>".$_SESSION['message']."</h4>";
									                    unset($_SESSION['message']);
									                }
									             ?>
												<button type="submit"  data-bs-toggle="modal" data-bs-target="#import" class="btn px-3 mx-2 pb-2 text-white btn-primary"><b><i class="fas fa-file-import me-2"></i></b>Import</button>
												<a href="question-form.php" class="btn px-3 pb-2 text-white mx-2" style="background-color: #8C0000;"><i class="fas fa-plus me-1"></i>ADD</a>
										   </div>
										</div>
										
										<table class="table table-hover align-middle bg-light" width="100%" id="questTab">
											<thead>
												<tr>
													<th hidden=""></th>
													<th scope="col">Area of Exam</th>
													<th scope="col">Level of Difficulty</th>
													<th scope="col">Question</th>
													<th scope="col" style="text-align: center;">Action</th>
												</tr>
											</thead>
											<tbody>

												<?php

												$xams = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}' AND role = 'systemadmin'");

												while ($lows = mysqli_fetch_assoc($xams)) {
													
													if ($lows['section'] =='4A') {
														
														$exam_run = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND (test_question.status='active') AND (accounts.section='4A') ORDER BY RAND()");

														while ($rows = mysqli_fetch_assoc($exam_run)) { ?>

															<tr>
																<td hidden=""><?php echo $rows['question_id']; ?></td>
																<td scope="row"><?php echo $rows['subject_name'];  ?></td>
																<td><?php echo $rows['level_difficulty'];  ?></td>
																<td><?php echo $rows['questions_title'];  ?></td>
																<td>
																	<div class="d-flex flex-row justify-content-center">
																		<button data-id='<?php echo $rows['question_id'];  ?>' class="btn btn-primary  mx-2 viewbtn" data-bs-toggle="modal" type="button"><i class="fas fa-eye"></i></button>
																		<button data-id='<?php echo $rows['question_id'];  ?>' class="btn btn-warning  mx-2 editbtn" data-bs-toggle="modal" type="button"><i class="fas fa-edit"></i></button>
																		<button data-id='<?php echo $rows['question_id'] ?>' class="btn btn-secondary mx-2 deletebtn" data-bs-toggle="modal" type="button"><i class="fas fa-trash"></i></button>
																	</div>
																</td>
															</tr>
															<?php
														}
													}elseif ($lows['section'] =='4B') {

														$exam_run = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND (test_question.status='active') AND (accounts.section='4B') ORDER BY RAND()");

														while ($rows = mysqli_fetch_assoc($exam_run)) { ?>
															<tr>
																<td hidden=""><?php echo $rows['question_id']; ?></td>
																<td scope="row"><?php echo $rows['subject_name'];  ?></td>
																<td><?php echo $rows['level_difficulty'];  ?></td>
																<td><?php echo $rows['questions_title'];  ?></td>
																<td>
																	<div class="d-flex flex-row justify-content-center">
																		<button data-id='<?php echo $rows['question_id'];  ?>' class="btn btn-primary  mx-2 viewbtn" data-bs-toggle="modal" type="button"><i class="fas fa-eye"></i></button>
																		<button data-id='<?php echo $rows['question_id'];  ?>' class="btn btn-warning  mx-2 editbtn" data-bs-toggle="modal" type="button"><i class="fas fa-edit"></i></button>
																		<button data-id='<?php echo $rows['question_id'] ?>' class="btn btn-secondary mx-2 deletebtn" data-bs-toggle="modal" type="button"><i class="fas fa-trash"></i></button>
																	</div>
																</td>
															</tr>
														 <?php
														}
													}elseif ($lows['section'] =='4C') {
														
														$exam_run = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND (test_question.status='active') AND (accounts.section='4C') ORDER BY RAND()");

														while ($rows = mysqli_fetch_assoc($exam_run)) { ?>
															<tr>
																<td hidden=""><?php echo $rows['question_id']; ?></td>
																<td scope="row"><?php echo $rows['subject_name'];  ?></td>
																<td><?php echo $rows['level_difficulty'];  ?></td>
																<td><?php echo $rows['questions_title'];  ?></td>
																<td>
																	<div class="d-flex flex-row justify-content-center">
																		<button data-id='<?php echo $rows['question_id'];  ?>' class="btn btn-primary  mx-2 viewbtn" data-bs-toggle="modal" type="button"><i class="fas fa-eye"></i></button>
																		<button data-id='<?php echo $rows['question_id'];  ?>' class="btn btn-warning  mx-2 editbtn" data-bs-toggle="modal" type="button"><i class="fas fa-edit"></i></button>
																		<button data-id='<?php echo $rows['question_id'] ?>' class="btn btn-secondary mx-2 deletebtn" data-bs-toggle="modal" type="button"><i class="fas fa-trash"></i></button>
																	</div>
																</td>
															</tr>
														<?php
													}
												  }elseif ($lows['section'] =='none') {
														
														$exam_run = mysqli_query($sqlcon,"SELECT * FROM  accounts, test_question WHERE (accounts.acc_id =test_question.acc_id) AND (test_question.status='active') AND (accounts.section='none') ORDER BY RAND()");

														while ($rows = mysqli_fetch_assoc($exam_run)) { ?>
															<tr>
																<td hidden=""><?php echo $rows['question_id']; ?></td>
																<td scope="row"><?php echo $rows['subject_name'];  ?></td>
																<td><?php echo $rows['level_difficulty'];  ?></td>
																<td><?php echo $rows['questions_title'];  ?></td>
																<td>
																	<div class="d-flex flex-row justify-content-center">
																		<button data-id='<?php echo $rows['question_id'];  ?>' class="btn btn-primary  mx-2 viewbtn" data-bs-toggle="modal" type="button"><i class="fas fa-eye"></i></button>
																		<button data-id='<?php echo $rows['question_id'];  ?>' class="btn btn-warning  mx-2 editbtn" data-bs-toggle="modal" type="button"><i class="fas fa-edit"></i></button>
																		<button data-id='<?php echo $rows['question_id'] ?>' class="btn btn-secondary mx-2 deletebtn" data-bs-toggle="modal" type="button"><i class="fas fa-trash"></i></button>
																	</div>
																</td>
															</tr>
														<?php
													}
												  }
												}
												?>

										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		
	    
	    <!-- View Question-->
		<div class="modal fade" id="ViewQuestion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title fw-bold">View Question</h3>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="view"></div>
					</div>
	            </div>
	        </div>
	    </div>

	    <!-- Edit info -->
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

       	<!-- Archived info-->
        <div class="modal fade" id="ArchiveAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        	<div class="modal-dialog modal-confirm">
        		<div class="modal-content">
        			<div class="modal-header flex-column border-0">
        				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        				<div class="icon-box mt-3">
        					<i class="far fa-times-circle fa-5x text-danger"></i>
        				</div>
        				<h4 class="modal-title text-align-center mt-3 fw-bold">Are you sure?</h4>
        				<p class="h5 modal-title text-align-center mt-2">Do want to delete these question</p>
        			</div>
        			<div class="modal-body">
        				<div class="arch">

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
	    <!-- Import Modal -->
	    <div class="modal fade" id="import" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    	<div class="modal-dialog">
	    		<div class="modal-content">
	    			<div class="modal-header border-0">
	    				<h3 class="modal-title fw-bold" id="exampleModalLabel">Import Question</h3>
	    				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	    			</div>
	    			<form action="import_excel.php" method="POST" enctype="multipart/form-data">
	    				<div class="modal-body">
	    					<input type="file" class="form-control" name="import_file">
	    					<input type="hidden" name="acc_id" value="<?php echo $_SESSION['acc_id']; ?>">
	    				</div>
	    				<div class="modal-footer border-0">
	    					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
	    					<button type="submit" name="save_excel_data" id="import" class="btn px-3 pb-2 text-white btn-success">Submit</button>
	    				</div>
	    			</form>
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

 <!-- Edit modal --->
 <script type="text/javascript">

   $(document).ready(function(){
    $('.editbtn').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: '../php/edit_questions.php?acc=<?php echo $_SESSION["acc_id"] ?>',
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
 <!-- View modal --->
 <script type="text/javascript">

   $(document).ready(function(){
    $('.viewbtn').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: '../php/view_question.php?acc_id=<?php echo $_SESSION["acc_id"] ?>',
        type: 'post',
        data: {userid: userid},
        success: function(response){
          $('.view').html(response);
          $('#ViewQuestion').modal('show');
        }
      });
    });
   });
 </script>




<script type="text/javascript">
	$(document).ready(function(){
 		$('.deletebtn').click(function(){
 			var userid = $(this).data('id');

 			$.ajax({
 				url: '../php/Arch_acc.php',
        		type: 'post',
        		data: {userid: userid},
        		success: function(response){
        			$('.arch').html(response);
          			$('#ArchiveAccount').modal('show');
          		}
       		});
    	});
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
      url: "../php/question_bank.php?acc_id=<?php echo $_SESSION["acc_id"] ?>",             
      dataType: "text",   //expect html to be returned  
      data:{difficult:difficult,subjects:subjects},               
      success: function(data){     
      $("#questTab").hide();    
      $("#questTab").fadeIn();             
      $("#questTab").html(data); 
        // alert(data);

      }

      });


  });

</script>

<script src="../js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../js/dt-1.10.25datatables.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
  	 $('#questTab').DataTable({
  	 	paging: true
  	 });
  });
</script>


<?php 
#Add Question
if (isset($_GET['testsuccess'])) {
	echo ' <script> swal("Question has been Saved!", " clicked the okay!", "success");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/faculty/testbank.php");
	</script>';
}
elseif (isset($_GET['testerror'])) {
	echo ' <script> swal("Question has not saved!", " clicked the okay!", "error");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/faculty/testbank.php");
	</script>';
}
#update accounts
if (isset($_GET['uptestsuc'])) {
	echo ' <script> swal("Question has been Changed!", " clicked the okay!", "success");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/faculty/testbank.php");
	</script>';
}
elseif (isset($_GET['uptestsucer'])) {
	echo ' <script> swal("Question has not saved!", " clicked the okay!", "error");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/faculty/testbank.php");
	</script>';
}
#import Questions
if (isset($_GET['importsuc'])) {
	echo ' <script> swal("Import Success!", " clicked the okay!", "success");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/faculty/testbank.php");
	</script>';
}
elseif (isset($_GET['importfail'])) {
	echo ' <script> swal("Import Failed!", " clicked the okay!", "error");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/faculty/testbank.php");
	</script>';
}
elseif (isset($_GET['importinvalid'])) {
	echo ' <script> swal("Invalid File", " clicked the okay!", "error");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/faculty/testbank.php");
	</script>';
}
 
?> 
</html>