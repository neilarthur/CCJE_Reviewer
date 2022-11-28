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
	<title>Take Quiz</title>
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
<body  style="background-color: rgb(229, 229, 229);">
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
   	 	<div class="card" style="background-color: #8C0000;;">
   	 		<div class="card-body">
   	 			<h2 class="text-white fw-bold text-uppercase">Quiz and Long Quiz</h2>
   	 		</div>
   	 	</div>
   	 	<div class="card h-100">
  			<div class="card-body m-3 table-responsive-lg">
  				<table class="table bg-light" width="100%">
  					<thead class="fs-5 text-center">
  						<tr>
  							<th scope="col">Title</th>
  							<th scope="col">Area of Exam</th>
  							<th scope="col">Difficulty</th>
  							<th scope="col">Total of Items</th>
  							<th scope="col">Time Limit</th>
  							<th scope="col">Prepared by</th>
  							<th scope="col">Action</th>
  						</tr>
  					</thead>
  					<tbody class="text-center">
  						<?php

  						$based = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");

  						while ($course = mysqli_fetch_assoc($based)) {
  						 	
  						 	if ($course['section'] == '4A') {
  						 		
  						 		$query = mysqli_query($sqlcon,"SELECT * FROM accounts, choose_question WHERE (accounts.acc_id=choose_question.prepared_by) AND (choose_question.status='active') AND (choose_question.section ='4A')");


  						 		if (mysqli_num_rows($query) ==0) { ?>
  						 			
  						 			<tr class="table-danger">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">No records has been added </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
  						 		<?php
  						 		}elseif (mysqli_num_rows($query)>0) {
  						 			
  						 			while ($rows = mysqli_fetch_assoc($query)) {


	  									$fort = mysqli_query($sqlcon,"SELECT * FROM choose_question WHERE test_id = '{$rows['test_id']}'");

	  									$sight = mysqli_fetch_array($fort); ?>

	  									<tr>
	  										<td><?php echo $rows['quiz_title']; ?></td>
	  										<td><?php echo $rows['subject_name'];  ?></td>
	   	  									<td><?php echo $rows['question_difficulty'];  ?></td>
	   	  									<td><?php echo $rows['total_quest']; ?></td>
	   	  									<td><?php echo $rows['time_limit']/60;  ?> mins</td>
	   	  									<td><?php echo $rows['first_name']." ".$rows['last_name'];?></td>
	   	  									<td>
	   	  										<?php

	   	  										$datetime = date("Y-m-d");

	   	  										if ($rows['start_day'] >= $datetime && $rows['end_day'] <= $datetime) {
	   	  											
	   	  											echo '<span class="badge bg-danger" style="font-size:15px;">Close</span>';
	   	  										}
	   	  										else { 
	   	  										?>
	   	  										<form action="take_exam_status.php" method="POST">
	   	  											<input type="hidden" name="ddd" value="<?php echo $rows['time_limit']; ?>">

	   	  											<input type="hidden" name="ccc" value="<?php echo $rows['test_id']; ?>">
	   	  											<input type="hidden" name="aaa" value="<?php echo $rows['total_quest']; ?>">
	   	  											<input type="hidden" name="coders" value="<?php echo $_SESSION['acc_id']; ?>">

	   	  											

	   	  											<?php

	   	  											$boast = mysqli_query($sqlcon,"SELECT * FROM tbl_marks_done WHERE acc_id = '{$_SESSION['acc_id']}' AND test_id = '{$rows['test_id']}'");

	   	  											$laws = mysqli_fetch_assoc($boast);

	   	  											if (mysqli_num_rows($boast) ==0) { ?>

	   	  												<button  type="submit" name="submits" class="btn btn-success"><i class="fas fa-hourglass-start me-2"></i>Start</button>

	   	  											<?php
	   	  											}
	   	  											
	   	  											elseif ($laws['acc_id'] == $_SESSION['acc_id'] AND $laws['test_id'] == $sight['test_id']) { ?>

	   	  													<button type="submit" class="btn btn-secondary" disabled=""><i class="fas fa-check-circle me-2"></i>Done</button>
	   	  												<?php
	   	  												}
	   	  											
	   	  											?>


	   	  										</form>
	   	  									<?php 
	   	  									}
	   	  									?>
	   	  									</td>
	  									</tr>
	  									<?php
  						 			}
  						 		}
  						 	}elseif ($course['section'] == '4B') {

  						 		$query = mysqli_query($sqlcon,"SELECT * FROM accounts, choose_question WHERE (accounts.acc_id=choose_question.prepared_by) AND (choose_question.status='active') AND (choose_question.section ='4B')");

  						 		if (mysqli_num_rows($query) ==0) { ?>

  						 			<tr class="table-danger">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">No records has been added </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
  						 		<?php
  						 		}elseif (mysqli_num_rows($query)>0) {
  						 			
  						 			while ($rows = mysqli_fetch_assoc($query)) {

	  									$fort = mysqli_query($sqlcon,"SELECT * FROM choose_question WHERE test_id = '{$rows['test_id']}'");

	  									$sight = mysqli_fetch_array($fort); ?>

	  									<tr>
	  										<td><?php echo $rows['quiz_title']; ?></td>
	  										<td><?php echo $rows['subject_name'];  ?></td>
	   	  									<td><?php echo $rows['question_difficulty'];  ?></td>
	   	  									<td><?php echo $rows['total_quest']; ?></td>
	   	  									<td><?php echo $rows['time_limit']/60;  ?> mins</td>
	   	  									<td><?php echo $rows['first_name']." ".$rows['last_name'];?></td>
	   	  									<td>
	   	  										<?php

	   	  										$datetime = date("Y-m-d");

	   	  										if ($rows['start_day'] >= $datetime && $rows['end_day'] <= $datetime) {
	   	  											
	   	  											echo '<span class="badge bg-danger" style="font-size:15px;">Close</span>';
	   	  										}
	   	  										else { 
	   	  										?>
	   	  										<form action="take_exam_status.php" method="POST">
	   	  											<input type="hidden" name="ddd" value="<?php echo $rows['time_limit']; ?>">
	   	  											<input type="hidden" name="bbb" value="<?php echo $rows['passing_rate']; ?>">

	   	  											<input type="hidden" name="ccc" value="<?php echo $rows['test_id']; ?>">
	   	  											<input type="hidden" name="aaa" value="<?php echo $rows['total_quest']; ?>">
	   	  											<input type="hidden" name="coders" value="<?php echo $_SESSION['acc_id']; ?>">

	   	  											

	   	  											<?php

	   	  											$boast = mysqli_query($sqlcon,"SELECT * FROM tbl_marks_done WHERE acc_id = '{$_SESSION['acc_id']}' AND test_id = '{$rows['test_id']}'");

	   	  											$laws = mysqli_fetch_assoc($boast);

	   	  											if (mysqli_num_rows($boast) ==0) { ?>

	   	  												<button  type="submit" name="submits" class="btn btn-success"><i class="fas fa-hourglass-start me-2"></i>Start</button>

	   	  											<?php
	   	  											}
	   	  											
	   	  												
	   	  											elseif ($laws['acc_id'] == $_SESSION['acc_id'] AND $laws['test_id'] == $sight['test_id']) { ?>

	   	  													<button type="submit" class="btn btn-secondary" disabled=""><i class="fas fa-check-circle me-2"></i>Done</button>
	   	  												<?php
	   	  												}
	   	  											?>
	   	  										</form>
	   	  										<?php
	   	  										} 
	   	  										?>
	   	  									</td>
	  									</tr>
	  								<?php
  						 			}
  						 		}
  						 	}elseif ($course['section']=='4C') {

  						 		
  						 		$query = mysqli_query($sqlcon,"SELECT * FROM accounts, choose_question WHERE (accounts.acc_id=choose_question.prepared_by) AND (choose_question.status='active') AND (choose_question.section ='4C') AND (stat_question='Ready')");

  						 		if (mysqli_num_rows($query) ==0) { ?>

  						 			<tr class="table-danger">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">No records has been added </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
  						 		<?php
  						 		}elseif (mysqli_num_rows($query)>0) {
  						 			
  						 			while ($rows = mysqli_fetch_assoc($query)) {

	  									$fort = mysqli_query($sqlcon,"SELECT * FROM choose_question WHERE test_id = '{$rows['test_id']}'");

	  									$sight = mysqli_fetch_array($fort); ?>

	  									<tr>
	  										<td><?php echo $rows['quiz_title']; ?></td>
	  										<td><?php echo $rows['subject_name'];  ?></td>
	   	  									<td><?php echo $rows['question_difficulty'];  ?></td>
	   	  									<td><?php echo $rows['total_quest']; ?></td>
	   	  									<td><?php echo $rows['time_limit']/60;  ?> mins</td>
	   	  									<td><?php echo $rows['first_name']." ".$rows['last_name'];?></td>
	   	  									<td>
	   	  										<?php

	   	  										$datetime = date("Y-m-d");

	   	  										if ($rows['start_day'] >= $datetime && $rows['end_day'] <= $datetime) {
	   	  											
	   	  											echo '<span class="badge bg-danger" style="font-size:15px;">Close</span>';
	   	  										}
	   	  										else { 
	   	  											?>
	   	  											<form action="take_exam_status.php" method="POST">
	   	  												<!-- ddd-->
	   	  												<input type="hidden" name="time" value="<?php echo $rows['time_limit']; ?>">
	   	  												<!-- ccc -->
	   	  												<input type="hidden" name="test" value="<?php echo $rows['test_id']; ?>">
	   	  												<!-- aaa -->
	   	  												<input type="hidden" name="t_quest" value="<?php echo $rows['total_quest']; ?>">
	   	  												<input type="hidden" name="acc" value="<?php echo $_SESSION['acc_id']; ?>">
	   	  											<?php

	   	  											$boast = mysqli_query($sqlcon,"SELECT * FROM tbl_marks_done WHERE acc_id = '{$_SESSION['acc_id']}' AND test_id = '{$rows['test_id']}'");

	   	  											$laws = mysqli_fetch_assoc($boast);

	   	  											if (mysqli_num_rows($boast) ==0) { ?>

	   	  												<button  type="submit" name="submits" class="btn btn-success"><i class="fas fa-hourglass-start me-2"></i>Start</button>

	   	  											<?php
	   	  											}
	   	  											
	   	  												
	   	  											elseif ($laws['acc_id'] == $_SESSION['acc_id'] AND $laws['test_id'] == $sight['test_id']) { ?>

	   	  													<button type="submit" class="btn btn-secondary" disabled=""><i class="fas fa-check-circle me-2"></i>Done</button>
	   	  												<?php
	   	  												}
	   	  											?>
	   	  										</form>
	   	  										<?php
	   	  										}
	   	  										?>
	   	  										
	   	  									</td>
	  									</tr>
	  								<?php
  						 			}
  						 		}
  						 	}
  						} 
  						?>
   	  				</tbody>
   	  			</table>
   	  		</div>
		</div>
	</div>
</div>

</body>
<script src="../js/bootstrap.bundle.min.js"></script>
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
</html>