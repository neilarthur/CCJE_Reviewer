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
  <title>Prenoard Exam</title>
  <!-- Boostrap 5.2 -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../css/home.css">
  <!-- Box Icons-->
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <!-- Font Awesome-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"rel="stylesheet"/>
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
          <li class="nav-item">
            <a class="nav-link text-uppercase" href="test_results.php">Results</a>
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
  <!--Main Content-->
  <div class="container-fluid py-4">
    <div class="row mx-5">
       <div class="col">
          <div class="card" style="background-color: rgb(43,43,43);">
              <div class="card-body">
              <?php

              $id = $_GET['id'];

              $row = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question WHERE pre_exam_id = '$id'");

              while ($show = mysqli_fetch_assoc($row)) { ?>

                <p class="h3 fw-bold text-white text-uppercase">Area of Examination: <?php echo $show['subjects']; ?></p>
              <?php }  ?>
              
              </div>
          </div>
        </div>
    </div>
    <div class="row mx-5">
      <div class="col">
        <div class="card mt-2 mb-2">
          <div class="card-body">
           <div class="d-grid gap-1" style="font-size: 18px;">
                <div class="p-2 bg-light border">
                <?php
                  $exam_id =$_GET['sec'];

                  $score = mysqli_query($sqlcon,"SELECT score FROM tbl_exam_result WHERE exam_result_id='$exam_id'");
                  while ($result= mysqli_fetch_array($score)) { ?>
                    
                  <p class="fw-bold card-text">Total points:<b class="badge bg-success ms-2" style="font-size: 18px;"><?php echo $result['score']; ?> / <?php echo $_GET['total']; ?></b>
                  
                  <?php 
                  }

                  ?>
                </div>
                <?php

                $code2 = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_marks_done WHERE pre_exam_id = '$id' AND acc_id = '{$_SESSION['acc_id']}' ");

                $shws2 = mysqli_fetch_assoc($code2);

                $sssl3 = strtotime($shws2['date_created']);


                ?>
                <div class="p-2 bg-light border"><p class="card-text"><b>Started on:</b>
                  <?php echo date('F j, Y g:i a, D',$sssl3);  ?></p></div>

                <?php 
                
                $id = $_GET['id'];
                $code = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts WHERE (tbl_exam_result.acc_id=accounts.acc_id) AND (tbl_exam_result.pre_exam_id='$id') AND tbl_exam_result.acc_id = '{$_SESSION['acc_id']}' ");


                while ($rows = mysqli_fetch_assoc($code)) {
                $boast = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question WHERE pre_exam_id = '{$rows['pre_exam_id']}'");
                $shine = mysqli_fetch_array($boast);

                $board = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_marks_done WHERE acc_id='{$_SESSION['acc_id']}' AND pre_exam_id='{$rows['pre_exam_id']}'");

                $row= mysqli_fetch_assoc($board);

                if ($row['acc_id']==$_SESSION['acc_id'] AND $row['pre_exam_id']==$shine['pre_exam_id']) {
                  echo '<div class="p-2 bg-light border"><p class="card-text"><b>State:</b><span class="badge bg-light text-success" style="font-size: 18px;">Finished</span></p></div>';
                }


                date_default_timezone_set('Asia/Manila');


                $sssl = strtotime($rows['date_exam_result']);

                $sssl2 = strtotime($rows['date_created']);


                if (date('i',$sssl) == '00') {
                  
                  $knock = "seconds";
                }
                else {

                  $knock = "minutes";
                }


                echo '<div class="p-2 bg-light border"><p class="card-text"><b>Completed on: '. date('F j, Y g:i a, D',$sssl2).'</b> </p></div>
              <div class="p-2 bg-light border"><p class="card-text"><b>Time Taken: ' . date('i:s',$sssl). ' '.$knock.'</b></p></div>';

                }
                ?>
                <div class="p-2 bg-light border">
                <?php

                $id = $_GET['id'];
                $quiz_query = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,accounts WHERE (tbl_exam_result.acc_id=accounts.acc_id) AND (tbl_exam_result.pre_exam_id='$id')  AND tbl_exam_result.acc_id = '{$_SESSION['acc_id']}'");

                 while ($rows = mysqli_fetch_assoc($quiz_query)) {?>
                   <p class="card-text"><b>Grade:</b> <b><?php echo $rows['score_percent']; ?>.00</b> out of 100.00</p>

                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <form action="check.php" method="POST">
         
        <div class="row mx-5">
                  <?php

                  $id = $_GET['id'];
                  $exam_id =$_GET['sec'];
                  $number = 1;

                  $exam_display = mysqli_query($sqlcon,"SELECT * FROM test_question,tbl_pre_choose_quest WHERE (test_question.question_id=tbl_pre_choose_quest.question_id) AND pre_exam_id = '$id'");

                  $checked_display = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_student_ans,tbl_exam_result WHERE (tbl_pre_student_ans.exam_result_id = tbl_exam_result.exam_result_id) AND tbl_pre_student_ans.exam_result_id = '$exam_id'");

                  while ($cane= mysqli_fetch_assoc($exam_display) AND $coat = mysqli_fetch_assoc($checked_display)) {

                    $ans = $coat['exam_check'];
                    $core = $cane['correct_ans'];

                  ?>

               <div class="col-lg-12">
                <div class="card mb-2">
                  <div class="card-body m-2">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="card" style="background-color: rgb(219, 235, 247);">
                          <div class="card-body">
                            <div class="table-reponsive">
                              <table class="align-middle mb-0 table table-borderless " id="quesTab">
                                <thead class="mb-4"></thead>
                                <tbody style="font-size: 17px;">
                                  <tr>
                                     <p class="fw-bold fs-5">Question: </p>
                                  </tr>
                         
                            
                                        <?php
                                        if ($coat['exam_check']== $cane['correct_ans']) { ?>
                                          <tr>
                                            <th>
                                             <b><span class="text-success"><?php echo $number ?>.&nbsp;<?php echo $cane['questions_title']; ?> <i class="fas fa-check ms-2 fa-lg"></i></span></b>
                                            </th>
                                          </tr>
                                          <?php 

                                        }
                                        elseif ($coat['exam_check']!= $cane['correct_ans']) { ?>
                                          <tr>
                                            <th>
                                             <b><span class="text-danger"><?php echo $number ?>.&nbsp;<?php echo $cane['questions_title']; ?> <i class="fas fa-times text-danger ms-2 fa-lg"></i></span></b>
                                            </th>
                                          </tr>
                                          <?php
                                        }

                                        ?>
                                      <tr>
                                        <td><span><input   class="form-check-input pl-4 ms-5" type="radio" name="examcheck[<?php echo $cane['question_id']; ?>]" id="exampleRadios1" value="A" <?php if($coat['exam_check'] =='A' ){ echo "checked=checked";}  ?> disabled > A. <?php echo $cane['option_a']; ?></span></td>
                                      </tr>
                                             
                                      <tr>
                                        <td><span><input  class="form-check-input pl-4 ms-5" type="radio"  name="examcheck[<?php echo $cane['question_id']; ?>]" id="exampleRadios1" value="B" <?php if($coat['exam_check'] =='B'){ echo "checked=checked";}  ?> disabled > B. <?php echo  $cane['option_b']; ?></span></td>
                                      </tr>
                                    
                                      <tr>
                                        <td><span><input  class="form-check-input pl-4 ms-5" type="radio"  name="examcheck[<?php echo $cane['question_id']; ?>]" id="exampleRadios1" value="c"<?php if($coat['exam_check'] =='C'){ echo "checked=checked";}  ?> disabled > C. <?php echo  $cane['option_c']; ?></span></td>
                                      </tr>
                                    
                                      <tr>
                                        <td><span><input  class="form-check-input pl-4 ms-5" type="radio" name="examcheck[<?php echo $cane['question_id']; ?>]" id="exampleRadios1" value="D"<?php if($coat['exam_check'] =='D'){ echo "checked=checked";}  ?> disabled> D. <?php echo  $cane['option_d']; ?></span></td>
                                      </tr>

                                      <tr>
                                        <td><span class="text-dark ms-4"><b>Correct Answer:</b><b class="ms-2"><?php echo  $cane['correct_ans']; ?>. <?php if ($core =='A') { echo  $cane['option_a'];}elseif ($core =='B') { echo  $cane['option_b']; }elseif ($core =='C') { echo  $cane['option_c']; }elseif ($core =='D') { echo  $cane['option_d'];} ?></b></span></td>
                                      </tr>
                                    
                                
                                  </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
          </div>
               <?php $number++; } ?>
        </div>
        <div class="d-flex justify-content-end mt-3 me-5">
          <a href="take_preboard.php" class="btn btn-secondary btn-md text-uppercase"><i class="fas fa-backward me-2"></i>Back</a>
        </div>
    </form>
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
</html>