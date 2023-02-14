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
	<title>Notifications</title>
	<!-- Boostrap 5.2 -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/home.css">
	<link rel="stylesheet" type="text/css" href="../css/notification.css">
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
                    <div class="dropdown dp mx-2">
                        <a class="text-reset dropdown-toggle text-decoration-none" href="#"id="navbarDropdownMenuLink" role="button"data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell fa-lg mx-1"></i>
                           <div id="count_wrapper">
                                
                           </div>
                        </a>
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="border-radius: 10px;">
                            <h6 class="dropdown-header text-dark ">Notifications</h6>
                            <div style="overflow-y: auto; white-space: nowrap; height: auto; max-height: 300px;" class="bg-white">
                                <div id="wrapper">
                                     
                                </div> 
                            </div>
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
    	<div class="container col-lg-8">
    		<p class="m-b-50 h3">Notifications <i class="fa fa-bell ms-2"></i></p>
			<?php

            $acc = mysqli_query($sqlcon,"SELECT * FROM accounts WHERE acc_id='{$_SESSION['acc_id']}'");
            while ($row =mysqli_fetch_assoc($acc)) {
                if ($row['section']=='4C') {

                    $record= mysqli_query($sqlcon,"SELECT * FROM accounts,choose_question,tbl_notification WHERE (accounts.acc_id=choose_question.prepared_by) AND (choose_question.status='active') AND(tbl_notification.test_id = choose_question.test_id) AND (choose_question.section ='4C') AND (stat_question='Ready') AND (tbl_notification.acc_id = accounts.acc_id) AND (tbl_notification.action='posted a quiz')  AND(tbl_notification.section_notif='4C') ORDER BY notif_id DESC ");

                    $respo = mysqli_query($sqlcon,"SELECT * FROM tbl_admin_response,accounts,tbl_pre_question WHERE (tbl_admin_response.acc_id= accounts.acc_id) AND (tbl_admin_response.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_admin_response.response_sender='posted an exam')  ORDER BY tbl_res_id_ad DESC");

                     $count = mysqli_num_rows($record);
                     $counted = mysqli_num_rows($respo);
                     $total_count= $count + $counted;

                     if ($total_count == 0) {
                                echo "<p class='h3 text-center text-dark'>No notifications yet</p>";
                             }

                    while ($raw = mysqli_fetch_assoc($record)) { ?>
                        <div class="notification-ui_dd-content">
                            <div class="notification-list notification-list--unread">
                                <div class="notification-list_content">
                                    <div class="notification-list_img">
                                        <?php
                                        $pic = $raw['image_size'];
                                        echo '<div class="fa-stack fa-1x me-5">
                                        <img class="me-2 rounded-circle" src="data:image;base64,'.base64_encode($pic).'" height="40px;" width="40px;">
                                        </div> ';
                                         ?>
                                    </div>
                                    <div class="notification-list_detail">
                                        <p><b><?php echo $raw['first_name']." ".$raw['last_name']."</b>&nbsp; ".$raw['action']."."; ?>
                                        <p class="text-muted"><small>10 mins ago</small></p>
                                    </div>
                                </div>
                                <div class="notification-list_feature-img">
                                    <div class="small text-gray-500 text-muted"><?php echo date('F j, Y',strtotime($raw['date_created'])); ?></div>
                                </div>
                            </div>
                        </div> 
                  <?php  }
                  while ($raw = mysqli_fetch_assoc($respo)) { ?>
                        <div class="notification-ui_dd-content">
                            <div class="notification-list notification-list--unread">
                                <div class="notification-list_content">
                                    <div class="notification-list_img">
                                        <?php
                                        $pic = $raw['image_size'];
                                        echo '<div class="fa-stack fa-1x me-5">
                                        <img class="me-2 rounded-circle" src="data:image;base64,'.base64_encode($pic).'" height="40px;" width="40px;">
                                        </div> ';
                                         ?>
                                    </div>
                                    <div class="notification-list_detail">
                                        <p><b><?php echo $raw['first_name']." ".$raw['last_name']."</b>&nbsp; ".$raw['response_sender']."."; ?>
                                        <p class="text-muted"><small>10 mins ago</small></p>
                                    </div>
                                </div>
                                <div class="notification-list_feature-img">
                                    <div class="small text-gray-500 text-muted"><?php echo date('F j, Y',strtotime($raw['date_created'])); ?></div>
                                </div>
                            </div>
                        </div> 
                    <?php }
                     } elseif ($row['section']=='4B') {
                         $record= mysqli_query($sqlcon,"SELECT * FROM accounts,choose_question,tbl_notification WHERE (accounts.acc_id=choose_question.prepared_by) AND (choose_question.status='active') AND(tbl_notification.test_id = choose_question.test_id) AND (choose_question.section ='4B') AND (stat_question='Ready') AND (tbl_notification.acc_id = accounts.acc_id) AND (tbl_notification.action='posted a quiz')  AND(tbl_notification.section_notif='4B') ORDER BY notif_id DESC ");

                         $respo = mysqli_query($sqlcon,"SELECT * FROM tbl_admin_response,accounts,tbl_pre_question WHERE (tbl_admin_response.acc_id= accounts.acc_id) AND (tbl_admin_response.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_admin_response.response_sender='posted an exam')  ORDER BY tbl_res_id_ad DESC");

                             $count = mysqli_num_rows($record);
                             $counted = mysqli_num_rows($respo);
                             $total_count= $count + $counted;

                             if ($total_count == 0) {
                                         echo "<p class='h3 text-center text-dark'>No notifications yet</p>";
                            }

                        while ($raw = mysqli_fetch_assoc($record)) { ?>
                        <div class="notification-ui_dd-content">
                            <div class="notification-list notification-list--unread">
                                <div class="notification-list_content">
                                    <div class="notification-list_img">
                                        <?php
                                        $pic = $raw['image_size'];
                                        echo '<div class="fa-stack fa-1x me-5">
                                        <img class="me-2 rounded-circle" src="data:image;base64,'.base64_encode($pic).'" height="40px;" width="40px;">
                                        </div> ';
                                         ?>
                                    </div>
                                    <div class="notification-list_detail">
                                        <p><b><?php echo $raw['first_name']." ".$raw['last_name']."</b>&nbsp; ".$raw['action']."."; ?>
                                        <p class="text-muted"><small>10 mins ago</small></p>
                                    </div>
                                </div>
                                <div class="notification-list_feature-img">
                                    <div class="small text-gray-500 text-muted"><?php echo date('F j, Y',strtotime($raw['date_created'])); ?></div>
                                </div>
                            </div>
                        </div>
                    <?php }
                     while ($raw = mysqli_fetch_assoc($respo)) { ?>
                        <div class="notification-ui_dd-content">
                            <div class="notification-list notification-list--unread">
                                <div class="notification-list_content">
                                    <div class="notification-list_img">
                                        <?php
                                        $pic = $raw['image_size'];
                                        echo '<div class="fa-stack fa-1x me-5">
                                        <img class="me-2 rounded-circle" src="data:image;base64,'.base64_encode($pic).'" height="40px;" width="40px;">
                                        </div> ';
                                         ?>
                                    </div>
                                    <div class="notification-list_detail">
                                        <p><b><?php echo $raw['first_name']." ".$raw['last_name']."</b>&nbsp; ".$raw['response_sender']."."; ?>
                                        <p class="text-muted"><small>10 mins ago</small></p>
                                    </div>
                                </div>
                                <div class="notification-list_feature-img">
                                    <div class="small text-gray-500 text-muted"><?php echo date('F j, Y',strtotime($raw['date_created'])); ?></div>
                                </div>
                            </div>
                        </div> 
                    <?php }         

                     } elseif ($row['section']=='4A') {
                         $record= mysqli_query($sqlcon,"SELECT * FROM accounts,choose_question,tbl_notification WHERE (accounts.acc_id=choose_question.prepared_by) AND (choose_question.status='active') AND(tbl_notification.test_id = choose_question.test_id) AND (choose_question.section ='4A') AND (stat_question='Ready') AND (tbl_notification.acc_id = accounts.acc_id) AND (tbl_notification.action='posted a quiz')  AND(tbl_notification.section_notif='4A') ORDER BY notif_id DESC ");

                         $respo = mysqli_query($sqlcon,"SELECT * FROM tbl_admin_response,accounts,tbl_pre_question WHERE (tbl_admin_response.acc_id= accounts.acc_id) AND (tbl_admin_response.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_admin_response.response_sender='posted an exam')  ORDER BY tbl_res_id_ad DESC");

                             $count = mysqli_num_rows($record);
                             $counted = mysqli_num_rows($respo);
                             $total_count= $count + $counted;

                             if ($total_count == 0) {
                                         echo "<p class='h3 text-center text-dark'>No notifications yet</p>";
                            }
                        while ($raw = mysqli_fetch_assoc($record)) { ?>
                        <div class="notification-ui_dd-content">
                            <div class="notification-list notification-list--unread">
                                <div class="notification-list_content">
                                    <div class="notification-list_img">
                                        <?php
                                        $pic = $raw['image_size'];
                                        echo '<div class="fa-stack fa-1x me-5">
                                        <img class="me-2 rounded-circle" src="data:image;base64,'.base64_encode($pic).'" height="40px;" width="40px;">
                                        </div> ';
                                         ?>
                                    </div>
                                    <div class="notification-list_detail">
                                        <p><b><?php echo $raw['first_name']." ".$raw['last_name']."</b>&nbsp; ".$raw['action']."."; ?>
                                        <p class="text-muted"><small>10 mins ago</small></p>
                                    </div>
                                </div>
                                <div class="notification-list_feature-img">
                                    <div class="small text-gray-500 text-muted"><?php echo date('F j, Y',strtotime($raw['date_created'])); ?></div>
                                </div>
                            </div>
                        </div>
                        <?php } 
                        while ($raw = mysqli_fetch_assoc($respo)) { ?>
                        <div class="notification-ui_dd-content">
                            <div class="notification-list notification-list--unread">
                                <div class="notification-list_content">
                                    <div class="notification-list_img">
                                        <?php
                                        $pic = $raw['image_size'];
                                        echo '<div class="fa-stack fa-1x me-5">
                                        <img class="me-2 rounded-circle" src="data:image;base64,'.base64_encode($pic).'" height="40px;" width="40px;">
                                        </div> ';
                                         ?>
                                    </div>
                                    <div class="notification-list_detail">
                                        <p><b><?php echo $raw['first_name']." ".$raw['last_name']."</b>&nbsp; ".$raw['response_sender']."."; ?>
                                        <p class="text-muted"><small>10 mins ago</small></p>
                                    </div>
                                </div>
                                <div class="notification-list_feature-img">
                                    <div class="small text-gray-500 text-muted"><?php echo date('F j, Y',strtotime($raw['date_created'])); ?></div>
                                </div>
                            </div>
                        </div>   
                    <?php } 
                     
                     }
                       
                 }
             ?>
			</div>
		</div>
    </div>

</body>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
                success: function(){
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#navbarDropdownMenuLink").on("click",function(){
            $.ajax({
                url:"view_notif_exam.php",
                success: function(){
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