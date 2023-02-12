
<?php

session_start();
include_once '../php/conn.php';

if (!isset($_SESSION["login"]) || $_SESSION['login'] !=true) {
    header("location: ../php/index.php");
     exit;
}
elseif (!isset($_SESSION["role"]) || $_SESSION['role'] !='system admin') {
    header("location: ../php/index.php");
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login History</title>
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
									<li class="breadcrumb-item active" aria-current="page">Log History</li>
								</ol>
							</nav>
						</div>
					</nav>
				</div>
				<form class="d-flex">
					<div class="dropdown dp mt-3">
		                <a class="text-reset dropdown-toggle text-decoration-none" href="#"id="navbarDropdownMenuLink" role="button"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell fa-lg "></i>
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
			<div class="col py-3 overflow-auto">
				<div class="container-fluid">
					<div class="row">
						<div class="col d-flex justify-content">
							<div class="w-50">
								<h2 class="text-dark text-start ps-3 fw-bold mt-4 ms-4">Log History</h2>
							</div>
						</div>
						<div class="row">
							<div class="col ">
								<div class="card">
									<div class="card-body rounded-3 table-responsive-lg">
										<table class="table table-hover align-middle" id="logTab">
											<thead>
												<tr>
													<th scope="col">Name</th>
													<th scope="col">Position</th>
													<th scope="col">Assign Section</th>
													<th scope="col">Log In</th>
													<th scope="col">Log Out</th>
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php

												$base = mysqli_query($sqlcon, "SELECT * FROM logs,accounts WHERE (accounts.acc_id=logs.acc_id) AND role='faculty'");
												while ($rows = mysqli_fetch_array($base)) { ?>
												<tr>
													<td><?php echo $rows['first_name']."". $rows['last_name']; ?></td>
	                                                <td><?php echo $rows['role'] ; ?></td>
	                                                <td style="padding-left: 30px;"><?php echo $rows['section'] ; ?></td>
	                                                <td><?php echo $rows['login_time'] ; ?></td>
	                                                <td><?php echo $rows['logout_time'] ; ?></td>
	                                                <td><?php echo $rows['action']; ?></td>
	                                            </tr>
	                                            <?php } ?>
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
  	 $('#logTab').DataTable({
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
</html>