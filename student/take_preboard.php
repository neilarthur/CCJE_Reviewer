<?php

session_start();
include_once '../php/conn.php';

if (!isset($_SESSION["login"]) || $_SESSION['login'] !=true) {
    header("location: ../php/index.php");
     exit;
}
elseif (!isset($_SESSION["role"]) || $_SESSION['role'] !='student') {
    header("location: ../php/index.php");
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Preboard Exam</title>
	<!-- Boostrap 5.2 -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/home.css">
	<!-- Box Icons-->
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<!-- Font Awesome-->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<!-- System Logo -->
    <link rel="icon" href="../assets/pics/system-ico.ico">
</head>
<body style="background-color: rgb(229, 229, 229);">
	<div class="header text-uppercase hd " >
		<div class="container-fluid py-3">
			<img src="../assets/pics/logo.png" alt="" width="80" height="80" class="d-inline-block align-top mt-2 ms-2" >
			<h3 class="text-white mt-3 ms-4" >Automated Licensure Examination Reviewer </h3>
			<span class="text-white text-center dep">College of Criminal Justice and Education</span>
		</div>
	</div>
	<!-- Top navbar-->
	<nav id="navbar-top" class="navbar navbar-expand-lg navbar-light fw-bold">
		<div class="container-fluid">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse ms-4" id="navbarTogglerDemo03">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0 pe-2">
					<li class="nav-item text-uppercase">
						<a class="nav-link" aria-current="page" href="dashboard.php">Home</a>
					</li>
			        <li class="nav-item text-uppercase">
			            <a class="nav-link " href="take_quiz.php">Take Quiz</a>
			        </li>
			        <li class="nav-item text-uppercase">
			            <a class="nav-link " href="take_preboard.php">Pre-boad Exam</a>
			        </li>
			        <li class="nav-item text-uppercase">
			          <a class="nav-link " href="test_results.php">Results</a> 
			        </li>
			    </ul>
			    <div class="flex-shrink-0 dropdown px-4 text-center">
			    	<button class="btn  dropdown-toggle border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
	                <?php

	                    $query_row = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id= '{$_SESSION['acc_id']}' ");
	                     while ($rows = mysqli_fetch_assoc($query_row)) {
	                  echo'<span><img class="me-2 rounded-circle" src="data:image;base64,'.base64_encode($rows["image_size"]).'" height="40px;" width="40px;"> '.$_SESSION["first_name"].'</span>';
	                  ?>
	               <?php }

	                ?>

	                </button>
	                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
	                	<li><a class="dropdown-item" href="profile.php?acc_id=<?php echo $_SESSION["acc_id"] ?>"><i class="fas fa-user-circle fa-lg me-2" style="color: #8C0000;"></i> Profile</a></li>
	                	<li><a class="dropdown-item" href="change_password.php"><i class="fas fa-lock fa-lg me-2" style="color: #8C0000;"></i> Change Password</a></li>
	                	<li><a class="dropdown-item" href=""data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fas fa-sign-out-alt fa-lg me-2" style="color: #8C0000;"></i> Log out</a></li>
	                </ul>
	            </div>
	        </div>
	    </div>
	</nav>
	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header flex-column border-0 bg-warning">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  <div class="icon-box mt-2">
					  	<i class="fas fa-exclamation-circle fa-6x text-dark"></i>
					  </div> 
				</div>
				<div class="modal-body flex-column">
					<p class="fs-5 modal-title mt-3 text-center">The action are you going to perform is irrevesible. Please confirm!</p>
					  <p class="fs-5 mt-2 text-center">Are you sure that you want to logout?</p>
				</div>
				<div class="modal-footer d-flex justify-content-center border-0 mb-2">
					<form action="../php/logout_students.php" class="hide" method="POST" class="text-center">
						<input type="hidden" name="id" value="<?php echo $_SESSION['acc_id']  ?>">
						<input type="hidden" name="times" value="<?php echo $_SESSION['login_id']  ?>">
                        <button type="submit" class="btn btn-success mx-2 px-5 pb-2 rounded-pill">YES</button>
                        <button type="button" class="btn btn-danger mx-2 px-5 pb-2 rounded-pill" data-bs-dismiss="modal">NO</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--Main Content-->
	<div class="container py-4">
		<div class="row mt-3">
			<div class="card"style="background-color: #8C0000;;">
				<div class="card-body">
					<h2 class="fw-bold text-white text-uppercase">Preboard Examination</h2>
				</div>
			</div>
			<div class="card">
				<div class="card-body m-2 table-responsive-lg">
					<table class="table table-light table-hover align text-center">
						<thead class="fs-5">
							<tr>
								<th scope="col">Area of Exam</th>
								<th scope="col">Prepared By</th>
								<th scope="col">Total of Items</th>
								<th scope="col">Time Limit</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php

							$code = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question,accounts WHERE (accounts.acc_id = tbl_pre_question.prepared_by) AND Approval='approve'");

							if (mysqli_num_rows($code) == 0) {

								echo "<tr class='table-danger'>
                                        <td></td>
                                        <td></td>
                                        <td class='text-center'>No records has been added </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>";
							}
							elseif (mysqli_num_rows($code)> 0) {

								while ($rows = mysqli_fetch_assoc($code)) {

								$boast = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question WHERE pre_exam_id = '{$rows['pre_exam_id']}' AND Approval='approve'");

								$shine = mysqli_fetch_array($boast);
								?>
							
							<tr>
								<td><?php echo $rows['subjects']; ?></td>
								<td><?php echo $rows['first_name'] ." ".$rows['last_name']; ?></td>
								<td><?php echo $rows['total_question']; ?></td>
								<td><?php echo $rows['time_limit'] /60 ; ?> mins</td>
								<td>

									<?php

									$board = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_marks_done WHERE acc_id='{$_SESSION['acc_id']}' AND pre_exam_id='{$rows['pre_exam_id']}'");

									$drove = mysqli_fetch_assoc($board);

									if (mysqli_num_rows($board) ==0) { ?>

										<button class="btn btn-success text-uppercase"><a href="#" data-id="<?php echo $rows['pre_exam_id'] ?>" class="text-white suc_code" data-bs-toggle="modal" style="text-decoration: none;"><i class='bx bxs-hourglass-top me-2'></i>Start</a></button>
									
									<?php
									}
									elseif ($drove['acc_id']==$_SESSION['acc_id'] AND $drove['pre_exam_id']==$shine['pre_exam_id']) { ?>

										<button type="button" class="btn btn-secondary badge px-2 py-2 " style="font-size:15px;" disabled=""><i class="fas fa-check-circle me-2"></i>Done</button>

									<?php
									}
									?>
								</td>
							</tr>
							<?php } } ?>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- Access code Modal-->
	<div class="modal fade" id="access" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column ">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <h4 class="modal-title mx-3 mt-3 fw-bold">Access code</h4>
                <div class="modal-body">
                	<div class="pre">
                		
                	</div>
                </div>
            </div>
        </div>
    </div>

  

	
</body>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/dt-1.10.25datatables.min.js"></script>
<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function(){
  window.addEventListener('scroll', function() {
      if (window.scrollY > 50) {
        document.getElementById('navbar-top').classList.add('fixed-top');
        // add padding top to show content behind navbar
        navbar_height = document.querySelector('.navbar').offsetHeight;
        document.body.style.paddingTop = navbar_height + 'px';
      } else {
        document.getElementById('navbar-top').classList.remove('fixed-top');
         // remove padding top from body
        document.body.style.paddingTop = '0';
      } 
  });
}); 
</script>

 <!-- preview modal --->
 <script type="text/javascript">

   $(document).ready(function(){
    $('.suc_code').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: 'preboard_marks.php',
        type: 'post',
        data: {userid: userid},
        success: function(response){
          $('.pre').html(response);
          $('#access').modal('show');
        }
      });
    });
   });
 </script>

</html>