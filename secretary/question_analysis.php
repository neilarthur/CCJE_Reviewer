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
                     	echo '
                     						<div class="profile-content">
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
									<li class="breadcrumb-item"><a href="analytics.php" style="text-decoration: none;">Examination Analysis</a></li>
									<li class="breadcrumb-item active" aria-current="page">Examination summary</li>
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
								<h2 class="text-dark text-start ps-3 fw-bold mt-4 ms-2">Examination Summary</h2>
							</div>
						</div>
					    <div class="row">
							<div class="col-lg-7">
								<div class="card h-100 w-100 mb-1">
									<div class="card-body rounded-3 m-3 table-responsive-lg">
										<h5 class="card-title fw-bold text-uppercase">Difficulty</h5>
										<p class="mb-3">Indicates the percentage of students who answered questions correctly.</p>

										<?php

										$results=0;

										$easy_quest = mysqli_query($sqlcon,"SELECT * FROM test_question,tbl_pre_student_ans WHERE (test_question.question_id=tbl_pre_student_ans.question_id) AND test_question.subject_name='{$_GET['area']}' AND test_question.level_difficulty='Easy' AND tbl_pre_student_ans.pre_exam_id='{$_GET['id']}'");

										$total_raw = mysqli_num_rows($easy_quest);



										while (list($question_id,$subject_name,$level_difficulty,$questions_title,$option_a,$option_b,$option_c,$option_d,$correct_ans,$acc_id,$status,$date_created,$student_ans_id,$exam_check) = mysqli_fetch_row($easy_quest)) {
											
											if ($correct_ans == $exam_check) {
												
												$results++;

												
											}
										}

										if ($total_raw == 0) {
											
											$total_raw=1;

											$percent = round(($results/$total_raw)*100);

											echo '<p>Easy ('.$percent.'%)</p>
											<div class="progress mb-2">
												<div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width:'.$percent.'%;" aria-valuenow="'. $percent.'" aria-valuemin="0" aria-valuemax="100">
												</div>
											</div>';

										}else {

											$percent = round(($results/$total_raw)*100);

											if ($percent >=40) {

												$progress_bars = 'bg-success';
											}
											elseif ($percent >25 && $percent < 40) {
												
												$progress_bars = 'bg-warning';
											}
											else {

												$progress_bars = 'bg-danger';
											}

											echo '<p>Easy ('.$percent.'%)</p>
											<div class="progress mb-2">
												<div class="progress-bar progress-bar-striped bg-success " role="progressbar" style="width:'.$percent.'%;" aria-valuenow="'. $percent.'" aria-valuemin="0" aria-valuemax="100">
												</div>
											</div>';

										}

										

										
										?>

										<?php

										$correct=0;

										$easy_quest2 = mysqli_query($sqlcon,"SELECT * FROM test_question,tbl_pre_student_ans WHERE (test_question.question_id=tbl_pre_student_ans.question_id) AND test_question.subject_name='{$_GET['area']}' AND test_question.level_difficulty='Moderate' AND tbl_pre_student_ans.pre_exam_id='{$_GET['id']}'");

										$total_rows = mysqli_num_rows($easy_quest2);



										while (list($question_id,$subject_name,$level_difficulty,$questions_title,$option_a,$option_b,$option_c,$option_d,$correct_answer,$acc_id,$status,$date_created,$student_ans_id,$exam_checks) = mysqli_fetch_row($easy_quest2)) {
											
											if ($correct_answer == $exam_checks) {
												
												$correct++;

												
											}
										}

										if ($total_rows==0) {
											
											$total_rows=1;

											$percents = round(($correct/$total_rows)*100);

											
											echo '<p>Moderate ('.$percents.'%)</p>
											<div class="progress mb-2">
												<div class="progress-bar progress-bar-striped bg-warning " role="progressbar" style="width:'.$percents.'%;" aria-valuenow="'. $percents.'" aria-valuemin="0" aria-valuemax="100">
												</div>
											</div>';

										}else {

											$percents = round(($correct/$total_rows)*100);

											

											echo '<p>Moderate ('.$percents.'%)</p>
											<div class="progress mb-2">
												<div class="progress-bar progress-bar-striped bg-warning " role="progressbar" style="width:'.$percents.'%;" aria-valuenow="'. $percents.'" aria-valuemin="0" aria-valuemax="100">
												</div>
											</div>';
										}

										
										?>

										<?php

										$correct_res=0;

										$easy_quest3 = mysqli_query($sqlcon,"SELECT * FROM test_question,tbl_pre_student_ans WHERE (test_question.question_id=tbl_pre_student_ans.question_id) AND test_question.subject_name='{$_GET['area']}' AND test_question.level_difficulty='Hard' AND tbl_pre_student_ans.pre_exam_id='{$_GET['id']}'");

										$total_laws = mysqli_num_rows($easy_quest3);



										while (list($question_id,$subject_name,$level_difficulty,$questions_title,$option_a,$option_b,$option_c,$option_d,$correct_answerss,$acc_id,$status,$date_created,$student_ans_id,$exam_checkss) = mysqli_fetch_row($easy_quest3)) {
											
											if ($correct_answerss == $exam_checkss) {
												
												$correct_res++;

												
											}
										}

										if ($total_laws ==0) {
											
											$total_laws =1;

											$percentage = round(($correct_res/$total_laws)*100);


											echo '<p>Hard ('.$percentage.'%)</p>
											<div class="progress mb-2">
												<div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width:'.$percentage.'%;" aria-valuenow="'. $percentage.'" aria-valuemin="0" aria-valuemax="100">
												</div>
											</div>';
										}
										else {

											$percentage = round(($correct_res/$total_laws)*100);

											echo '<p>Hard ('.$percentage.'%)</p>
											<div class="progress mb-2">
												<div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width:'.$percentage.'%;" aria-valuenow="'. $percentage.'" aria-valuemin="0" aria-valuemax="100">
												</div>
											</div>';
										}
										
										?>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-5">
	                        	<div class="card mb-2" style="height :49%">
	                        		<div class="card-body">
	                        			<div class="row no-gutters align-items-center">
	                        				<div class="col mr-2">
	                        					<div class="text-xs font-weight-bold text-dark text-uppercase mb-2">
	                        						Possible Questions
	                        						<?php
	                        						$id = $_GET['id'];

												    $quest = mysqli_query($sqlcon,"SELECT * FROM test_question,tbl_pre_choose_quest,tbl_pre_question WHERE (tbl_pre_choose_quest.question_id =test_question.question_id) AND (tbl_pre_choose_quest.pre_exam_id=tbl_pre_question.pre_exam_id) AND tbl_pre_choose_quest.pre_exam_id ='$id' " );

												    $rows =mysqli_num_rows($quest);

	                        						echo '<h1  class="mb-0 fw-bold mt-2"><b>'.$rows.' </b></h1>';
	                        						?>
	                        					</div>
	                        				</div>
			                                <div class="col-auto">
			                                     <span class="fa-stack fa-2x me-4 mt-4">
			                                     	<i class="far fa-question-circle fa-stack-1x fa-2x ms-3  text-primary"></i>
			                                    </span>                                        
			                                </div>
			                            </div>
	                        		</div>
	                        	</div>
	                        	<div class="card mb-2" style="height :49%">
	                        		<div class="card-body">
	                        			<div class="row no-gutters align-items-center">
	                        				<div class="col mr-2">
	                        					<div class="text-xs font-weight-bold text-dark text-uppercase mb-2">
	                        						Completed Attempts

	                        						<?php

	                        						$attp = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_marks_done WHERE pre_exam_id = '{$_GET['id']}'");

	                        						$row_count = mysqli_num_rows($attp);
	                        						?>
	                        						<h1  class="mb-0 mt-2"><b><?php echo $row_count; ?></b></h1>
	                        					</div>
	                        				</div>
			                                <div class="col-auto">
			                                     <span class="fa-stack fa-2x me-4 mt-4">
			                                     	<i class="fas fa-check-circle  fa-stack-1x fa-2x ms-3 text-success"></i>
			                                    </span>                                        
			                                </div>
			                            </div>
	                        		</div>
	                        	</div>
	                        </div>
	                    </div> 
	                </div>
	                <div class="row">
	                	<div class="col py-3" style="padding-right: 35px;">
	                		<div class="card">
	                			<div class="card-body">
	                				<div class="table-responsive-lg">
	                					<table class="table table-hover align-middle" id="resultTab">
											<thead>
												<tr>
													<th scope="col">No.</th>
													<th scope="col">Question</th>
													<th scope="col">Graded attempts</th>
													<th scope="col">Not yet answered</th>
													<th scope="col">Percentage</th>
													<th scope="col" style="text-align: center;">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$id = $_GET['id'];

												$quest = mysqli_query($sqlcon,"SELECT * FROM test_question,tbl_pre_choose_quest WHERE (tbl_pre_choose_quest.question_id =test_question.question_id) AND tbl_pre_choose_quest.pre_exam_id ='$id' " );

												$quested = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE role='student'" );

												$attp = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_marks_done WHERE pre_exam_id = '{$_GET['id']}'");
												$row_count = mysqli_num_rows($attp);

												$rows_boast = mysqli_num_rows($quested);

												$count =1;
												while ($rows= mysqli_fetch_array($quest)) {

													$correct = 0;

													$view2 = mysqli_query($sqlcon,"SELECT * FROM test_question,tbl_pre_student_ans WHERE (test_question.question_id=tbl_pre_student_ans.question_id) AND (tbl_pre_student_ans.pre_exam_id='{$_GET['id']}') AND test_question.question_id='{$rows['question_id']}'");


													while (list($question_id,$subject_name,$level_difficulty,$questions_title,$option_a,$option_b,$option_c,$option_d,$correct_ans,$acc_id,$status,$date_created,$student_ans_id,$exam_check) = mysqli_fetch_row($view2)) {

														if ($correct_ans == $exam_check) {

															$correct++;
														}
													}
												 ?>
												<tr>
													<td><?php echo $count; ?></td>
	                                                <td><?php echo $rows['questions_title']; ?></td>
	                                                <td><?php echo $row_count; ?></td>
	                                                <td>
	                                                	<?php

	                                                	$counted = $rows_boast - $row_count;

	                                                	echo $counted;

	                                                	?>
	                                                </td>
	                                                <td><?php

	                                                $perc = mysqli_num_rows($attp);

	                                                if ($perc == 0) {
	                                                	
	                                                	$perc=1;

	                                                	echo round(($correct/$perc)*100)." % ";
	                                                }
	                                                elseif ($perc >0) {
	                                                	
	                                                	echo round(($correct/$perc)*100)." % ";

	                                                }
	                                                 ?> </td>
	                                                <td>
	                                                	<div class="d-flex flex-row">
	                                                		<?php

	                                                		$qwertyu = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_student_ans WHERE pre_exam_id='$id'");

	                                                		$num_law = mysqli_num_rows($qwertyu);

	                                                		if ($num_law == 0) {
	                                                			
	                                                			echo '<button type="button"class="btn btn-secondary  mx-2"><i class="fas fa-eye"></i></button>';
	                                                		}
	                                                		else {

	                                                			echo '<button data-id="'.$rows['question_id'].'" type="button"class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>';
	                                                		}
	                                                		?>
	                                                		
	                                                	</div>
	                                                </td>
	                                            </tr>
	                                        <?php $count ++; } ?>
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
	    <!--Question analysis Modal -->
		<div class="modal fade" id="viewToggle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<!-- preview modal --->
 <script type="text/javascript">

   $(document).ready(function(){
    $('.view_btn').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: '../php/view_analysis.php?id=<?php echo $_GET['id']; ?>',
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
  	 $('#resultTab').DataTable({
  	 	paging: true
  	 });
  });
</script>
<script type="text/javascript">
 	fileimg.onchange = evt => {
 		const [file] = fileimg.files;
 		if (file) {
 			img.src = URL.createObjectURL(file);

 		}
 	}
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