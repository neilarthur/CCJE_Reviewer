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
	<title>Dashboard</title>
	<!-- Boostrap 5.2 -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/dash.css">
	<!-- Box Icons-->
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<!-- Font Awesome-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"rel="stylesheet"/>
	<!-- JS Chart-->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
       .dp .dropdown-toggle::after {
            content: none;
        }
    </style>

</head>
<body>
	<div class="sidebar close">
		<div class="logo-details">
			<i class="fas fa-fingerprint mt-2"></i><span class="logo_name">CCJE Reviewer</span>
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
        </ul>
    </div>
	<section class="home-section" >
		<div class="home-content d-flex justify-content-between " style="background: white;">
            <button style="border-style: none; background: white;">
                <i class='bx bx-menu' ></i>
            </button>
            <form class="d-flex">
                <div class="dropdown dp mt-3">
                    <a class="text-reset dropdown-toggle text-decoration-none" href="#"id="navbarDropdownMenuLink" role="button"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell fa-lg"></i>
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
                <div class="dropdown me-3 ">
                    <button class="btn  dropdown-toggle border border-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php

                        $query_row = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id= '{$_SESSION['acc_id']}' ");
                         while ($rows = mysqli_fetch_assoc($query_row)) {
                      echo'<span><img class="me-2 rounded-circle" src="data:image;base64,'.base64_encode($rows["image_size"]).'" height="40px;"></span>';
                      ?>
                   <?php }

                    ?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="profile.php?acc_id=<?php echo $_SESSION["acc_id"] ?>"><i class="fas fa-user-circle fa-lg me-2" style="color: #8C0000;"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-lock fa-lg me-2" style="color: #8C0000;"></i> Change Password</a></li>
                        <li><a class="dropdown-item" href=""data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fas fa-sign-out-alt fa-lg me-2" style="color: #8C0000;"></i> Log out</a></li>
                    </ul>
                </div>
            </form>
		</div>
		<!-- Main Content-->
		<div class="container-fluid py-3">
			<div class="row">
				<!-- Accounts Card Example -->
				<div class="col-xl-3 col-md-6 mb-5 mt">
					<div class="card border-left-dark shadow p-3 py-1 ms-1" style="background-color: rgb(243, 156, 18 );">
						<div class="card-body">
							<div class="row no-gutters align-items-center">
								<div class="col mr-2">
									<div class="text-xs font-weight-bold text-white text-uppercase mb-2">
                                        <?php $query = "SELECT * FROM accounts WHERE role !='admin' AND status='active'";
                                                $query_result = mysqli_query($sqlcon,$query);

                                                $row = mysqli_num_rows($query_result);
                                       
                                        echo '<h2  class="mb-0 fw-bold"><b>'.$row.' </b></h2>';
                                        ?>
                                        Accounts
                                    </div>
                                </div>
                                <div class="col-auto mt-2">
                                     <span class="fa-stack fa-2x">
                                      <i class="fa fa-circle fa-stack-2x  text-white ms-2"></i>
                                      <i class="fas fa-user fa-stack-1x ms-2" style="color: rgb(243, 156, 18 );"></i>
                                    </span>                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Students Card Example -->
                <div class="col-xl-3 col-md-6 mb-5">
                    <div class="card border-left-dark shadow p-3 py-1" style="background-color: rgb(221, 75, 57);">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-white text-uppercase mb-2">
                                        <?php $query = "SELECT * FROM accounts WHERE role='student'AND status='active'";
                                                $query_result = mysqli_query($sqlcon,$query);

                                                $row = mysqli_num_rows($query_result);
                                        echo'<h2  class=" mb-0 fw-bold"><b>'.$row.' </b></h2>';
                                        ?>
                                        Students 
                                    </div>
                                </div>
                                <div class="col-auto mt-2 ">
                                   <span class="fa-stack fa-2x">
                                      <i class="fa fa-circle fa-stack-2x  text-white ms-3"></i>
                                      <i class="fas fa-graduation-cap fa-stack-1x ms-3" style="color: rgb(221, 75, 57);"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Faculty Card Example -->
                <div class="col-xl-3 col-md-6 mb-5">
                    <div class="card border-left-dark shadow p-3 py-1" style="background-color: rgb(0, 115, 183);">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-white text-uppercase mb-2">
                                         <?php $query = "SELECT * FROM accounts WHERE role='faculty'AND status='active'";
                                                $query_result = mysqli_query($sqlcon,$query);

                                                $row = mysqli_num_rows($query_result);
                                        echo'<h2  class=" mb-0 fw-bold"><b>'.$row.' </b></h2>';
                                        ?>
                                        Faculty
                                    </div>
                                </div>
                                <div class="col-auto mt-2">
                                    <span class="fa-stack fa-2x">
                                        <i class="fa fa-circle fa-stack-2x  text-white ms-3"></i>
                                        <i class="fas fa-chalkboard-teacher fa-stack-1x ms-3" style="color: rgb(0, 115, 183);"></i>
                                    </span>                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Analytics Card Example -->
                <div class="col-xl-3 col-md-6 mb-5">
                    <div class="card border-left-dark shadow p-3 py-1" style="background-color: rgb(0, 192, 239);">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    <?php $query = "SELECT * FROM test_question WHERE status ='active'";
                                            $query_result = mysqli_query($sqlcon,$query);

                                            $row = mysqli_num_rows($query_result);
                                            echo'<h2  class=" mb-0 fw-bold"><b>'.$row.' </b></h2>';
                                            ?>
                                        Questions
                                    </div>
                                </div>
                                <div class="col-auto mt-2">
                                     <span class="fa-stack fa-2x">
                                        <i class="fa fa-circle fa-stack-2x  text-white ms-3"></i>
                                        <i class="fas fa-question fa-stack-1x ms-3" style="color: rgb(0, 192, 239);"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-4">
                     <div class="card h-100 ms-4">
                        <div class="card-body card-body rounded-2">
                            <h5 class="card-title fw-bold">Question Count</h5>
                            <?php
                            $query = "SELECT * FROM test_question WHERE subject_name ='Criminal Jurisprudence '";
                            $count = $sqlcon->query($query);

                            $rows_count_value = mysqli_num_rows($count);

                            $query1 = "SELECT * FROM test_question WHERE subject_name ='Law Enforcement '";
                            $count1 = $sqlcon->query($query1);

                            $rows_count_value1 = mysqli_num_rows($count1);

                            $query2 = "SELECT * FROM test_question WHERE subject_name ='Criminalistics '";
                            $count2 = $sqlcon->query($query2);

                            $rows_count_value2 = mysqli_num_rows($count2);

                            $query3 = "SELECT * FROM test_question WHERE subject_name ='Crime Detection and Investigation'";
                            $count3 = $sqlcon->query($query3);

                            $rows_count_value3 = mysqli_num_rows($count3);

                            $query4 = "SELECT * FROM test_question WHERE subject_name ='Criminal Sociology'";
                            $count4 = $sqlcon->query($query4);

                            $rows_count_value4 = mysqli_num_rows($count4);

                            $query5 = "SELECT * FROM test_question WHERE subject_name ='Correctional Administration'";
                            $count5 = $sqlcon->query($query5);

                            $rows_count_value5 = mysqli_num_rows($count5);


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
                    <div class="card  ms-2">
                         <div class="card-body card-body rounded-2 ">
                            <canvas id="myChart"></canvas>
                            <script type="text/javascript">
                                const ctx = document.getElementById('myChart').getContext('2d');
                                const myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: ["Class Preboard Exam Percentage"],
                                        datasets: [{
                                             label: "4A ",
                                             backgroundColor: 'rgba(221, 75, 57, 0.8)',
                                             data: [80],
                                          },{
                                             label: "4B",
                                             backgroundColor: 'rgba(0, 115, 183, 0.8)',
                                             data: [100],
                                          },{
                                             label: "4C",
                                             backgroundColor: 'rgba(243, 156, 18, 0.8)',
                                             data: [90],

                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
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
</body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
<script src="../js/bootstrap.bundle.min.js"></script>
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
 <?php 
#Login success
if (isset($_GET['loginsuccess'])) {
  echo ' <script> swal("Login succesful!", " clicked the okay!", "success");
  window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/admin/dashboard.php");
  </script>';
}
?>
</html>