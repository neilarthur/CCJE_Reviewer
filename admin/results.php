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
	<title>Results</title>
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
							<div class="job"><?php echo $_SESSION["role"];  ?></div>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<section class="home-section " >
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
									<li class="breadcrumb-item active" aria-current="page">Preboard Exam Results</li>
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
		                  echo'<span><img class="me-2 rounded-circle" src="data:image;base64,'.base64_encode($rows["image_size"]).'" height="40px;" width="40px;" ></span>';
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
			<div class="col py-3 overflow-auto ">
				<div class="container-fluid">
					<div class="row">
						<div class="col d-flex justify-content">
							<div class="w-50">
								<h2 class="text-dark text-start ps-3 fw-bold mt-4 ms-2">Preboard Examination Results</h2>
							</div>
						</div>
					</div>
						<div class="tab-content" id="nav-tabContent">
						<nav>
							<div class="nav nav-pills mt-2" id="nav-tab" role="tablist">
								<button class="nav-link active" id="nav-home-tab" data-bs-toggle="pill" data-bs-target="#nav-4A" type="button" role="tab" aria-controls="nav-4A" aria-selected="true" style="width: 33%;"><i class="fas fa-user-graduate"></i> 4A</button>
								<button class="nav-link" id="nav-profile-tab" data-bs-toggle="pill" data-bs-target="#nav-4B" type="button" role="tab" aria-controls="nav-4B" aria-selected="false" style="width: 33%;"><i class="fas fa-user-graduate"></i> 4B</button>
								<button class="nav-link" id="nav-contact-tab" data-bs-toggle="pill" data-bs-target="#nav-4C" type="button" role="tab" aria-controls="nav-4C" aria-selected="false" style="width: 34%;"><i class="fas fa-user-graduate"></i> 4C</button>
							</div>
						</nav>
						<div class="tab-pane fade show active" id="nav-4A" role="tabpanel" aria-labelledby="nav-home-tab">
							<div class="row">
								<div class="col ">
									<div class="card">
										<div class="card-body rounded-3 table-responsive-xl">
											<div class="row justify-content-between mb-2">
												<div class="col-lg-4">
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
													</div>
												</div>
											</div>
											<table class="table table-hover bg-light align-middle w-100" id="resultTab">
												<thead>
													<tr>
														<th scope="col" hidden>ID</th>
														<th scope="col">No.</th>
														<th scope="col">Student Name</th>
														<th scope="col">Year & Section</th>
														<th scope="col">Area of Exam</th>
														<th scope="col">Total Questions</th>
														<th scope="col">Time Limit</th>
														<th scope="col" class="text-center">Score</th>
														<th scope="col" class="text-center">Action</th>
													</tr>
												</thead>
												<tbody>
													<?php

													$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id)  AND(accounts.section='4A')"); 
													$counter =1;
													while ($row = mysqli_fetch_array($result)) {
														if ($row['section']=='4A') { ?>
															
															 <tr>
																	<td hidden><?php echo $row['acc_id'] ?></td>
																	<td><?php echo $counter ;?></td>
					                                                <td><?php echo $row['last_name']." ".$row['first_name']." ".$row['middle_name']?></td>
					                                                <td class="ps-5"><?php echo $row['section'] ?></td>
					                                                <td><?php echo $row['subjects'] ?></td>
					                                                <td class="ps-5"><?php echo $row['total_question'] ?></td>
					                                                <td><?php echo $row['time_limit'] /3600?> hr(s)</td>
					                                                <td style="padding-left: 55px;"><?php echo $row['score'] ?></td>
					                                                <td>
					                                                	<div class="d-flex justify-content-center me-3">
					                                                		<button data-id="<?php echo $row['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
					                                                	</div>
					                                                </td>
					                                            </tr>

															
														<?php }
													$counter++;  }
												 ?>
		                                        </tbody>
		                                    </table>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
						</div>
						<div class="tab-pane fade" id="nav-4B" role="tabpanel" aria-labelledby="nav-profile-tab">
							<div class="row">
								<div class="col ">
									<div class="card">
										<div class="card-body rounded-3  table-responsive-xl">
											<div class="row justify-content-between mb-2">
												<div class="col-lg-4">
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
													</div>
												</div>
											</div>
											<table class="table table-hover bg-light align-middle w-100" id="result2Tab">
												<thead>
													<tr>
														<th scope="col" hidden>ID</th>
														<th scope="col">No.</th>
														<th scope="col">Student Name</th>
														<th scope="col">Year & Section</th>
														<th scope="col">Area of Exam</th>
														<th scope="col">Total Questions</th>
														<th scope="col">Time Limit</th>
														<th scope="col" class="text-center">Score</th>
														<th scope="col" class="text-center">Action</th>
													</tr>
												</thead>
												<tbody>
													<?php

													$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id)  AND(accounts.section='4B')"); 

													$counter= 1;
													while ($row = mysqli_fetch_array($result)) {
														if ($row['section']=='4B') { ?>
															
															 <tr>
																	<td hidden><?php echo $row['acc_id'] ?></td>
																	<td><?php echo $counter ;?></td>
					                                                <td><?php echo $row['last_name']." ".$row['first_name']." ".$row['middle_name']?></td>
					                                                <td class="ps-5"><?php echo $row['section'] ?></td>
					                                                <td><?php echo $row['subjects'] ?></td>
					                                                <td class="ps-5"><?php echo $row['total_question'] ?></td>
					                                                <td><?php echo $row['time_limit'] /3600?> hr(s)</td>
					                                                <td style="padding-left: 55px;"><?php echo $row['score'] ?></td>
					                                                <td>
					                                                	<div class="d-flex justify-content-center me-3">
					                                                		<button data-id="<?php echo $row['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
					                                                	</div>
					                                                </td>
					                                            </tr>

															
														<?php }
													$counter++;  }
												 ?>
													
		                                        </tbody>
		                                    </table>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
						</div>
						<div class="tab-pane fade" id="nav-4C" role="tabpanel" aria-labelledby="nav-profile-tab">
							<div class="row">
								<div class="col ">
									<div class="card">
										<div class="card-body rounded-3  table-responsive-xl">
											<div class="row justify-content-between mb-2">
												<div class="col-lg-4">
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
													</div>
												</div>
											</div>
											<table class="table table-hover bg-light align-middle w-100" id="result3Tab">
												<thead>
													<tr>
														<th scope="col" hidden>ID</th>
														<th scope="col">No.</th>
														<th scope="col">Student Name</th>
														<th scope="col">Year & Section</th>
														<th scope="col">Area of Exam</th>
														<th scope="col">Total Questions</th>
														<th scope="col">Time Limit</th>
														<th scope="col" class="text-center">Score</th>
														<th scope="col" class="text-center">Action</th>
													</tr>
												</thead>
												<tbody>
													<?php

													$result = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id)  AND(accounts.section='4C')"); 
													$counter = 1;
													while ($row = mysqli_fetch_array($result)) {
														if ($row['section']=='4C') { ?>
															
															 <tr>
																	<td hidden><?php echo $row['acc_id'] ?></td>
																	<td><?php echo $counter ;?></td>
					                                                <td><?php echo $row['last_name']." ".$row['first_name']." ".$row['middle_name']?></td>
					                                                <td class="ps-5"><?php echo $row['section'] ?></td>
					                                                <td><?php echo $row['subjects'] ?></td>
					                                                <td class="ps-5"><?php echo $row['total_question'] ?></td>
					                                                <td><?php echo $row['time_limit'] /3600?> hr(s)</td>
					                                                <td style="padding-left: 55px;"><?php echo $row['score'] ?></td>
					                                                <td>
					                                                	<div class="d-flex justify-content-center me-3" >
					                                                		<button data-id="<?php echo $row['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
					                                                	</div>
					                                                </td>
					                                            </tr>

															
														<?php }
													$counter++;  }
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
		<!-- ViewModal-->
		<div class="modal fade" id="ViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-md">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title"></h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		      	<div class="card" style="border-style: none;">
		      		<div class="card-body">
						<label class="d-flex ps-1 mt-2 justify-content-start" >Name</label>
						<input type="text" name="last_name" class="form-control" value="Ralph Vincent Pagcaliwagan ">
						<label class="d-flex ps-1 mt-2 justify-content-start">Section</label>
						<input type="text" name="last_name" class="form-control" value="4C">
						<label  class="d-flex ps-1 mt-2 justify-content-start">Area of Exam</label>
						<input type="text" name="last_name" class="form-control" value="Criminal Jurisprudence">
						<label  class="d-flex ps-1 mt-2 justify-content-start">Score</label>
						<input type="text" name="last_name" class="form-control" value="100">
						<label  class="d-flex ps-1 mt-2 justify-content-start">Percentage</label>
						<input type="text" name="last_name" class="form-control" value="100%">
						<label  class="d-flex ps-1 mt-2 justify-content-start">Total corect answers</label>
						<input type="text" name="last_name" class="form-control" value="100">
		      		</div>
		      	</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Close</button>
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
	    <!-- Delete Results -->
		<div class="modal fade" id="Delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
			<div class="modal-dialog">
	    		<div class="modal-content">
	    			<div class="modal-header flex-column border-0">
	    				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        				<div class="icon-box mt-3">
        					<i class="far fa-times-circle fa-5x text-danger"></i>
        				</div>
        				<h4 class="modal-title text-align-center mt-3 fw-bold">Are you sure?</h4>
	    			</div>
	    			<form class="form" action="#" method="POST">
	    				<div class="modal-body">
	    					<div class="container d-flex justify-content-center">
	    						<input type="hidden" name="update_id" id="delete_id">
	    						<p>Do you really want to delete these record?</p>
	    					</div>
	    					<div class="modal-footer d-flex justify-content-center border-0">
	        					<input type="submit" name="save" class="btn btn-success px-5 pb-2 text-white" value="YES">
	        					<button type="button" class="btn btn-danger  px-5 pb-2 text-white" data-bs-dismiss="modal">NO</button>
							</div>
	    				</div>
	    			</form>
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
  	 $('#result2Tab').DataTable({
  	 	paging: true
  	 });
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
  	 $('#result3Tab').DataTable({
  	 	paging: true
  	 });
  });
</script>
<script type="text/javascript">

   $(document).ready(function(){
    $('.view_btn').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: '../php/view_results_acc.php',
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