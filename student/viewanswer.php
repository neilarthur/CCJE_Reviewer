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
  <title>View answer</title>
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
          <li class="nav-item">
            <a class="nav-link text-uppercase" href="test_results.php">Results</a>
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
  <div class="container-fluid py-4">
    <div class="row mx-5">
       <div class="col">
          <div class="card" style="background-color: rgb(43,43,43);">
              <div class="card-body">
              <?php

              $id = $_GET['id'];

              $row = mysqli_query($sqlcon,"SELECT * FROM choose_question WHERE test_id = '$id'");

              while ($show = mysqli_fetch_assoc($row)) { ?>

                <p class="h3 fw-bold text-white text-uppercase">Quiz: <?php echo $show['subject_name']; ?></p>
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
                $ans_id =$_GET['sec'];

                $score = mysqli_query($sqlcon,"SELECT * FROM tbl_quiz_result,choose_question WHERE (choose_question.test_id=tbl_quiz_result.test_id) AND ans_id='$ans_id'");

                while ($result= mysqli_fetch_array($score)) { ?>
                 
                 <p class="fw-bold card-text">Total points:<b class="badge bg-success ms-2 " style="font-size: 18px;"><?php echo $result['score']; ?> / <?php echo $result['total_quest']; ?></b></p>
                <?php 
                }

            ?>
              </div>
              <div class="p-2 bg-light border"><p class="card-text"><b>Started on:</b> </p></div>
              <div class="p-2 bg-light border">
                <?php 
                
                $id = $_GET['id'];
                $code = mysqli_query($sqlcon,"SELECT * FROM tbl_quiz_result,accounts WHERE (tbl_quiz_result.acc_id=accounts.acc_id) AND (tbl_quiz_result.test_id='$id')");


                while ($rows = mysqli_fetch_assoc($code)) {
                $boast = mysqli_query($sqlcon,"SELECT * FROM choose_question WHERE test_id = '{$rows['test_id']}'");
                $shine = mysqli_fetch_array($boast);

                $board = mysqli_query($sqlcon,"SELECT * FROM tbl_marks_done WHERE acc_id='{$_SESSION['acc_id']}' AND test_id='{$rows['test_id']}'");

                $row= mysqli_fetch_assoc($board);

                if ($row['acc_id']==$_SESSION['acc_id'] AND $row['test_id']==$shine['test_id']) {
                  echo '<p class="card-text"><b>State:</b><span class="badge bg-light text-success" style="font-size: 18px;">Finished</span></p>';

                  }
                }
                ?>
               
               
              </div>
              <div class="p-2 bg-light border"><p class="card-text"><b>Completed on:</b> </p></div>
              <div class="p-2 bg-light border"><p class="card-text"><b>Time Taken:</b> 19 mins</p></div>
              <div class="p-2 bg-light border">
                <?php

                $id = $_GET['id'];
                $quiz_query = mysqli_query($sqlcon,"SELECT * FROM tbl_quiz_result,accounts WHERE (tbl_quiz_result.acc_id=accounts.acc_id) AND (tbl_quiz_result.test_id='$id')");

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
                $sac = $_GET['sec'];
                $c = 0;
                $number = 1;

                $display = mysqli_query($sqlcon,"SELECT * FROM test_question,student_choice WHERE (test_question.question_id=student_choice.question_id) AND test_id = '$id'");

                $dis = mysqli_query($sqlcon,"SELECT * FROM tbl_student_answer,tbl_quiz_result WHERE (tbl_student_answer.ans_id = tbl_quiz_result.ans_id) AND tbl_student_answer.ans_id = '$sac'");

                while ($shows= mysqli_fetch_assoc($display) AND $low = mysqli_fetch_assoc($dis)) {

                $ans = $low['quiz_check'];
                $core = $shows['correct_ans'];
                $course = $shows['option_a'];
                $base = $shows['option_b'];
                $base4 = $shows['option_c'];
                $vv = $shows ['option_d'];
                  ?>

               <div class="col-lg-12">
                 <div class="card mb-2">
                   <div class="card-body m-2">
                      <div class="card">
                         <div class="card-body" style="background-color: rgb(219, 235, 247);">
                           <div class="table-reponsive">
                              <table class="align-middle mb-0 table table-borderless " id="quesTab" style="font-size: 17px;">
                                  <thead class="mb-4">
                                      <th class="text-left pl-1 fs-5">Question:</th>
                                  </thead>
                                  <tbody>
                             
                                
                                <?php
                                if ($low['quiz_check']== $shows['correct_ans']) { ?>
                                  <tr>
                                    <th>
                                     <b><span class="text-success"><?php echo $shows['questions_title']; ?> <i class="fas fa-check ms-2 fa-lg"></i></span></b>
                                    </th>
                                  </tr>
                                  <?php 

                                }
                                elseif ($low['quiz_check']!= $shows['correct_ans']) { ?>
                                  <tr>
                                    <th>
                                     <b><span class="text-danger"><?php echo $number.". &nbsp;". $shows['questions_title']; ?> <i class="fas fa-times text-danger ms-2 fa-lg"></i></span></b>
                                    </th>
                                  </tr>
                                  <?php
                                }

                                ?>
                              <tr>
                                <td><span><input   class="form-check-input pl-4 ms-5" type="radio" name="quizcheck[<?php echo $shows['question_id']; ?>]" id="exampleRadios1" value="A" <?php if($ans=='A'){ echo "checked=checked";}  ?> disabled > A. <?php echo $shows['option_a']; ?></span></td>
                              </tr>
                                     
                              <tr>
                                <td><span><input  class="form-check-input pl-4 ms-5" type="radio"  name="quizcheck[<?php echo $shows['question_id']; ?>]" id="exampleRadios1" value="B" <?php if($ans=='B'){ echo "checked=checked";}  ?> disabled > B. <?php echo $shows['option_b']; ?></span></td>
                              </tr>
                            
                              <tr>
                                <td><span><input  class="form-check-input pl-4 ms-5" type="radio"  name="quizcheck[<?php echo $shows['question_id']; ?>]" id="exampleRadios1" value="c"<?php if($ans=='C'){ echo "checked=checked";}  ?> disabled > C. <?php echo $shows['option_c']; ?></span></td>
                              </tr>
                            
                              <tr>
                                <td><span><input  class="form-check-input pl-4 ms-5" type="radio" name="quizcheck[<?php echo $shows['question_id']; ?>]" id="exampleRadios1" value="D"<?php if($ans=='D'){ echo "checked=checked";}  ?> disabled> D. <?php echo $shows['option_d']; ?></span></td>
                              </tr>

                              <tr>
                                <td>&emsp;<span class="text-dark"><b class="me-2">Correct Answer:</b><b class="ms-1"><?php echo $shows['correct_ans']; ?>. <?php if ($core =='A') { echo $shows['option_a'];}elseif ($core =='B') { echo $shows['option_b']; }elseif ($core =='C') { echo $shows['option_c']; }elseif ($core =='D') { echo $shows['option_d'];} ?></b></span></td>
                              </tr>
                            
                        
                          </tbody>
                          <tbody>
                            <tr>
                              <input type="hidden" name="update_id" value="<?php echo $id; ?>">
                              <input type="hidden" name="update_acc_id" value="<?php echo $_SESSION['acc_id'] ?>">
                              <input type="hidden" name="total_quest" value="<?php echo $sad; ?>">
                            </tr>
                          </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                   </div>
                 </div>    
               </div>
               <?php $number++; } ?>
        </div>
        <div class="d-flex justify-content-end mt-3 me-5">
          <a href="result.php?update_id" class="btn btn-secondary btn-md text-uppercase"><i class="fas fa-backward me-2"></i>Back</a>
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