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
									<li class="breadcrumb-item active" aria-current="page">Notifications</li>
								</ol>
							</nav>
						</div>
					</nav>
				</div>
				<form class="d-flex">
					<!--- Notification -->
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
			<div class="container-fluid py-3 px-4">
				<div class="container col-lg-8">
					<h4 class="m-b-50">Notifications <i class="fa fa-bell ms-2"></i></h4>
					<div class="notification-ui_dd-content">
						<?php

	                            $come = mysqli_query($sqlcon,"SELECT * FROM tbl_response,choose_question,accounts WHERE (tbl_response.test_id = choose_question.test_id) AND (choose_question.prepared_by ='{$_SESSION['acc_id']}') AND (tbl_response.acc = accounts.acc_id) ORDER BY response_id DESC");


	                            if (mysqli_num_rows($come)==0) {
	                            	
	                            	echo "<h5 class='text-center'>No notification Found</h5>";

	                            } 

	                            if (mysqli_num_rows($come) >= 0) {

	                            	 while ($item = mysqli_fetch_array($come)) {

	                            ?>
						<div class="notification-list notification-list--unread">
							<div class="notification-list_content">
								<div class="notification-list_img">
									<?php
						            $pic = $item['image_size'];
						            echo '<div class="fa-stack fa-1x">
						            <img class="me-4 rounded-circle" src="data:image;base64,'.base64_encode($pic).'" height="40px;" width="40px;">
						            </div> ';
						             ?>
								</div>
								<div class="notification-list_detail ms-4">
									<p><b><?php echo $item['first_name']." ".$item['last_name']."</b>&nbsp; has a message for you"; ?></p>
									 
									<p class="fw-bold"><?php echo $item['feedback']; ?></p>
									<p class="text-muted"><small>10 mins ago</small></p>
								</div>
							</div>
							<div class="notification-list_feature-img">
								<div class="small text-gray-500 text-muted"><?php echo date('F j, Y',strtotime($item['created']));
	                                  ?></div>
							</div>
						</div>
						<?php
		                        }
		                    }

		                  $reponsed = mysqli_query($sqlcon,"SELECT * FROM tbl_admin_response,accounts,tbl_pre_question WHERE (tbl_admin_response.acc_id= accounts.acc_id) AND (tbl_admin_response.pre_exam_id =tbl_pre_question.pre_exam_id) AND tbl_pre_question.prepared_by = '{$_SESSION['acc_id']}' ORDER BY tbl_res_id_ad DESC");


	                            if (mysqli_num_rows($reponsed) >= 0) {

	                            	 while ($row = mysqli_fetch_array($reponsed)) {

	                     ?>

	                     
	                      <div class="notification-list notification-list--unread">
							<div class="notification-list_content">
								<div class="notification-list_img">
									<?php
						            $pic = $row['image_size'];
						            echo '<div class="fa-stack fa-1x">
						            <img class="me-4 rounded-circle" src="data:image;base64,'.base64_encode($pic).'" height="40px;" width="40px;">
						            </div> ';
						             ?>
								</div>
								<div class="notification-list_detail ms-4">
									<p><b> Sir <?php echo $row['first_name']." ".$row['last_name']."</b>&nbsp; provided a feedback regarding "; ?></p>
									<p>on the <?php $row['subjects']; ?>exam that you created</p>
									 
									<p class="fw-bold"><?php echo $row['response_sender']; ?></p>
									<p class="text-muted"><small>10 mins ago</small></p>
								</div>
							</div>
							<div class="notification-list_feature-img">
								<div class="small text-gray-500 text-muted"><?php echo date('F j, Y',strtotime($row['date_created']));
	                                  ?></div>
							</div>
						</div>
							<?php } 
						} ?>
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
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
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