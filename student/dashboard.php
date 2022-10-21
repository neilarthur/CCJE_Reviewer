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

</head>
<body style="background-color: rgb(229, 229, 229);"> 
	<div class="header text-uppercase hd " >
		<div class="container-fluid py-3">
			<img src="../assets/pics/logo.png" alt="" width="75" height="75" class="d-inline-block align-top mt-2 ms-4" >
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
			            echo'<span><img class="me-2 rounded-circle" src="data:image;base64,'.base64_encode($rows["image_size"]).'" height="40px;"> '.$_SESSION["first_name"].'</span>';
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
				<div class="modal-header border-0">
					<h5 class="modal-title"></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body align-items-center">
					<h4 class="fw-bold"><i class="fas fa-exclamation-triangle alert alert-danger me-2"></i>Do you really wish to leave or log out?</h4>
				</div>
				<div class="modal-footer border-0">
					<form action="../php/logout_faculty.php" class="hide" method="POST">
						<input type="hidden" name="id" value="<?php echo $_SESSION['acc_id']  ?>">
						<input type="hidden" name="times" value="<?php echo $_SESSION['login_id']  ?>">
						<div class="signout">
							<button type="submit" class="btn btn-success">YES</button>
							<button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">NO</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Main content-->
    <div class="container-fluid py-5">
        <div class="row mx-4 ">
        	<div class="col-lg-3 col-xs-6 mb-5">
        		<div class="card border-0" style="background-color: rgb(254, 193, 7);" >
        			<div class="card-body">
        				<div class="row">
        					<div class="col mr-2">
        						<div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    <?php $query = "SELECT * FROM choose_question WHERE section='4C'AND status='active'";
                                        $query_result = mysqli_query($sqlcon,$query);

                                        $row = mysqli_num_rows($query_result);
                                        echo'<h1  class="mb-2 fw-bold"><b>'.$row.' </b></h1>';
                                        ?> Quiz
        						</div>
        					</div>
        					<div class="col-auto mt-2" style="color: rgb(243, 156, 18);">
        						<i class="fa-solid fa-note-sticky fa-4x"></i>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        	<div class="col-lg-3 col-xs-6 mb-5">
        		<div class="card border-0" style="background-color: rgb(0, 122, 255);" >
        			<div class="card-body">
        				<div class="row no-gutters align-items-center">
        					<div class="col mr-2">
        						<div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    <?php $query = "SELECT * FROM choose_question WHERE type_test='LongQuiz'AND status='active'";
                                        $query_result = mysqli_query($sqlcon,$query);

                                        $row = mysqli_num_rows($query_result);
                                        echo'<h1  class="mb-2 fw-bold"><b>'.$row.' </b></h1>';
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
        	<div class="col-lg-3 col-xs-6 mb-5">
        		<div class="card border-0" style="background-color: #8C0000;" >
        			<div class="card-body">
        				<div class="row no-gutters align-items-center">
        					<div class="col mr-2">
        						<div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    <?php $query = "SELECT * FROM tbl_pre_question";
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
        	<div class="col-lg-3 col-xs-6 mb-5">
        		<div class="card border-0" style="background-color: rgb(0, 110, 60);" >
        			<div class="card-body">
        				<div class="row no-gutters align-items-center">
        					<div class="col mr-2">
        						<div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                    <?php $query = "SELECT * FROM tbl_quiz_result";
                                        $query_result = mysqli_query($sqlcon,$query);

                                        $row = mysqli_num_rows($query_result);
                                        echo'<h1  class=" mb-2 fw-bold"><b>'.$row.' </b></h1>';
                                        ?>
        							Quiz Results
        						</div>
        					</div>
        					<div class="col-auto mt-2" style="color: rgb(0, 36, 20));">
        						<i class="fa-solid fa-chart-column fa-4x"></i>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
        <div class="row mx-5">
        	<div class="col-lg-4">
        		<div class="card shadow">
        			<div class="card-body m-4 fs-5">
        				<h4 class="fw-bold">My Status</h4>
        				<hr>
                        <?php $query = "SELECT * FROM choose_question WHERE section='4C'AND status='active'";
                           $query_result = mysqli_query($sqlcon,$query);

                            $row = mysqli_num_rows($query_result);
                              echo'<p class="fw-bold">Total of Quizzes: '.$row.'</p>';
                        ?>
        				<hr>
                        <?php $query = "SELECT * FROM tbl_marks_done";
                            $query_result = mysqli_query($sqlcon,$query);

                            $row = mysqli_num_rows($query_result);
                            echo'<p class="fw-bold">Quiz taken: '.$row.'</p>';
                        ?>
        				<hr>
        				<p class="fw-bold">Best score in: Criminal jurisdinance</p>
        				<hr>
        				<p class="fw-bold">Lowest score in: Criminal jurisdinance</p>
        				<hr>
        				<p class="fw-bold">Average percentage: 85%</p>
        				<hr>
        			</div>
        		</div>
        	</div>
        	<div class="col-lg-8">
        		<div class="card shadow">
        			<div class="card-body">
                        <h4 class="card-title text-dark fw-bold">Quiz Percentage</h4>
                        <div>
                            <canvas id="myChart"    style="height: 400px; width: 100%;" ></canvas>
                        </div>
                        <?php 

                         $quiz_run = mysqli_query($sqlcon,"SELECT * FROM choose_question,tbl_quiz_result,accounts WHERE (tbl_quiz_result.acc_id=accounts.acc_id) AND (choose_question.test_id = tbl_quiz_result.test_id)");

                         // Criminal Jurisprudence//

                         $query = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_quiz_result, choose_question WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Criminal Jurisprudence')");
                         $fetch = mysqli_query($sqlcon,"SELECT * FROM tbl_quiz_result, choose_question WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Criminal Jurisprudence')");
                         $percent = mysqli_num_rows($fetch);

                          // Crime Detection and Investigation//
                         $query1 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_quiz_result, choose_question WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Crime Detection and Investigation')");
                         $fetch1 = mysqli_query($sqlcon,"SELECT * FROM tbl_quiz_result, choose_question WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Crime Detection and Investigation')");
                         $percent1 = mysqli_num_rows($fetch1);

                          // Law enforcement //

                         $query2 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_quiz_result, choose_question WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Law Enforcement')");
                         $fetch2 = mysqli_query($sqlcon,"SELECT * FROM tbl_quiz_result, choose_question WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Law Enforcement')");
                         $percent2 = mysqli_num_rows($fetch2);

                         // Criminalistics //
                         $query3 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_quiz_result, choose_question WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Criminalistics')");
                         $fetch3 = mysqli_query($sqlcon,"SELECT * FROM tbl_quiz_result, choose_question WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Criminalistics')");
                         $percent3 = mysqli_num_rows($fetch3);

                         // Criminal Sociology //
                         $query4 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_quiz_result, choose_question WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Criminal Sociology')");
                         $fetch4 = mysqli_query($sqlcon,"SELECT * FROM tbl_quiz_result, choose_question WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Criminal Sociology')");
                         $percent4 = mysqli_num_rows($fetch4);

                        // Correctional Administration //
                         $query5 = $sqlcon->query("SELECT SUM(score_percent) AS 'num' FROM  tbl_quiz_result, choose_question WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Correctional Administration')");
                         $fetch5 = mysqli_query($sqlcon,"SELECT * FROM tbl_quiz_result, choose_question WHERE (tbl_quiz_result.test_id= choose_question.test_id) AND(choose_question.subject_name = 'Correctional Administration')");
                         $percent5 = mysqli_num_rows($fetch5);


                         while ($baws = mysqli_fetch_assoc($quiz_run) AND $cows =mysqli_fetch_assoc($query) AND $cows1 =mysqli_fetch_assoc($query1) ) {
                             
                            $quiz[] = $baws['subject_name'];
                            $difficult = $baws['question_difficulty'];
                           
                            $ave [] = $cows['num'] / $percent;

                            $ave1 [] = $cows1['num'] / $percent1;
                            

                        }

                        ?>
                       <script >
                             window.onload=function(){
                                var ctx = document.getElementById("myChart").getContext("2d");
                                var data = {
                                    labels: ["Score Percentage"],
                                    datasets: [{
                                        label: <?php echo json_encode($quiz) ?>,
                                        backgroundColor: "blue",
                                        data: <?php echo json_encode($ave) ?>
                                    }, {
                                        label: "Law Enforcement",
                                        backgroundColor: "red",
                                        data: []
                                    }, {
                                        label: "Criminalitics",
                                        backgroundColor: "green",
                                        data: []
                                    }, {
                                        label: "Crime Detection and Investigation",
                                        backgroundColor: 'rgba(255, 159, 64, 0.8)',
                                        data: <?php echo json_encode($ave1) ?>
                                    }, {
                                        label: "Criminal Sociology",
                                        backgroundColor: "orange",
                                        data: []
                                    },{
                                        label: "Correctional Administration",
                                        backgroundColor: 'rgba(0, 115, 183, 0.8)',
                                        data: []
                                    }]

                                };
                                var myBarChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: data,
                                    options: {
                                        barValueSpacing: 20,
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    min: 0,
                                                }
                                            }]
                                        }
                                    }
                                });
                            }

                         </script> 
        			</div>
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