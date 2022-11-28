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
	<title>Analytics</title>
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
	<!-- JS Chart-->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
									<li class="breadcrumb-item active" aria-current="page">Question Analysis</li>
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
								<h2 class="text-dark text-start ps-3 fw-bold mt-4 ms-2">Question Analysis</h2>
							</div>
						</div>
						<div class="row">
							<div class="col ">
								<div class="card">
									<div class="card-body rounded-3 m-3 table-responsive-lg">
										<div class="row justify-content-between">
											<div class="col-lg-6">
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
										</div>
										<table class="table table-hover align-middle" id="resultTab">
											<thead>
												<tr>
													<th scope="col">No.</th>
													<th scope="col">Question</th>
													<th scope="col">Area of Exam</th>
													<th scope="col">Correct responses</th>
													<th scope="col">Percentage</th>
													<th scope="col" style="text-align: center;">Action</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
	                                                <td>Berto, with evident premeditation and treachery killed his father. What was the crime committed?</td>
	                                                <td>Criminal Jurisprudence </td>
	                                                <td>45/45</td>
	                                                <td>100%</td>
	                                                <td>
	                                                	<div class="d-flex flex-row">
	                                                		<button class="btn btn-primary  mx-2" data-bs-toggle="modal" data-bs-target="#ViewModal"  type="button"><i class="fas fa-eye"></i></button>
	                                                		<button class="btn btn-secondary  mx-2" data-bs-toggle="modal" data-bs-target="#Delete"><i class="fas fa-trash"></i></button>
	                                                	</div>
	                                                </td>
	                                            </tr>
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
		<!-- View Modal-->
		<div class="modal fade" id="ViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"></h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<!-- Horizantal graph Chart-->
						<canvas id="myChart" style="height: 100px; width: 250px;"></canvas>
						<script>
							const ctx = document.getElementById('myChart').getContext('2d');
							const myChart = new Chart(ctx, {
							    type: 'bar',
							    data: {
							        labels: ['A. Murder','B.  Parricide','C. Homicide','D. Qualified Homicide'],
							        datasets: [{
							            label: 'Correct Response',
							            data: [10,9,8,6],
							            backgroundColor: [
							            'rgba(15, 157, 88)',
							            'rgba(204, 204, 204)',
							            'rgba(204, 204, 204)',
							            'rgba(204, 204, 204)',
							                
							                
							            ],
							            borderColor: [
							            'rgb(15, 157, 88)',
							            'rgb(204, 204, 204)',
							            'rgb(204, 204, 204)',
							            'rgb(204, 204, 204)',
							                
							            ],
							            borderWidth: 1
							        }]
							    },
							    options: {
							    	indexAxis: 'y',
							        scales: {
							            y: {
							               ticks: { color: '##000000', beginAtZero: true , precision: 0 }
							            }
							        }
							    },
							});
						</script>
					</div>
					<div class="card mt-3 m-4 border-0">
						<div class="card-body">
							<label class="d-flex ps-1 justify-content-start">Question</label>
							<textarea type="text" name="last_name" class="form-control"readonly="">Berto, with evident premeditation and treachery killed his father. What was the crime committed?</textarea> 
							<label class="d-flex ps-1 mt-2 justify-content-start" >Area of Exam</label>
							<input type="text" name="last_name" class="form-control" value="Criminal Jurisprudence " readonly="">
							<label class="d-flex ps-1 mt-2 justify-content-start">Level of diffculty</label>
							<input type="text" name="last_name" class="form-control" value="EASY" readonly="">
							<label  class="d-flex ps-1 mt-2 justify-content-start">Percentage</label>
							<input type="text" name="last_name" class="form-control" value="100%" readonly="">
						</div>		
					</div>
					<div class="modal-footer border-0">
						<button type="button" class="btn btn-danger mx-2" data-bs-dismiss="modal"><i class="fas fa-times"></i> Close</button>
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
	    <!-- Delete Record -->
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


</body>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
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
</html>