<?php

session_start();
include_once '../php/conn.php';

if (!isset($_SESSION["login"]) || $_SESSION['login'] !=true) {
    header("location: ../php/index.php");
     exit;
}
elseif (!isset($_SESSION["role"]) || $_SESSION['role'] !='secretary') {
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
        .drop .dropdown-toggle::after {
            content: none;
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
			<li class="navigation-list-item">
                <a href="archive_users.php?tab-accounts=students" >
                    <i class="fas fa-archive"></i>
                    <span class="link_name">Archived</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="archive_users.php?tab-accounts=students">Archived</a></li>
                </ul>
            </li>
			<li class="navigation-list">
				<div class="profile-details">
					<?php

                    $query_row = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id= '{$_SESSION['acc_id']}' ");
                     while ($rows = mysqli_fetch_assoc($query_row)) {
                     	echo '<div class="profile-content">
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
									<li class="breadcrumb-item active" aria-current="page">Examination Analytics</li>
								</ol>
							</nav>
						</div>
					</nav>
				</div>
				<form class="d-flex">
					<div class="dropdown dp mt-3 me-2">
		                <a class="text-reset dropdown-toggle text-decoration-none position-relative" href="#"id="navbarDropdownMenuLink" role="button"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell fa-lg mx-2"></i>
		                    <div id="count_wrapper">
		                        
		                    </div>
		                </a>
		                <div class="dropdown-list bg-light dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="border-radius: 10px;">
		                    <p class="h5 dropdown-header text-dark ">Notifications</p>
		                      <div style="overflow-y: auto; white-space: nowrap; height: auto; max-height: 300px;" class="bg-white">
		                         <div id="wrapper">
		                             
		                         </div> 
		                      </div>
		                    <a class="dropdown-item text-center small text-gray-500" href="notification.php">Show All Notifications</a>
		                </div>
		            </div>
	                <div class="dropdown mx-2">
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
								<h2 class="text-dark text-start ps-3 fw-bold mt-4 ms-2">Examination Analytics</h2>
							</div>
						</div>
						<div class="row">
							<div class="col ">
								<div class="card">
									<div class="card-body rounded-3 m-3 table-responsive-lg">
										<table class="table table-hover align-middle" id="resultTab">
											<thead>
												<tr>
													<th scope="col">No.</th>
													<th scope="col">Area of Examination</th>
													<th scope="col">Total of items</th>
													<th scope="col">Time Limit</th>
													<th scope="col">Prepared by</th>
													<th scope="col" class="text-center">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php

												$manage = mysqli_query($sqlcon,"SELECT * FROM accounts,tbl_pre_question WHERE (accounts.acc_id = tbl_pre_question.prepared_by)");

												$counter = 1;
												while ($rows= mysqli_fetch_assoc($manage)) {
													
												 ?>
												<tr>
													<td><?php echo $counter; ?></td>
	                                                <td><?php echo $rows['subjects']; ?></td>
	                                                <td class="ps-5"><?php echo $rows['total_question']; ?></td>
	                                                <td><?php echo $rows['time_limit'] /3600 ; ?>hr(s)</td>
	                                                <td><?php echo $rows['first_name'] ." ".$rows['last_name']; ?></td>
	                                                <td>
	                                                	<div class= "d-flex justify-content-center">
	                                                		<a href="question_analysis.php?id=<?php echo $rows['pre_exam_id'];?>&total=<?php echo $rows['total_question']; ?>&area=<?php echo $rows['subjects'] ?>" class="btn btn-secondary mx-2"><i class="fas fa-file-signature"></i></a>

	                                                		<div class="btn-group dropdown drop">
	                                                			<button type="button" class="btn btn-primary dropdown-toggle " data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-download"></i></button>

	                                                			<div class="dropdown-menu">
	                                                				<form action="export_file.php" method="POST">
	                                                					<input type="hidden" name="excel_id" value="<?php echo $rows['pre_exam_id']; ?>">
	                                                					<input type="hidden" name="file_type" value="xlsx">
	                                                					<button type="submit" class="dropdown-item" name="export_excel_btn"><i class="fas fa-file-download me-2"></i></i>Download Results</button>
	                                                				</form>
	                                                				<div class="dropdown-divider"></div>
	                                                				<li>
	                                                					<a target='_blank' href="section_a_analysis.php?id=<?php echo $rows['pre_exam_id'];?>&total=<?php echo $rows['total_question']; ?>&area=<?php echo $rows['subjects'] ?>" class="dropdown-item"><i class="fas fa-print me-2"></i>Print Section 4A</a>
	                                                				</li>
	                                                				<div class="dropdown-divider"></div>
	                                                				<li>
	                                                					<a target='_blank' href="section_b_analysis.php?id=<?php echo $rows['pre_exam_id'];?>&total=<?php echo $rows['total_question']; ?>&area=<?php echo $rows['subjects'] ?>" class="dropdown-item"><i class="fas fa-print me-2"></i>Print Section 4B</a>
	                                                				</li>
	                                                				<div class="dropdown-divider"></div>
	                                                				<li>
	                                                					<a target='_blank' href="section_c_analysis.php?id=<?php echo $rows['pre_exam_id'];?>&total=<?php echo $rows['total_question']; ?>&area=<?php echo $rows['subjects'] ?>" class="dropdown-item"><i class="fas fa-print me-2"></i>Print Section 4C</a>
	                                                				</li>
	                                                			</div>
	                                                		</div>
	                                                	</div>
	                                                </td>
	                                            </tr>
	                                        <?php $counter ++; } ?>
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
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/accessibility.js"></script>
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
<script>
  function loadXMLDocs() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("count_wrapper").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", "notif_num.php", true);
  xhttp.send();
}
setInterval(function(){
    loadXMLDocs();
    // 1sec
},100);

window.onload = loadXMLDocs;

</script>
<script >
    function load() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("wrapper").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", "notif_wrapper.php", true);
  xhttp.send();
}
setInterval(function(){
    load();
    // 1sec
},100);

window.onload = load;
</script>
</html>