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
	<title>Notifications</title>
	<!-- Boostrap 5.2 -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/dash.css">
	<link rel="stylesheet" type="text/css" href="../css/notification.css">
	<!-- Box Icons-->
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<!-- Font Awesome-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"rel="stylesheet"/>
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
<body>
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
         <div class="d-flex">
            <button style="border-style: none; background: white; height: 20px; margin-top: 15px;" class="btn-sm">
                <i class='bx bx-menu' ></i>
            </button>
            <nav class="navbar navbar-expand-lg navbar-light ms-3" style="margin-top: 10px;">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php" style="text-decoration: none;">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Notification</li>
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
		<div class="container-fluid mt-3">
			<div class="container col-lg-8">
					<h4 class="m-b-50">Notifications <i class="fa fa-bell ms-2"></i></h4>
					<div class="notification-ui_dd-content">
						<?php

              $comers = mysqli_query($sqlcon,"SELECT * FROM tbl_notification,accounts WHERE (tbl_notification.acc_id = accounts.acc_id) AND (accounts.role='faculty') AND (tbl_notification.action='added an exam')  ORDER BY notif_id DESC");

              if (mysqli_num_rows($comers)==0) {
              	
              	echo "<h5 class='text-center'>No notification Found</h5>";
              }

              if (mysqli_num_rows($comers) >= 0) {

              	foreach ($comers as $item) {

              ?>
						<div class="notification-list notification-list--unread">
							<div class="notification-list_content">
								<div class="notification-list_img">
                  <?php 
                  $pic= $item['image_size'];
                  echo '<img class="mx-2 rounded-circle" src="data:image;base64,'.base64_encode($pic).'" height="40px;" width="40px;">'

                  ?>
								</div>
								<div class="notification-list_detail ms-2 mt-1">
									<p><b class="text-capitalize"><?php echo $item['first_name']." ".$item['last_name']."</b>&nbsp;".$item['action']; ?></p>
									<p class="text-muted"><small>10 mins ago</small></p>
								</div>
							</div>
							<div class="notification-list_feature-img">
								<div class="small text-gray-500 text-muted"><?php echo date('F j, Y',strtotime($item['date_created']));
	               ?></div>
							</div>
						</div>

                <?php
                }
            }
                ?>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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