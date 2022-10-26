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
  <title>Quiz</title>
  <!-- Boostrap 5.2 -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../css/home.css">
  <!-- Box Icons-->
  <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
  <!-- Font Awesome-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"rel="stylesheet"/>

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
                  <h4 class=""><i class="fas fa-exclamation-triangle alert alert-danger me-2"></i>Do you really wish to leave or log out?</h4>
              </div>
              <div class="modal-footer border-0">
                  <form action="../php/logout_faculty.php" class="hide" method="POST">
                    <input type="hidden" name="id" value="<?php echo $_SESSION['acc_id']  ?>">
          <input type="hidden" name="times" value="<?php echo $_SESSION['login_id']  ?>">
          <div>
            <button type="submit" class="btn btn-success">YES</button>
            <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">NO</button>
          </div>
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
        <div class="card mt-2">
          <div class="card-body">
            <?php
                        $exam_id =$_GET['sec'];

                        $score = mysqli_query($sqlcon,"SELECT score FROM tbl_exam_result WHERE exam_result_id='$exam_id'");
                        while ($result= mysqli_fetch_array($score)) { ?>
                          <tr>
                          <th class="text-left pl-1 fs-5"><p class="fs-4 pl-1 fw-bold">Total points:<b class="badge bg-success ms-2"><?php echo $result['score']; ?> /<?php echo $_GET['total']; ?></b>
                        </tr> 
                        <?php 
                        }

                        ?>
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
                  <div class="card mt-2">
                     <div class="card-body">
                       <div class="table-reponsive">
                          <table class="align-middle mb-0 table table-borderless " id="quesTab">
                              <thead class="mb-4">
                                  <th class="text-left pl-1 fs-5">Question:</th>
                              </thead>
                              <tbody class="fs-5">
                         
                            
                            <?php
                            if ($coat['exam_check']== $cane['correct_ans']) { ?>
                              <tr>
                                <th>
                                 <b><span class="fs-5 text-success"><?php echo $number.". &nbsp;". $cane['questions_title']; ?> <i class="fas fa-check ms-2"></i></span></b>
                                </th>
                              </tr>
                              <?php 

                            }
                            elseif ($coat['exam_check']!= $cane['correct_ans']) { ?>
                              <tr>
                                <th>
                                 <b><span class="fs-5 text-danger"><?php echo $number.". &nbsp;". $cane['questions_title']; ?> <i class="fas fa-times text-danger"></i></span></b>
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
                            <td>&emsp;<span><b>Correct Answer:</b>&emsp;<b>&emsp;<?php echo  $cane['correct_ans']; ?>.&emsp;<?php if ($core =='A') { echo  $cane['option_a'];}elseif ($core =='B') { echo  $cane['option_b']; }elseif ($core =='C') { echo  $cane['option_c']; }elseif ($core =='D') { echo  $cane['option_d'];} ?></b></span></td>
                          </tr>
                        
                    
                      </tbody>
                  </table>
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
</html>