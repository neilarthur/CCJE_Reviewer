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
	<title>Adding Quiz Question</title>
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
					<span class="link_name">Pre-Board Examnination</span>
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
									<li class="breadcrumb-item"><a href="../faculty/dashboard.php" style="text-decoration: none;">Home</a></li>
									<li class="breadcrumb-item"><a href="../faculty/preboard.php" style="text-decoration: none;">Preboard Examination</a></li>
									<?php
									$id = $_GET['id'];
									$preboard= mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question WHERE pre_exam_id = '$id'");
									while ($rows = mysqli_fetch_assoc($preboard)) { ?>
									<li class="breadcrumb-item"><a href="editing-preboard.php?id=<?php echo $rows['pre_exam_id']?>&total=<?php echo $rows['total_question'] ?>" style="text-decoration: none;">Editing preboard</a></li>
									<?php }  ?>
									<li class="breadcrumb-item active" aria-current="page">Editing & Adding preboard question</li>
								</ol>
							</nav>
						</div>
					</nav>
				</div>
				<form class="d-flex">
					<div class="dropdown dp mt-3">
		                <a class="text-reset dropdown-toggle text-decoration-none" href="#"id="navbarDropdownMenuLink" role="button"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell fa-lg "></i>
		                	<?php $come = mysqli_query($sqlcon,"SELECT * FROM tbl_response  WHERE response_stat='0' ORDER BY response_id DESC");
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
	                        <a class="dropdown-item d-flex align-items-center" href="../faculty/notification.php">
	                            <div class="me-4">
	                                 <div class="fa-stack fa-1x">
	                                  <i class="fa fa-circle fa-stack-2x ms-2"></i>
	                                  <i class="fas fa-user fa-stack-1x ms-2 text-white" ></i>
	                                </div> 
	                            </div>

	                            <div>

	                                <div class="small text-gray-500"><?php  $life = date('F j, Y, g:i a',strtotime($item['created']));
	                                 echo $life; ?></div>
	                                <span class="fw-bold"><?php echo $item['first_name']." ".$item['last_name']."&nbsp;has a message from you"; ?></span>
	                                
	                            </div>

	                            <?php
			                        }
			                    }
	                            ?>
	                        </a>
	                        <a class="dropdown-item text-center small text-gray-500" href="../faculty/notification.php">Show All Notifications</a>
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
			<div class="col p-3 overflow-auto">
				<div class="container-fluid ">
					<form action="test_preboard.php" method="POST" id="add_form">
						<div class="col-lg-8 mx-auto mt-2">
							<table class="table-responsive">
								<thead>
									<tr>
										<?php
											$id = $_GET['id'];
										    $query = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question WHERE pre_exam_id = '$id'");

										while ($get = mysqli_fetch_assoc($query)) { ?>
										<div class="card">
											<div class="card-body">
												<h3 class="card-title fw-bold mb-4">Adding  preboard question</h3>
												<div class="row">
													<div class="col-lg-6">
														 <div class="input-group mb-3">
														 	<span class="input-group-text bg-white fw-bold">Area of Exam</span>
								                        	<input class="form-control" name="subjects" value="<?php echo $get['subjects']?>" readonly>	
								                        </div>
													</div>
													<div class="col-lg-6">
								                        <div class="input-group mb-3">
								                        	<span class="input-group-text bg-white fw-bold">Level of difficulty</span>
								                        	<select class="form-select" name="level_difficulty" required>
																<option selected value="">Select Difficulty</option>
																<option value="Easy">Easy</option>
																<option value="Moderate">Moderate</option>
																<option value="Hard">Hard</option>
															</select>
														</div>
													</div>
												</div>
											</div>
										<?php }?>
										</div>
									</tr>
								</thead>
								<!-- Question -->
								<tbody>
									<tr>
										<div class="card mt-2 border-0">
											<div class="card-body py-3">
												<div class="form-group mb-3">
													<div class="d-flex justify-content-between">
														<label for="name" class="fw-bold mb-1">Question</label>
														<button class=" btn btn-secondary remove_item_btn"><i class="fas fa-trash-alt"></i></button>
													</div>
						                            <textarea type="text" class="form-control mt-2" name="questions_title[]" rows="3" required></textarea>
						                        </div>
						                        <div class="input-group mb-3">
						                            <label for="name"class="input-group-text bg-white fw-bold">Option A</label>
						                            <input type="text" class="form-control" name="option_a[]" id="txt2" required="">
						                        </div>
						                        <div class="input-group mb-3">
						                            <label for="name"class="input-group-text bg-white fw-bold">Option B</label>
						                            <input type="text" class="form-control" name="option_b[]" id="txt1" required="">
						                        </div>
						                        <div class="input-group mb-3">
						                            <label for="name"class="input-group-text bg-white fw-bold">Option C</label>
						                            <input type="text" class="form-control" name="option_c[]" id="txt3" required="">
						                        </div>
						                        <div class="input-group mb-3">
						                            <label for="name"class="input-group-text bg-white fw-bold">Option D</label>
						                            <input type="text" class="form-control" name="option_d[]" required="">
						                        </div>
						                        <div class="col-sm-6">
						                        	 <div class="input-group mb-3">
							                            <label for="name"class="input-group-text bg-white fw-bold">Correct Answer</label>
							                            <select class="form-select" name="correct_ans[]" required="">
															<option selected value=""></option>
															<option value="A">A</option>
															<option value="B">B</option>
															<option value="C">C</option>
															<option value="D">D</option>
														</select>
							                        </div>
						                        </div>
						                        <div class="form-group">
						                             <label for="name" hidden="">Faculty</label>
						                             <input type="hidden" name="update_id" value="<?php echo $_GET['id']; ?>">
						                             <input type="hidden" name="acc[]" value="<?php echo $_SESSION['acc_id'] ?>">
						                        </div>
											</div>
										</div>
									</tr>
								</tbody>
							</table>

							<div id="show_item">
								
							</div>
							<div class="card mt-2">
								<div class="card-body">
									<div class="card-footer bg-white border-0 d-flex justify-content-center mb-1">

										<?php

												$tot = $_GET['total'];

												$val = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_choose_quest WHERE pre_exam_id = {$_GET['id']}");
												$val_run = mysqli_num_rows($val);

												$val_total = $tot - $val_run;
												?>
										<input type="hidden" name="total" id="totals" value="<?php echo $val_total; ?>">
										<input type="hidden" name="total_1"  value="<?php echo $_GET['total'] ?>">
										<button type="submit" class="btn btn-primary px-4 pb-2 add_item_btn"><i class="fas fa-plus-circle me-2"></i>Add</button>
										
										<button type="submit" name="create" class="btn btn-success mx-2 px-4 pb-2" id="create_btn"><i class="fas fa-check-circle me-2"></i>Save and display</button>

										<a href="editing-preboard.php" class=" btn btn-danger backbtn  px-4 pb-2"><i class="fas fa-times-circle me-2"></i>Cancel</a>
									</div>
								</div>
							</div>
						</div>
					</form>
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
	                <div class="modal-footer d-flex justify-content-center border-0">
	                    <form action="../php/logout_faculty.php" class="hide" method="POST">
	                    	<input type="hidden" name="id" value="<?php echo $_SESSION['acc_id']  ?>">
							<input type="hidden" name="times" value="<?php echo $_SESSION['login_id']  ?>">
							<button type="submit" class="btn btn-success mx-2 px-5 pb-2">YES</button>
							<button type="button" class="btn btn-danger mx-2 px-5 pb-2" data-bs-dismiss="modal">NO</button>
						</form>
	                </div>
	            </div>
	        </div>
	    </div>


</body>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/dt-1.10.25datatables.min.js"></script>
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

		var max_field = $("#totals").val();
		var def = 1;
		$(".add_item_btn").click(function(){

			if (def < max_field) {

				def++;

				$("#show_item").append('<div class="card mt-2 border-0 append_item"> <div class="card-body py-3"> <div class="form-group mb-3"> <div class="d-flex justify-content-between"> <label for="name" class="fw-bold mb-1">Question</label> <!---sssss ---> <button class=" btn btn-secondary remove_item_btn"><i class="fas fa-trash justify-content-center"></i></button>   </div> <textarea type="text" class="form-control mt-2" name="questions_title[]" rows="3" required></textarea> </div> <div class="input-group mb-3"> <label for="name"class="input-group-text bg-white fw-bold">Option A</label> <input type="text" class="form-control" name="option_a[]" id="txt2" required=""> </div> <div class="input-group mb-3"> <label for="name"class="input-group-text bg-white fw-bold">Option B</label> <input type="text" class="form-control" name="option_b[]" id="txt1" required=""> </div> <div class="input-group mb-3"> <label for="name"class="input-group-text bg-white fw-bold">Option C</label> <input type="text" class="form-control" name="option_c[]" id="txt3" required=""> </div> <div class="input-group mb-3"> <label for="name"class="input-group-text bg-white fw-bold">Option D</label> <input type="text" class="form-control" name="option_d[]" required=""> </div> <div class="col-sm-6"> <div class="input-group mb-3"> <label for="name"class="input-group-text bg-white fw-bold">Correct Answer</label> <select class="form-select" name="correct_ans[]" required=""> <option selected></option> <option value="A">A</option> <option value="B">B</option> <option value="C">C</option> <option value="D">D</option> </select> </div> </div> <div class="form-group"> <label for="name" hidden="">Faculty</label> <input type="hidden" name="acc[]" value="<?php echo $_SESSION['acc_id'] ?>"> </div> </div> </div>');
			}
		});

		$(document).on('click','.remove_item_btn', function(e) {
			e.preventDefault();

			let row_item = $(this).parent().parent().parent();
			$(row_item).remove();
		});
	});
</script>
<script type="text/javascript">
$(".backbtn").on("click", function(e){
  e.preventDefault();
  window.history.back();
});

</script>
</html>
