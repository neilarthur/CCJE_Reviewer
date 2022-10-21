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
	<title>Accounts</title>
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
	<style>
       .dp .dropdown-toggle::after {
            content: none;
        }
    </style>
</head>
<body style="background-color: rgb(229, 229, 229);">
	<div class="sidebar close">
		<div class="logo-details mt-2">
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
							<div class="profile_name"><a class="profile text-warning"href="profile.php?acc_id=<?php echo $_SESSION["acc_id"] ?>"><?php echo $_SESSION["first_name"];?></a></div>
							<div class="job"><?php echo $_SESSION["role"];?></div>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<section class="home-section float-start">
			<div class="home-content d-flex justify-content-between" style="background: white;">
				<button style="border-style: none; background: white;">
					<i class='bx bx-menu' ></i>
				</button>
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
			<div class="col py-3 overflow-auto ms-3 me-3">
				<div class="container-fluid">
					<div class="row">
						<div class="col d-flex justify-content">
							<div class="w-50">

								<h2 class="text-dark text-start ps-3 fw-bold mt-4 "> Account Management</h2>

							</div>
						</div>
						<div class="row">
							<div class="col ">
								<div class="card">
									<div class="card-body rounded-3 m-4 table-responsive-lg">
										<div class="position-left d-flex justify-content-end mb-3">
											<button type="button" class="btn  px-3 pb-2 text-white" data-bs-toggle="modal" data-bs-target="#AddModal" style="margin-left: 55%; background-color: #8C0000;"><b><i class="fas fa-plus"></i></b> ADD</button>
										</div>
										<table class="table table-striped align-middle bg-light" id="accountTab">
											<thead>
												<tr>
													<th scope="col">Student ID</th>
													<th scope="col">Fullname</th>
													<th scope="col">Year</th>
													<th scope="col">Section</th>
													<th scope="col" style="text-align: center;">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php

												$acc = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE role='student' AND status = 'active'");

												while ($rows = mysqli_fetch_assoc($acc)) { ?> 
												<tr>
													<td><?php echo $rows['user_id'];  ?></td>
													<td><?php echo $rows['last_name'];  ?>, &nbsp;<?php echo $rows['first_name'];  ?>&nbsp; <?php echo $rows['middle_name'];  ?></td>
													<td><?php echo $rows['year'];  ?></td>
													<td><?php echo $rows['section'];  ?></td>
													<td>
														<div class="d-flex flex-row justify-content-center">
															<button data-id='<?php echo $rows['acc_id'];  ?>' class="btn btn-primary  mx-2 viewbtn" data-bs-toggle="modal" type="button"><i class="fas fa-eye"></i></button>
															<button data-id='<?php echo $rows['acc_id'];  ?>' class="btn btn-warning  mx-2 editbtn" data-bs-toggle="modal" type="button"><i class="fas fa-edit"></i></button>

															<a href="../php/facul_archive_account.php?id=<?= $rows['acc_id']; ?>" class="btn btn-secondary mx-2 btn-del" ><i class="fas fa-trash"></i></a>

														</div>
													</td>
												</tr>
												<?php }  ?>
											</tbody>
										</table>
										<?php if (isset($_GET['m'])) : ?>
											<div class="flash-data" data-flashdata="<?= $_GET['m']; ?>"></div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
			</div>
		</div>
	</section>
	 <!-- ADD Student Account -->
    <div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog modal-lg">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title fw-bold fs-3" id="exampleModalLabel">Add Student Account</h5>
    				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    			</div>
    			<div class="modal-body">
    				<div class="container">
    					<form class="form" method="POST" action="../php/facul_student_acc.php" enctype="multipart/form-data">
    						<div class="col">
    							<div class="row">
    								<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 py-2 me-5">
    									<img src="../assets/pics/tempo.png" id="img" alt="preview" class="img-fluid img-thumbnail rounded-circle mb-2">
										<input type="file" name="image" class="form-control" id="fileimg" required="" accept=".jpg, .jpeg, .png">
										<label for="image_browser" class="d-flex justify-content-center mt-2 ps-1">Attach Picture</label>
    								</div>
    								<div class="col-xl-7 col-lg-6 col-md-12 col-sm-6 py-2">
    									<label for="user-last" class="d-flex justify-content-center ps-1">Last Name</label>
    									<input type="text" name="last_name" class="form-control text-center"required>

    									<label for="user-first" class="d-flex justify-content-center ps-1">First Name</label>
    									<input type="text" name="first_name" class="form-control text-center" required>
    									<label for="user-middle" class="d-flex justify-content-center ps-1">Middle Name</label>
    									<input type="text" name="mid_name"  class="form-control text-center" required>
    								</div>
    							</div>
    							<div class="row">
    								<div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 py-2">
										<label for="user-id" class="d-flex justify-content-start ps-1">Role</label>
										<input type="text" name="role" value="Student" class="form-control" readonly="">
									</div>
    								<div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 py-2">
										<label for="user-bday" class="d-flex justify-content-start ps-1">Birth Date</label>
										<input type="date" name="birth_date" class="form-control" required="">
									</div>
									<div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 py-2">
										<label for="user-age" class="d-flex justify-content-start ps-1">Age</label>
										<input type="number" name="age" class="form-control" required="">
									</div>
									<div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 py-2">
										<label for="user-sex" class="d-flex justify-content-start ps-1">Gender</label>
										<div class="input-group">
											<select class="form-select" required="" name="gender">
												<option selected></option>
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 py-2">
										<label for="user-id" class="d-flex justify-content-start ps-1">Student ID:</label>
										<input type="number" name="user_id" class="form-control" required="">
									</div>
									<div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 py-2">
										<label for="user-year" class="d-flex justify-content-start ps-1">Year</label>
										<div class="input-group">
											<select class="form-select" required="" name="year">
												<option selected></option>
												<option value="4th year">4th year</option>
											</select>
										</div>
									</div>
									<div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 py-2">
										<label for="user-section" class="d-flex justify-content-start ps-1">Section</label>
										<div class="input-group">
											<select class="form-select" required="" name="section">
												<option selected></option>
												<option value="4A">4A</option>
												<option value="4B">4B</option>
												<option value="4C">4C</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 py-2">
										<label for="user-email" class="d-flex justify-content-start ps-1">Email Address</label>
										<input type="text" name="email_address" class="form-control" required="">
									</div>
									<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 py-2">
										<label for="user-mobile" class="d-flex justify-content-start ps-1">Mobile Number</label>
										<input type="number" name="mobile_no" class="form-control" required="">
									</div>
								</div>
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 py-2">
									<label for="user-add" class="d-flex justify-content-start ps-1">Address</label>
									<textarea class="form-control" name="address" rows="2"></textarea>
								</div>
								<div class="col-xl-12 col-lg-6 col-md-12 col-sm-12 py-2">
									<label for="user-password" class="d-flex justify-content-start ps-1">Password</label>
									<input type="password" name="password" class="form-control" minlength="8" required="">
								</div>
							</div>
							<div class="modal-footer border-0 d-flex justify-content-center mt-2">
								<button type="submit" name="save" class="btn btn-success px-5 pb-2 text-white"><i class="fas fa-check me-2"></i>Submit</button>
    							<button type="button" class="btn btn-danger btn  px-5 pb-2 text-white" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>Close</button>
    						</div>
    					</form>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

    <!-- View  Account -->
    <div class="modal fade" id="ViewAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    	<div class="modal-dialog modal-lg">
    		<div class="modal-content">
    			<div class="modal-header">
    				<h5 class="modal-title fw-bold fs-3" id="exampleModalLabel">Profile Information</h5>
    				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    			</div>
    			<div class="modal-body">
    				<div class="mods">
    					
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

    <!-- Edit Account -->
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


<!-- View modal --->
 <script type="text/javascript">

   $(document).ready(function(){
    $('.viewbtn').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: '../php/view_facul_account.php',
        type: 'post',
        data: {userid: userid},
        success: function(response){
          $('.mods').html(response);
          $('#ViewAccount').modal('show');
        }
      });
    });
   });
 </script>

  <!-- Edit modal --->
 <script type="text/javascript">

   $(document).ready(function(){
    $('.editbtn').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: '../php/edit_facul_account.php',
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


 <script type="text/javascript">
 	$('.btn-del').on('click',function(e){

 		e.preventDefault();

 		const href = $(this).attr('href')

 		Swal.fire({

 			title: 'Are you Sure?',
 			text: 'Record will be deleted',
 			icon: "warning",
 			type:'Warning',
 			showCancelButton:true,
 			confirmButtonColor:'#3085d6',
 			cancelButtonColor:'#d33',
 			confirmButtonColor:'Delete Record',
 		}).then((result)=> {

 			if (result.value) {
 				document.location.href = href;

 			}
 		})
 	})

 	const flashdata = $('.flash-data').data('flashdata')
 	if (flashdata) {

 		Swal.fire({
 			type: 'success',
 			icon: "success",
 			title: 'Record Archive',
 			text: 'Record Has been Archive!',
 		})
 	}
 </script>
<script type="text/javascript">
	fileimg.onchange = evt => {
		const [file] = fileimg.files;
		if (file) {
			img.src = URL.createObjectURL(file);

		}
	}
</script>

<script src="../js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../js/dt-1.10.25datatables.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
  	 $('#accountTab').DataTable({
  	 	paging: true
  	 });
  });
</script>
<?php 
#add accounts
if (isset($_GET['addsuccess'])) {
	echo ' <script> swal("Account has been Saved!", " clicked the okay!", "success");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/faculty/accounts_manage.php");
	</script>';
}
elseif (isset($_GET['adderror'])) {
	echo ' <script> swal("Account has not saved!", " clicked the okay!", "error");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/faculty/accounts_manage.php");
	</script>';
}
#update accounts
if (isset($_GET['upsuc'])) {
	echo ' <script> swal("Account has been Changed!", " clicked the okay!", "success");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/faculty/accounts_manage.php");
	</script>';
}
elseif (isset($_GET['upsucer'])) {
	echo ' <script> swal("Account has not saved!", " clicked the okay!", "error");
	window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/faculty/accounts_manage.php");
	</script>';
}
 
?> 

</html>