<!-- may bug pa ito sa filter -->

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
	<!-- JS Chart-->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
		<div class="logo-details">
			<i class="fas fa-fingerprint"></i><span class="logo_name">CCJE Reviewer</span>
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
					<span class="link_name">Test Bank</span>
				</a>
				<ul class="sub-menu blank">
					<li><a class="link_name" href="testbank.php">Test Bank</a></li>
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
									<li class="breadcrumb-item"><a href="preboard.php" style="text-decoration: none;">Preboard Examination</a></li>
									<li class="breadcrumb-item active" aria-current="page">Question Analytics</li>
								</ol>
							</nav>
						</div>
					</nav>
				</div>
		        <form class="d-flex">
		          <div class="dropdown dp mt-3">
		                    <a class="text-reset dropdown-toggle text-decoration-none" href="#"id="navbarDropdownMenuLink" role="button"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell fa-lg "></i>
		                    <?php 
		                    $come = mysqli_query($sqlcon,"SELECT * FROM tbl_response  WHERE response_stat='0' ORDER BY response_id DESC");
		                	?>
		                    <span class=" top-0 start-100 translate-middle badge rounded-pill badge-notification bg-danger"><?php echo mysqli_num_rows($come); ?></span>
		                    </a>
		                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="border-radius: 10px;">
		                          <h6 class="dropdown-header text-dark ">Notifications</h6>
		                          <?php

		                            $come = mysqli_query($sqlcon,"SELECT * FROM tbl_response,choose_question,accounts WHERE (tbl_response.test_id = choose_question.test_id) AND (choose_question.prepared_by ='{$_SESSION['acc_id']}') AND (tbl_response.acc = accounts.acc_id) ORDER BY response_id DESC");

		                            if (mysqli_num_rows($come)==0) {
		                            	
		                            	echo "<h5 class='text-center'>No notification Found</h5>";
		                            }

		                            if (mysqli_num_rows($come) >= 0) {

		                            	foreach ($come as $item) {

		                            ?>
		                         <a class="dropdown-item d-flex align-items-center" href="notification.php">
		                            <div class="me-4">
		                                 <div class="fa-stack fa-1x">
		                                  <i class="fa fa-circle fa-stack-2x ms-2"></i>
		                                  <i class="fas fa-user fa-stack-1x ms-2 text-white" ></i>
		                                </div> 
		                            </div>
		                            <div class="fw-bold">
		                                <div class="small text-gray-500"><?php  $life = date('F j, Y, g:i a',strtotime($item['created']));
		                                 echo $life; ?></div>
		                                <span class="font-weight-bold"><?php echo $item['first_name']." ".$item['last_name']." has a message for you "; ?></span>
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
		                      echo'<span><img class="me-2 rounded-circle" src="data:image;base64,'.base64_encode($rows["image_size"]).'" height="40px;"></span>';
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
				<div class="col py-3 overflow-auto mx-2">
					<div class="container-fluid">
						<div class="row">
							<div class="col d-flex justify-content">
								<div class="w-50">
									<h2 class="text-dark text-start ps-3 fw-bold mt-4 ms-2">Question Analytics</h2>
								</div>
							</div>
							<div class="row">
								<div class="col ">
									<div class="card">
										<div class="card-body rounded-3 m-2 table-responsive-xl">
											<table class="table table-hover align-middle bg-light" width="100%"  id="examTab">
												<thead>
													<tr>
														<th hidden="">Id</th>
														<th hidden="">Exam id</th>
														<th scope="col">Areas of Exam</th>
														<th scope="col">Question</th>
														<th scope="col" class="ps-4">Action</th>
													</tr>
												</thead>
												<tbody>
													<?php

													$let = $_GET['id'];

													$exams = mysqli_query($sqlcon,"SELECT * FROM test_question,tbl_pre_question,tbl_pre_choose_quest WHERE (test_question.question_id=tbl_pre_choose_quest.question_id) AND (tbl_pre_question.pre_exam_id=tbl_pre_choose_quest.pre_exam_id) AND tbl_pre_choose_quest.pre_exam_id='$let' AND pre_choose_status='active'");
													
													while ($rows = mysqli_fetch_assoc($exams)) {
														
													?>
													<tr>
														<td hidden=""><?php echo $rows['question_id']; ?></td>
														<td hidden=""><?php echo $rows['exam_choose_id'] ?></td>
														
														<td scope="row"><?php echo $rows['subjects'];?></td>
														<td><?php echo $rows['questions_title'];?></td>
														<td>
															<?php

															$display = mysqli_query($sqlcon,"SELECT * FROM test_question,tbl_pre_question,tbl_pre_student_ans WHERE (test_question.question_id= tbl_pre_student_ans.question_id) AND (tbl_pre_question.pre_exam_id=tbl_pre_student_ans.pre_exam_id) AND tbl_pre_student_ans.pre_exam_id={$_GET['id']}");

															if (mysqli_num_rows($display) == 0) {
																
																echo "<div class='d-flex flex-row justify-content-center'>

																<button type='button' class='btn btn-secondary mx-2' disabled><i class='fas fa-chart-bar'></i></button>
																</div>
																" ;
															}
															elseif (mysqli_num_rows($display) >=0) {
																
																echo '															<div class="d-flex flex-row justify-content-center">

																<button data-id="'.$rows['question_id'].'" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-chart-bar"></i></button>
															</div>';
															}
															?>

														</td>
													</tr>
													<?php  }  ?>
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

		    <!--Question analysis Modal -->
			<div class="modal fade" id="viewToggle" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-xl">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title fw-bold">Question analysis</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="mugs">
								
							</div>					           
						</div>
						<div class="modal-footer border-0">
							<button type="button" class="btn btn-danger pb-2 px-4" data-bs-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Delete Question -->
		    <div class="modal fade" id="ArchiveAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
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
		    			<form class="form" action="../php/delete_pre_question.php" method="POST">
		    				<div class="modal-body">
		    					<div class="container d-flex justify-content-center">
		    						<input type="hidden" name="update_id" id="delete_id">
		    						<input type="hidden" name="lets" value="<?php echo $_GET['id']?>">
		    						<p>Do you really want to delete these record?</p>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

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

<!-- preview modal --->
 <script type="text/javascript">

   $(document).ready(function(){
    $('.view_btn').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: '../php/view__facul_analy_quest.php?id=<?php echo $_GET['id']; ?>',
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
 <script type="text/javascript">
  $(document).ready(function() {
  	 $('#examTab').DataTable({
  	 	paging: true
  	 });
  });
</script>
<script src="../js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../js/dt-1.10.25datatables.min.js"></script>

</html>