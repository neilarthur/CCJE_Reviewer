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
  <script type="text/javascript">
    function preventBack(){window.history.forward()};
    setTimeout("preventBack()",0);
     window.onunload=function(){null;}
  </script>
	<title>Quiz</title>
	<!-- Boostrap 5.2 -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/home.css">
	<!-- Box Icons-->
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<!-- Font Awesome-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"rel="stylesheet"/>
  <link rel="stylesheet" type="text/css" href="../TimeCircles-master/inc/TimeCircles.css">
	<style type="text/css">
		.base-timer {
  position: relative;
  width: 300px;
  height: 300px;
}

.base-timer__svg {
  transform: scaleX(-1);
}

.base-timer__circle {
  fill: none;
  stroke: none;
}

.base-timer__path-elapsed {
  stroke-width: 7px;
  stroke: grey;
}

.base-timer__path-remaining {
  stroke-width: 7px;
  stroke-linecap: round;
  transform: rotate(90deg);
  transform-origin: center;
  transition: 1s linear all;
  fill-rule: nonzero;
  stroke: currentColor;
}

.base-timer__path-remaining.green {
  color: rgb(65, 184, 131);
}

.base-timer__path-remaining.orange {
  color: orange;
}

.base-timer__path-remaining.red {
  color: red;
}

.base-timer__label {
  position: absolute;
  width: 300px;
  height: 300px;
  top: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 48px;
}
	</style>
</head>
<body style="background-color: rgb(229, 229, 229);" onload="timeout()">

  <!--Main Content-->
  <div class="container py-4">
     <div class="col-lg-12">
        <div class="card mb-3">
          <div class="card-header" style="background-color: rgb(43, 43, 43);">
          </div>
           <div class="card-body m-2 ">
              <?php

              $ids = $_GET['id'];

              $row = mysqli_query($sqlcon,"SELECT * FROM choose_question WHERE test_id = '$ids'");

              while ($show = mysqli_fetch_assoc($row)) { ?>

                <p class="h1 fw-bold text-uppercase text-dark"><?php echo $show['quiz_title']; ?></p>
                <p class="h5  text-uppercase text-dark"><?php echo $show['subject_name']; ?></p>
                <p class=" h5  text-dark" > <?php echo $show['description']; ?> </p>
              <?php }  ?>
            </div>
        </div>
    </div>
    <form action="check.php" id="form1" method="POST">
      <div class="row">
       <div class="col-lg-12">
          <div class="card" id="timer">
             <div class="card-body mx-auto">
              <div class="justify-content-center" id="exam_timer" data-timer="<?php echo $_GET['limit']; ?>" style="height: 120px; width: 100%;" >
                
               </div> 
             </div>
          </div>
        </div>
     </div>
     <div class="row">

        <?php

          $sad = $_GET['base'];


          $c = 0;
          $number = 1;
          $display = mysqli_query($sqlcon,"SELECT * FROM test_question,student_choice WHERE (test_question.question_id=student_choice.question_id) AND test_id = '$ids'");

          while ($shows = mysqli_fetch_assoc($display)) {  ?>

                <div class="col-lg-12">
                   <div class="card mt-3">
                      <div class="card-body">
                         <div class="table-reponsive">
                             <table class="align-middle mb-0 table table-borderless" id="quesTab">
                                <thead class="mb-4">
                                   <tr>
                                      
                                   </tr>
                                 </thead>
                                 <tbody class="fs-5">
                                    <tr>
                                       <th>
                                          <b><span class="fs-5"><?php echo $number.". &nbsp;". $shows['questions_title']; ?></span></b>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td><span><input class="form-check-input pl-4 ms-5" type="radio" name="quizcheck[<?php echo $shows['question_id']; ?>]" id="exampleRadios1" value="A"> A. <?php echo $shows['option_a']; ?></span></td>
                                    </tr>
                                    <tr>
                                      <td><span><input class="form-check-input pl-4 ms-5" type="radio"  name="quizcheck[<?php echo $shows['question_id']; ?>]" id="exampleRadios1" value="B"> B. <?php echo $shows['option_b']; ?></span></td>
                                    </tr>
                                    <tr>
                                      <td><span><input class="form-check-input pl-4 ms-5" type="radio"  name="quizcheck[<?php echo $shows['question_id']; ?>]" id="exampleRadios1" value="C"> C. <?php echo $shows['option_c']; ?></span></td>
                                    </tr>
                                    <tr>
                                      <td><span><input class="form-check-input pl-4 ms-5" type="radio" name="quizcheck[<?php echo $shows['question_id']; ?>]" id="exampleRadios1" value="D"> D. <?php echo $shows['option_d']; ?></span></td>
                                    </tr>
                                </tbody>
                                <tbody>
                                     <tr>
                                        <input type="hidden" name="update_id" value="<?php echo $ids; ?>">
                                        <input type="hidden" name="update_acc_id" value="<?php echo $_SESSION['acc_id'] ?>">
                                        <input type="hidden" name="total_quest" value="<?php echo $sad; ?>">
                                    </tr>
                                 </tbody>
                              </table>
                         </div>
                     </div>
                 </div>
             </div>
                <?php $number++; } ?>
          </div>
          <div class="d-flex justify-content-center mt-3">
            <?php

            $ter = mysqli_query($sqlcon,"SELECT * FROM choose_question WHERE test_id = '$ids'");

            while ($ger = mysqli_fetch_assoc($ter)) { ?>

              <input type="hidden" name="subjectas" value="<?php echo $ger['subject_name']; ?>">
              
              <?php
            }
            ?>
            <input type="submit" value="submit" class="btn btn-success mx-2 text-uppercase btn-lg">
          </div>
    </form>
</div>

</body>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="../TimeCircles-master/inc/TimeCircles.js"></script>
<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function(){
  window.addEventListener('scroll', function() {
      if (window.scrollY > 50) {
        document.getElementById('navbar-top').classList.add('fixed-top');
        document.getElementById('timer').classList.add('fixed-top');
        // add padding top to show content behind navbar
        navbar_height = document.querySelector('.navbar').offsetHeight;
        document.body.style.paddingTop = navbar_height + 'px';
      } else {
        document.getElementById('navbar-top').classList.remove('fixed-top');
        document.getElementById('timer').classList.remove('fixed-top');         // remove padding top from body
        document.body.style.paddingTop = '0';
      } 
  });
}); 
</script>

<script type="text/javascript">
  
  $('#exam_timer').TimeCircles({
    time:{
      Days:{
        show:false
      } 
    }
  });

  setInterval(function(){

    var remaining_second = $('#exam_timer').TimeCircles().getTime();
    if (remaining_second < 1) 
    {
      clearTimeout(tm);
      document.getElementById('form1').submit();
    }

    var tm = setTimeout(function(){setInterval()},1000)
  },2000);


</script>

</html>