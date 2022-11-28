
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

	<style type="text/css">
   .progress {
  width: 150px;
  height: 150px;
  background: none;
  position: relative;
}

.progress::after {
  content: "";
  width: 100%;
  height: 100%;
  border-radius: 60%;
  border: 20px solid #eee;
  position: absolute;
  top: 0;
  left: 0;
}

.progress>span {
  width: 50%;
  height: 100%;
  overflow: hidden;
  position: absolute;
  top: 0;
  z-index: 1;
}

.progress .progress-left {
  left: 0;
}

.progress .progress-bar {
  width: 100%;
  height: 100%;
  background: none;
  border-width: 20px;
  border-style: solid;
  position: absolute;
  top: 0;
}

.progress .progress-left .progress-bar {
  left: 100%;
  border-top-right-radius: 90px;
  border-bottom-right-radius: 90px;
  border-left: 0;
  -webkit-transform-origin: center left;
  transform-origin: center left;
}

.progress .progress-right {
  right: 0;
}

.progress .progress-right .progress-bar {
  left: -100%;
  border-top-left-radius: 90px;
  border-bottom-left-radius: 90px;
  border-right: 0;
  -webkit-transform-origin: center right;
  transform-origin: center right;
}

.progress .progress-value {
  position: absolute;
  top: 0;
  left: 0;
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
  <div class="container-fluid py-3">
    <div class="col">
      <div class="card" style="background-color: rgb(43,43,43);">
        <div class="card-body">
          <?php 
            $id = $_GET['update_id'];

                      $rev = mysqli_query($sqlcon,"SELECT * FROM tbl_quiz_result,choose_question,accounts WHERE (tbl_quiz_result.test_id =choose_question.test_id) AND (tbl_quiz_result.acc_id = accounts.acc_id) AND tbl_quiz_result.acc_id = '{$_SESSION['acc_id']}' ORDER BY ans_id DESC");

                      

                       $bos = mysqli_fetch_assoc($rev);
                       
                      ?>
            <h4 class="fw-bold text-white text-uppercase"> Area of Exam: <?php echo $bos['subject_name']; ?> </h4>
          </div>
        </div>
     </div>
     <div class="row">
      <div class="col-lg-8">
        <div class="card mt-3">
          <div class="card-body  table-responsive-lg m-3">
            <p class="h2 fw-bold mb-5">Quiz Results</p>
              <table class="align-middle mb-0 table table-borderless table-hover" id="quesTab">
                <thead class="mb-4">
                  <tr>
                    <th class="fs-5 text-center">Name</th>
                    <th class="fs-5 text-center">Section</th>
                    <th class="fs-5 text-center">Total of Items</th>
                    <th class="fs-5 text-center">Score</th>
                    <th hidden class="fs-5">Attempt</th>
                    <th class="fs-5 text-center">Remarks</th>
                    <th class="fs-5 text-center">Action</th>
                  </tr>
                </thead>
                <tbody class="fs-5">
                      <?php

                      $id = $_GET['update_id'];

                      $shows = mysqli_query($sqlcon,"SELECT * FROM tbl_quiz_result,choose_question,accounts WHERE (tbl_quiz_result.test_id =choose_question.test_id) AND (tbl_quiz_result.acc_id = accounts.acc_id) AND tbl_quiz_result.acc_id = '{$_SESSION['acc_id']}' ORDER BY ans_id DESC");

                       $rows = mysqli_fetch_assoc($shows);

                      ?>
                    <tr>
                      <td class="text-center"><?php echo $rows['first_name']." ".$rows['last_name']; ?></td>
                      <td class="text-center"><?php echo $rows['section']; ?></td>
                      <td class="text-center"><?php echo $rows['total_quest']; ?></td>
                      <td class="text-center"><?php echo $rows['score']; ?></td>
                      <td hidden class="text-center"><?php echo $rows['attempt']; ?></td>
                      <?php 
                      if ($rows['result']=='passed') { ?>
                        <td class="text-center text-success text-uppercase fw-bold"><?php echo $rows['result'] ?></td>
                        <?php
                      }
                      elseif ($rows['result']=='failed') { ?>
                       <td class="text-center text-danger text-uppercase fw-bold"><?php echo $rows['result'] ?></td>
                       <?php 
                      }
                      ?>
                     
                      <td class="text-center"><a href="viewanswer.php?id=<?php echo $rows['test_id'];?>&sec=<?php echo $rows['ans_id'];?>" class="btn text-white" style="background-color: #8C0000;">View</a></td>
                     </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-lg-4 mt-3">
          <div class="bg-white rounded-lg p-5">
            <h2 class="text-center fw-bold mb-4 text-uppercase">Overall Results</h2>
              <!-- Progress bar 1 -->
                                    <?php

                      $id = $_GET['update_id'];

                      $shows = mysqli_query($sqlcon,"SELECT * FROM tbl_quiz_result,choose_question,accounts WHERE (tbl_quiz_result.test_id =choose_question.test_id) AND (tbl_quiz_result.acc_id = accounts.acc_id) AND tbl_quiz_result.acc_id = '{$_SESSION['acc_id']}' ORDER BY ans_id DESC");

                       $rows = mysqli_fetch_assoc($shows);

                       $res = $rows['score'];
                       $sac = $rows['total_quest'];
                       $total = $res /$sac * 100;
                       $total = $res /$sac * 100;
                       $wrong =  $sac - $res;
                       $wrong_t =  $wrong / $sac * 100;

                      ?>
            <div class="progress mx-auto" data-value='<?php echo $total; ?>'>
              <span class="progress-left">
                <span class="progress-bar border-success"></span>
              </span>
              <span class="progress-right">
                <span class="progress-bar border-success"></span>
              </span>
              <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                <div class="h2 font-weight-bold"><?php echo $total; ?><sup class="small">%</sup></div>
              </div>
            </div>
            <div class="row text-center mt-4">
              <div class="col-6 border-right">
                <div class="h4 font-weight-bold mb-0"><?php echo $total; ?>%</div><span class="small text-gray">Correct Answer</span>
              </div>
              <div class="col-6">
                <div class="h4 font-weight-bold mb-0"><?php echo $wrong_t; ?>%</div><span class="small text-gray">Wrong Answer</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

</body>
<script src="../js/bootstrap.bundle.min.js"></script>
<script
  src="https://code.jquery.com/jquery-3.6.1.slim.js"
  integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk="
  crossorigin="anonymous"></script>
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
  $(function() {

  $(".progress").each(function() {

    var value = $(this).attr('data-value');
    var left = $(this).find('.progress-left .progress-bar');
    var right = $(this).find('.progress-right .progress-bar');

    if (value > 0) {
      if (value <= 50) {
        right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
      } else {
        right.css('transform', 'rotate(180deg)')
        left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
      }
    }

  })

  function percentageToDegrees(percentage) {

    return percentage / 100 * 360

  }

});
</script>
</html>