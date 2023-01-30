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
	<title>Dashboard</title>
	<!-- Boostrap 5.2 -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/home.css">
	<!-- Box Icons-->
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<!-- Font Awesome-->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
	<!-- JS Chart-->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- System Logo -->
    <link rel="icon" href="../assets/pics/system-ico.ico">
    <style>
       .dp .dropdown-toggle::after {
            content: none;
        }
        .dp .dropdown-list{
            left: -90px;
        }
         .navbar .breadcrumb li a{
          color: #8C0000;
        }
        .my-custom-scrollbar {
        position: relative;
        height: 450px;
        overflow: auto;
        }
        .table-wrapper-scroll-y {
        display: block;
        }
    </style>

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
                <div class="flex-shrink-0 text-center">
                     <div class="dropdown dp">
                        <a class="text-reset dropdown-toggle text-decoration-none" href="#"id="navbarDropdownMenuLink" role="button"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell fa-lg"></i>
                            <?php 

                            $comers = mysqli_query($sqlcon,"SELECT * FROM tbl_notification  WHERE notif_status='0' AND action='Posted an Quiz'  ORDER BY notif_id DESC");
                            ?>
                            <span class=" top-0 start-100 translate-middle badge rounded-pill badge-notification bg-danger"><?php echo mysqli_num_rows($comers); ?></span>
                        </a>
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="border-radius: 10px;">
                            <h6 class="dropdown-header text-dark ">Notifications</h6>
                            <?php

                                $comers = mysqli_query($sqlcon,"SELECT * FROM tbl_notification,accounts WHERE (tbl_notification.acc_id = accounts.acc_id) AND (accounts.role='faculty') AND (tbl_notification.action='Posted an Quiz')");

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
                </div>
				<div class="flex-shrink-0 dropdown pe-5 text-center">
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
	<!-- Main content-->
    <div class="container-fluid mt-3 pb-5">
        <div class="row mx-4 ">
        	<div class="col-lg-3 col-xs-6">
        		<div class="card border-0" style="background-color: #FFA701;" >
        			<div class="card-body">
        				<div class="row">
        					<div class="col mr-2">
        						<div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    <?php

                                    $based = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");

                                    while ($course = mysqli_fetch_assoc($based)) {
                                        if ($course['section'] == '4A') {
                                             $query =  mysqli_query($sqlcon,"SELECT * FROM accounts, choose_question WHERE (accounts.acc_id=choose_question.prepared_by) AND (choose_question.status='active') AND (choose_question.section ='4A') AND(choose_question.type_test='Quiz') AND (choose_question.stat_question='Ready')");

                                            $row = mysqli_num_rows($query);
                                            echo'<h1  class="mb-2 fw-bold"><b>'.$row.' </b></h1>';
                                        }
                                        elseif ($course['section'] == '4B') {
                                             $query =  mysqli_query($sqlcon,"SELECT * FROM accounts, choose_question WHERE (accounts.acc_id=choose_question.prepared_by) AND (choose_question.status='active') AND (choose_question.section ='4B') AND(choose_question.type_test='Quiz') AND (choose_question.stat_question='Ready')");
                                             

                                             $row = mysqli_num_rows($query);
                                             echo'<h1  class="mb-2 fw-bold"><b>'.$row.' </b></h1>';
                                        }
                                        elseif ($course['section'] == '4C') {
                                              $query =  mysqli_query($sqlcon,"SELECT * FROM accounts, choose_question WHERE (accounts.acc_id=choose_question.prepared_by) AND (choose_question.status='active') AND (choose_question.section ='4C') AND(choose_question.type_test='Quiz') AND (choose_question.stat_question='Ready')");
                                             

                                             $row = mysqli_num_rows($query);
                                             echo'<h1  class="mb-2 fw-bold"><b>'.$row.' </b></h1>';
                                        }
                                    }

                                    ?> Quiz
        						</div>
        					</div>
        					<div class="col-auto mt-2" style="color: #FFD300;">
        						<i class="fa-solid fa-note-sticky fa-4x"></i>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        	<div class="col-lg-3 col-xs-6">
        		<div class="card border-0 bg-primary" >
        			<div class="card-body">
        				<div class="row no-gutters align-items-center">
        					<div class="col mr-2">
        						<div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    <?php 
                                    $based = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");
                                    while ($course = mysqli_fetch_assoc($based)) {
                                        if ($course['section'] == '4A') {
                                            $query =  mysqli_query($sqlcon,"SELECT * FROM accounts, choose_question WHERE (accounts.acc_id=choose_question.prepared_by) AND (choose_question.status='active') AND (choose_question.section ='4A') AND(choose_question.type_test='LongQuiz') AND (choose_question.stat_question='Ready')");
                                             $row = mysqli_num_rows($query);
                                             echo'<h1  class="mb-2 fw-bold"><b>'.$row.' </b></h1>';
                                        }
                                        elseif ($course['section'] == '4B') {
                                            $query =  mysqli_query($sqlcon,"SELECT * FROM accounts, choose_question WHERE (accounts.acc_id=choose_question.prepared_by) AND (choose_question.status='active') AND (choose_question.section ='4B') AND(choose_question.type_test='LongQuiz') AND (choose_question.stat_question='Ready')");
                                             $row = mysqli_num_rows($query);
                                             echo'<h1  class="mb-2 fw-bold"><b>'.$row.' </b></h1>';
                                        }
                                        elseif ($course['section'] == '4C') {
                                            $query =  mysqli_query($sqlcon,"SELECT * FROM accounts, choose_question WHERE (accounts.acc_id=choose_question.prepared_by) AND (choose_question.status='active') AND (choose_question.section ='4C') AND(choose_question.type_test='LongQuiz') AND (choose_question.stat_question='Ready')");
                                             $row = mysqli_num_rows($query);
                                             echo'<h1  class="mb-2 fw-bold"><b>'.$row.' </b></h1>';
                                        }
                                    }
                                    
                                   ?>
                                    Long Quiz
        						</div>
        					</div>
        					<div class="col-auto mt-2" style="color: rgb(0, 76, 122);">
        						<i class="fa-solid fa-list-check fa-4x"></i>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        	<div class="col-lg-3 col-xs-6">
        		<div class="card border-0 bg-danger"  >
        			<div class="card-body">
        				<div class="row no-gutters align-items-center">
        					<div class="col mr-2">
        						<div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    <?php $query = "SELECT * FROM tbl_pre_question,accounts WHERE (accounts.acc_id= '{$_SESSION['acc_id']}') AND(tbl_pre_question.pre_board_status='active') AND(tbl_pre_question.Approval='approve') AND(tbl_pre_question.stat_exam='Ready')";
                                        $query_result = mysqli_query($sqlcon,$query);

                                        $row = mysqli_num_rows($query_result);
                                        echo'<h1  class=" mb-2 fw-bold"><b>'.$row.' </b></h1>';
                                        ?>
        							Preboard Exam
        						</div>
        					</div>
        					<div class="col-auto mt-2" style="color: rgb(91, 6, 22);">
        						<i class="fa-solid fa-table-list fa-4x"></i>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        	<div class="col-lg-3 col-xs-6">
        		<div class="card border-0" style="background-color: rgb(0, 166, 90);" >
        			<div class="card-body">
        				<div class="row no-gutters align-items-center">
        					<div class="col mr-2">
        						<div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    <?php $query = "SELECT * FROM tbl_quiz_result,accounts,choose_question WHERE (tbl_quiz_result.acc_id=accounts.acc_id) AND (choose_question.test_id = tbl_quiz_result.test_id) AND (accounts.acc_id= '{$_SESSION['acc_id']}')";
                                        $query_result = mysqli_query($sqlcon,$query);

                                        $row = mysqli_num_rows($query_result);
                                        echo'<h1  class=" mb-2 fw-bold"><b>'.$row.' </b></h1>';
                                        ?>
        							Quiz Results
        						</div>
        					</div>
        					<div class="col-auto mt-2" style="color: #4dc656;);">
        						<i class="fa-solid fa-chart-column fa-4x"></i>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
        <div class="row mx-4 mt-4">
             <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <p  class="fw-bold text-primary h3">Upcoming</p>
                    </div>
                    <div class="card-body p-3">
                        <table class="table table-hover table-light">
                            <thead>
                            </thead>
                            <tbody>
                            <?php

                            $date = date('d-m-y h:i:s a');

                            $acc = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");

                            while ($upcoming= mysqli_fetch_assoc($acc)) {
                                if ($upcoming ['section'] == '4C') {


                                    $done = mysqli_query($sqlcon,"SELECT * FROM tbl_marks_done,choose_question,accounts WHERE(tbl_marks_done.test_id=choose_question.test_id) AND(accounts.acc_id=tbl_marks_done.acc_id) AND accounts.acc_id = '{$_SESSION['acc_id']}'");

                                    if (mysqli_num_rows($done) >0) {
                                        
                                        echo '<tr>
                                            <a href="">
                                                <td class="text-capitalize"><b class="me-1">No Upcomming Schedule 1</b></td>
                                            </a>
                                        </tr> ';
                                    }
                                    elseif (mysqli_num_rows($done) == 0) {

                                        $quiz1cs = mysqli_query($sqlcon,"SELECT * FROM accounts,choose_question WHERE  (choose_question.prepared_by = accounts.acc_id) AND (choose_question.section='4C')");

                                        while ($quiz_query = mysqli_fetch_assoc($quiz1cs)) {

                                            $date1 = date('d-m-y g:i a ', strtotime($quiz_query['end_day']));


                                            if ($date1 >= $date) {


                                            }
                                            else {

                                                echo '<tr>
                                            <a href="">
                                                <td class="text-capitalize"><b class="me-1">'.$quiz_query['quiz_title'].'</b>&nbsp;'.$quiz_query['subject_name'].'</td>
                                                <td class="">'.$date1.'</td>
                                            </a>
                                        </tr> ';
                                            }
                                            
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
            <div class="col-lg-8">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title text-dark fw-bold">Quiz Percentage</h4>
                        <canvas id="mychart" style="height: 350px; width: 100%;" ></canvas>
                        
                         <?php 

                         $quiz_run = mysqli_query($sqlcon,"SELECT * FROM choose_question,tbl_quiz_result,accounts WHERE (tbl_quiz_result.acc_id=accounts.acc_id) AND (choose_question.test_id = tbl_quiz_result.test_id) AND (accounts.acc_id= '{$_SESSION['acc_id']}')");

                         // Criminal Jurisprudence//

                         $query = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_quiz_result, choose_question,accounts WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Criminal Jurisprudence') AND (tbl_quiz_result.acc_id= accounts.acc_id) AND (accounts.acc_id= '{$_SESSION['acc_id']}')");

                         $fetch = mysqli_query($sqlcon,"SELECT * FROM tbl_quiz_result, choose_question,accounts WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Criminal Jurisprudence') AND (tbl_quiz_result.acc_id= accounts.acc_id) AND(accounts.acc_id= '{$_SESSION['acc_id']}')");

                         $percent = mysqli_num_rows($fetch);

                          // Crime Detection and Investigation//
                         $query1 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_quiz_result, choose_question,accounts WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Crime Detection and Investigation') AND (tbl_quiz_result.acc_id= accounts.acc_id) AND(accounts.acc_id= '{$_SESSION['acc_id']}')");

                         $fetch1 = mysqli_query($sqlcon,"SELECT * FROM tbl_quiz_result, choose_question,accounts WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Crime Detection and Investigation') AND (tbl_quiz_result.acc_id= accounts.acc_id) AND(accounts.acc_id= '{$_SESSION['acc_id']}')");
                         $percent1 = mysqli_num_rows($fetch1);

                          // Law enforcement //

                         $query2 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_quiz_result, choose_question,accounts WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Law Enforcement') AND (tbl_quiz_result.acc_id= accounts.acc_id) AND(accounts.acc_id= '{$_SESSION['acc_id']}')");

                         $fetch2 = mysqli_query($sqlcon,"SELECT * FROM tbl_quiz_result, choose_question,accounts WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Law Enforcement') AND(tbl_quiz_result.acc_id= accounts.acc_id) AND(accounts.acc_id= '{$_SESSION['acc_id']}')");
                         $percent2 = mysqli_num_rows($fetch2);

                         // Criminalistics //
                         $query3 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_quiz_result, choose_question,accounts WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Criminalistics')AND (tbl_quiz_result.acc_id= accounts.acc_id) AND(accounts.acc_id= '{$_SESSION['acc_id']}')");

                         $fetch3 = mysqli_query($sqlcon,"SELECT * FROM tbl_quiz_result, choose_question,accounts WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Criminalistics') AND (tbl_quiz_result.acc_id= accounts.acc_id) AND(accounts.acc_id= '{$_SESSION['acc_id']}')");
                         $percent3 = mysqli_num_rows($fetch3);

                         // Criminal Sociology //
                         $query4 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_quiz_result, choose_question,accounts WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Criminal Sociology')AND (tbl_quiz_result.acc_id= accounts.acc_id) AND(accounts.acc_id= '{$_SESSION['acc_id']}')");

                         $fetch4 = mysqli_query($sqlcon,"SELECT * FROM tbl_quiz_result, choose_question,accounts WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Criminal Sociology') AND (tbl_quiz_result.acc_id= accounts.acc_id) AND(accounts.acc_id= '{$_SESSION['acc_id']}')");
                         $percent4 = mysqli_num_rows($fetch4);

                        // Correctional Administration //
                         $query5 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_quiz_result, choose_question,accounts WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Correctional Administration') AND (tbl_quiz_result.acc_id= accounts.acc_id) AND(accounts.acc_id= '{$_SESSION['acc_id']}')");

                         $fetch5 = mysqli_query($sqlcon,"SELECT * FROM tbl_quiz_result, choose_question,accounts WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Correctional Administration') AND (tbl_quiz_result.acc_id= accounts.acc_id) AND(accounts.acc_id= {$_SESSION['acc_id']})");

                         $percent5 = mysqli_num_rows($fetch5);


                         while ($baws = mysqli_fetch_assoc($quiz_run) AND $cows =mysqli_fetch_assoc($query)) {
                            if ($percent == 0) {
                                $percent =1;
                                $ave [] = round($cows['num'] / $percent);
                            }
                            else{
                                $ave [] = round($cows['num'] / $percent);
                            }
                         }
                         while ($cows1 =mysqli_fetch_assoc($query1)) {
                            if ($percent1 == 0) {
                                $percent1=1;
                                 $ave1[] = round($cows1['num'] /$percent1);
                            }
                            else{
                                $ave1[] = round($cows1['num'] /$percent1);
                            }
                         }
                         while ( $cows2 =mysqli_fetch_assoc($query2)) {
                             if ($percent2 == 0) {
                                $percent2 =1;
                                $ave2 [] = round($cows2['num'] / $percent2);
                            }
                            else{
                                $ave2 [] = round($cows2['num'] / $percent2);
                            }
                         }
                         while ($cows3 =mysqli_fetch_assoc($query3)) {
                            if ($percent3 == 0) {
                                $percent3 =1;
                                $ave3 [] = round($cows3['num'] / $percent3);
                            }
                            else{
                                $ave3 [] = round($cows3['num'] / $percent3); 
                            }
                         }
                         while ($cows4 =mysqli_fetch_assoc($query4)) {
                             if ($percent4 == 0) {
                                $percent4 =1;
                                $ave4 [] = round($cows4['num'] / $percent4);
                            }
                            else{
                                $ave4 [] = round($cows4['num'] / $percent4);
                            }
                         }
                         while ($cows5 =mysqli_fetch_assoc($query5) ) {
                            if  ($percent5 == 0) {
                                $percent5 =1;
                                $ave5 [] = round($cows5['num'] / $percent5);
                            }
                            else{
                                $ave5 [] = round($cows5['num'] / $percent5);
                            }
                         }

                        ?>
                       
                       <script>
                              const ctx = document.getElementById('mychart');

                              new Chart(ctx, {
                                type: 'bar',
                                data: {
                                  labels: ['Criminal Jurisprudence', 'Law Enforcement', 'Criminalistics','Crime Detection And Detection', 'Criminal Sociology', 'Correctional Administration'],
                                  datasets: [{
                                    label: "Score percentage",
                                    data:[<?php echo json_encode($ave) ?>,<?php echo json_encode($ave2) ?>, <?php echo json_encode($ave3) ?>,<?php echo json_encode($ave1) ?>, <?php echo json_encode($ave4) ?>,<?php echo json_encode($ave5) ?>],
                                    backgroundColor: [
                                      "#3e95cd", "#8e5ea2","#3cba9f","#775FEC","#FF6666","#FFAA00",
                                    ],
                                    borderWidth: 1
                                  }]
                                },
                                options: {
                                  scales: {
                                    y: {
                                        min: 0,
                                        max: 100,
                                        ticks: {
                                            stepSize: 20,
                                            callback: function(value, index, values) {
                                                return value + " %";
                                            }            
                                        }
                                    }
                                  }
                                }
                              });
                          </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-4 mt-4">
           <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <p class="fw-bold text-primary h3">My Status</p>
                    </div>
                    <div class="card-body " style="font-size: 18px;">
                        
                        <?php 
                        $based = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id = '{$_SESSION['acc_id']}'");
                        while ($course = mysqli_fetch_assoc($based)) {
                            if ($course['section'] == '4A') {
                                $query =  mysqli_query($sqlcon,"SELECT * FROM accounts, choose_question WHERE (accounts.acc_id=choose_question.prepared_by) AND (choose_question.status='active') AND (choose_question.section ='4A') AND (choose_question.stat_question='Ready')");
                                $row = mysqli_num_rows($query);
                                echo'<p class="fw-bold">Total of Quizzes: '.$row.'</p>';
                            }
                            elseif ($course['section'] == '4B') {
                                $query =  mysqli_query($sqlcon,"SELECT * FROM accounts, choose_question WHERE (accounts.acc_id=choose_question.prepared_by) AND (choose_question.status='active') AND (choose_question.section ='4B') AND (choose_question.stat_question='Ready')");
                                $row = mysqli_num_rows($query);
                                echo'<p class="fw-bold">Total of Quizzes: '.$row.'</p>';
                            }
                            elseif ($course['section'] == '4C') {
                                $query =  mysqli_query($sqlcon,"SELECT * FROM accounts, choose_question WHERE (accounts.acc_id=choose_question.prepared_by) AND (choose_question.status='active') AND (choose_question.section ='4C') AND (choose_question.stat_question='Ready')");
                                $row = mysqli_num_rows($query);
                                echo'<p class="fw-bold">Total of Quizzes: '.$row.'</p>';
                            }
                        }
                       
                        ?>
                        <hr>
                        <?php 

                        $query = mysqli_query($sqlcon,"SELECT * FROM tbl_quiz_result,choose_question,accounts WHERE (tbl_quiz_result.test_id =choose_question.test_id) AND (tbl_quiz_result.acc_id = accounts.acc_id) AND tbl_quiz_result.acc_id = '{$_SESSION['acc_id']}' ORDER BY ans_id DESC");

                            $row = mysqli_num_rows($query);
                            echo'<p class="fw-bold">Quiz taken: '.$row.'</p>';
                        ?>
                        <hr>

                         <?php
                         $best =mysqli_query($sqlcon,"SELECT MAX(score) as result FROM tbl_quiz_result,accounts,choose_question WHERE(accounts.acc_id=tbl_quiz_result.acc_id)AND(accounts.acc_id= '{$_SESSION['acc_id']}') AND(choose_question.test_id=tbl_quiz_result.test_id)");

                         $aws = mysqli_fetch_array($best);

                         $bow= $aws['result'];
                         $subject = mysqli_query($sqlcon,"SELECT * FROM choose_question,tbl_quiz_result,accounts WHERE(choose_question.test_id=tbl_quiz_result.test_id) AND(accounts.acc_id=tbl_quiz_result.acc_id) AND(accounts.acc_id= '{$_SESSION['acc_id']}') AND(tbl_quiz_result.score=$bow)");

                         if ($bow == 0) {
                             echo '<p class="fw-bold">Best score in Quiz: </p>';
                         }
                         elseif ($bow > 0) {
                             while ($heh= mysqli_fetch_assoc($subject)) {
                               echo '<p class="fw-bold">Best score in Quiz: '.$heh['subject_name'].'</p>';  
                             }
                         }


                        ?>
                        <hr>
                        <?php 
                        $best =mysqli_query($sqlcon,"SELECT MIN(score) as result FROM tbl_quiz_result,accounts,choose_question WHERE(accounts.acc_id=tbl_quiz_result.acc_id)AND(accounts.acc_id= '{$_SESSION['acc_id']}') AND(choose_question.test_id=tbl_quiz_result.test_id)");
                         $aws = mysqli_fetch_array($best);

                         $bow= $aws['result'];
                         $subject = mysqli_query($sqlcon,"SELECT * FROM choose_question,tbl_quiz_result,accounts WHERE(choose_question.test_id=tbl_quiz_result.test_id) AND(accounts.acc_id=tbl_quiz_result.acc_id) AND(accounts.acc_id= '{$_SESSION['acc_id']}') AND(tbl_quiz_result.score=$bow)");

                         
                         if ($bow == 0) {
                             echo '<p class="fw-bold">Lowest score in Quiz: </p>';
                         }
                         elseif ($bow > 0) {
                             while ($heh= mysqli_fetch_assoc($subject)) {
                               echo '<p class="fw-bold">Lowest score in Quiz: '.$heh['subject_name'].'</p>';  
                             }
                         }

                        ?>
                        <hr>
                        <?php
                         $query = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.acc_id= '{$_SESSION['acc_id']}') ");

                          $fetch = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id=tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id= accounts.acc_id) AND(accounts.acc_id= '{$_SESSION['acc_id']}')");

                          $percent = mysqli_num_rows($fetch);

                          while ($rows = mysqli_fetch_assoc($query)) { 
                            if ($percent == 0) {
                                $percent =1;
                                $ave  = round($rows['num'] / $percent);
                                echo '<p class="fw-bold">Preboard general average:</p>';
                            }
                            else{
                                $ave = round($rows['num'] / $percent);
                                echo '<p class="fw-bold">Preboard general average: '.$ave.'%</p>';
                            } 
                          }

                         ?> 
                        
                    </div>
                </div>
            </div>
           <div class="col-lg-8">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title text-dark fw-bold">Preboard Exam Percentage</h4>
                    </div>
                    <canvas id="chart" style="height: 350px; width:100%;"></canvas>
                    
                   <?php

                     $query = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Criminal Sociology') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.acc_id= '{$_SESSION['acc_id']}') ");

                    $query1 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Criminal Jurisprudence') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.acc_id= '{$_SESSION['acc_id']}') ");

                    $query2 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Law Enforcement') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.acc_id= '{$_SESSION['acc_id']}') ");

                    $query3 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Criminalistics') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.acc_id= '{$_SESSION['acc_id']}') ");


                    $query4 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Crime Detection and Investigation') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.acc_id= '{$_SESSION['acc_id']}') ");

                    $query5 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_exam_result, tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id= tbl_pre_question.pre_exam_id)  AND(tbl_pre_question.subjects = 'Correctional Administration') AND (tbl_exam_result.acc_id= accounts.acc_id) AND (accounts.acc_id= '{$_SESSION['acc_id']}') ");


                     while ($row= mysqli_fetch_assoc($query) AND $baws = mysqli_fetch_assoc($query1) AND $kaws = mysqli_fetch_assoc($query2) AND $meows = mysqli_fetch_assoc($query3) AND $whop = mysqli_fetch_assoc($query4) AND $pst = mysqli_fetch_assoc($query5)) {

                          $per [] = $row['num'];
                          $per1 [] = $baws['num'];
                          $per2 [] = $kaws['num'];
                          $per3 [] = $meows['num'];
                          $per4 [] = $whop['num'];
                          $per5 [] = $pst['num'];
                     }
                     ?>
                    <script>
                        
                    window.onload=function(){
                            var ctx = document.getElementById("chart").getContext("2d");
                            var data = {
                                labels: [""],
                                datasets: [{
                                    label: "Criminal Jurisprudence",
                                    backgroundColor: "#3e95cd",
                                    data: <?php echo json_encode($per1) ?> 
                                }, {
                                    label: "Law Enforcement",
                                    backgroundColor: "#8e5ea2",
                                    data: <?php echo json_encode($per2) ?>
                                }, {
                                    label: "Criminalistics",
                                    backgroundColor: "#3cba9f",
                                    data:<?php echo json_encode($per3) ?>
                                }, {
                                    label: "Crime Detection and Investigation",
                                    backgroundColor: "#775FEC",
                                    data: <?php echo json_encode($per4) ?>
                                }, {
                                    label: "Criminal Sociology",
                                    backgroundColor: "#FF6666",
                                    data:<?php echo json_encode($per) ?>,
                                },{
                                    label: "Correctional Administration",
                                    backgroundColor:  "#FFAA00",
                                    data: <?php echo json_encode($per5) ?>
                                }]

                            };
                            var myBarChart = new Chart(ctx, {
                                type: 'bar',
                                data: data,
                                options: {
                                    indexAxis: 'y',
                                    barValueSpacing: 20,
                                    min: 0,
                                    scales: {
                                        x: {
                                            min: 0,
                                            max: 100,
                                            ticks: {
                                                stepSize: 20,
                                                callback: function(value, index, values) {
                                                    return value + " %";
                                                }            
                                            }
                                        }
                                    }
                                }
                            });
                        }

                     </script> 
                </div>
            </div> 
        </div>
    </div>
    <!-- Footer -->
  <footer class="text-center text-lg-start text-white ft mt-3">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-between p-4" style="background-color: #8C0000;">
      <!-- Left -->
      <div class="me-5 ">
        <h5>Get connected with us on social networks:</h5>
      </div>
      <!-- Left -->
    </section>

    <!-- Section: Links  -->
    <section>
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold">College of Criminal Justice and Education LSPU Santa Cruz Campus</h6>
            <hr class="mb-4 mt-0 d-inline-block mx-auto"style="width: 90%; background-color: #7c4dff; height: 2px"/>
            <p>
              Here you can use the links and contacts to learn more about 
              the College of Criminal Justice and Education LSPU.
            </p>
          </div>
        
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">Useful links</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 100px; background-color: #7c4dff; height: 2px"
                />
            <p>
              <a href="https://www.facebook.com/groups/LSPU.CRIMINOLOGY.SCC.Official" class="text-white"><i class='bx-fw bx bxl-facebook-circle me-2'></i> Facebook: @LSPU CRIMINOLOGY SCC Official</a>
            </p>
            <p>
              <a href="#!" class="text-white"><p><i class="fas fa-envelope mr-3 me-2"></i>Email: marklito.repugia@lspu.edu.ph</a>
            </p>
          </div>
         
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">Contact</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p><i class="fas fa-home mr-3 me-2"></i>ccje.scc@lspu.edu.ph</p>
            <p><i class="fas fa-envelope mr-3 me-2"></i>marklito.repugia@lspu.edu.ph</p>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-3">
      © 2022 Copyright: College of Criminal Justice and Education LSPU Sta. Cruz Campus
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
    
</body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
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

<script type="text/javascript">
    $(document).ready(function(){
        $("#navbarDropdownMenuLink").on("click",function(){
            $.ajax({
                url:"view_student_notif.php",
                success: function(comers){
                    console.log(comers);
                }
            });
        });
    });
</script>
<?php 
#Change Pass
if (isset($_GET['adsuccess'])) {
    echo ' <script> swal("Password Changed!", " clicked the okay!", "success");
    window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/student/dashboard.php");
    </script>';
}
elseif (isset($_GET['aderror'])) {
    echo ' <script> swal("Error Password. Please try again!", " clicked the okay!", "error");
    window.history.pushState({}, document.title, "/" + "CCJE_Reviewer/student/change_password.php");
    </script>';
}

?>
</html>