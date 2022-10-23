
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

  <!--Main Content-->
  <div class="container-fluid py-3">
    <div class="col">
      <div class="card" style="background-color: rgb(43,43,43);">
        <div class="card-body">
          <?php 

            $id = $_GET['code'];

            $update = $_GET['update'];


            $rev = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.acc_id = '$update') ORDER BY exam_result_id DESC");

            $bos = mysqli_fetch_assoc($rev);
                       
                      ?>
            <h4 class="fw-bold text-white text-uppercase"> Area of Exam: <?php echo $bos['subjects']; ?> </h4>
          </div>
        </div>
     </div>
     <div class="row">
      <div class="col-lg-8">
        <div class="card mt-3 shadow">
          <div class="card-body  table-responsive-lg m-3">
            <p class="h2 fw-bold mb-5">Examination Results </p>
               
              <table class="align-middle mb-0 table table-borderless table-hover" id="quesTab">
                <thead class="mb-4">
                  <tr>
                    <th class="fs-5">Name</th>
                    <th class="fs-5">Section</th>
                    <th class="fs-5">Total of Question</th>
                    <th class="fs-5">Score</th>
                    <th hidden class="fs-5">Attempt</th>
                    <th class="fs-5">Remarks</th>
                    <th class="fs-5">Action</th>
                  </tr>
                </thead>
                <tbody class="fs-5">
                      <?php


                      $shows = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.acc_id = '$update') ORDER BY exam_result_id DESC");
                       $rows = mysqli_fetch_assoc($shows);

                      ?>
                    <tr>
                      <td class=""><?php echo $rows['first_name']." ".$rows['last_name']; ?></td>
                      <td class=""><?php echo $rows['section']; ?></td>
                      <td class=""><?php echo $rows['total_question']; ?></td>
                      <td class=""><?php echo $rows['score']; ?></td>
                      <td hidden class=""><?php echo $rows['attempt']; ?></td>
                      <?php 
                      if ($rows['result']=='passed') { ?>
                        <td class="text-success text-uppercase fw-bold"><?php echo $rows['result'] ?></td>
                        <?php
                      }
                      elseif ($rows['result']=='failed') { ?>
                       <td class="text-danger text-uppercase fw-bold"><?php echo $rows['result'] ?></td>
                       <?php 
                      }
                      ?>
                     
                      <td><a href="view_exam_answer.php?id=<?php echo $rows['pre_exam_id'];?>&sec=<?php echo $rows['exam_result_id'];?>&total=<?php echo $rows['total_question']; ?>" class="btn text-white" style="background-color: #8C0000;">View</a></td>
                     </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-lg-4 mt-3">
          <div class="bg-white rounded-lg p-5 shadow">
            <h2 class="text-center fw-bold mb-4 text-uppercase">Overall Results</h2>
              <!-- Progress bar 1 -->
                                    <?php

                    $shows = mysqli_query($sqlcon,"SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.acc_id = '$update') ORDER BY exam_result_id DESC");


                       $lows = mysqli_fetch_assoc($shows);

                       $res = $lows['score'];
                       $sac = $lows['total_question'];
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