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
	<title>Preboard Examination</title>
	<!-- Boostrap 5.2 -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../css/home.css">
	<!-- Box Icons-->
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<!-- Font Awesome-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"rel="stylesheet"/>
	<!-- Exam timer-->
	<link rel="stylesheet" type="text/css" href="../TimeCircles-master/inc/TimeCircles.css">
	<!-- System Logo -->
    <link rel="icon" href="../assets/pics/system-ico.ico">
</head>
<body style="background-color: rgb(229, 229, 229);">
<!-- Main Content -->
<div class="container py-4">
	<div class="row">
		<div class="col-lg-12 align-self-center">
			<div class="card mt-2">
				<?php

				$area = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question");

				$title = mysqli_fetch_assoc($area);

				 ?>
				 <div class="card-header" style="background-color: #8C0000;">
				 	<p class=" h1 text-white fw-bold text-uppercase">Area of Examination: <?php echo $title['subjects']; ?></hp>
				 </div>
				<div class="card-body" >
					<p class=" h4 text-dark fw-bold" > <?php echo $title['description']; ?> </p>
				</div>
			</div>
		</div>
	</div>
	<form action="check_exam.php" id="form2" method="POST">
		<div class="row">
			<div class="row-justify-content-end">
				<div class="col-lg-12 mt-2">
					<div class="card mb-2" id="timer">
						<div class="card-body mx-auto">
							<?php

							$code = $_GET['code'];

							$said = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question WHERE access_code='$code'");

							$bench = mysqli_fetch_assoc($said);
							?>
							<div id="exam_timer" data-timer="<?php echo $bench['time_limit']; ?>" style="width: 100%; height :110px; "></div>
						</div>
					</div>
				</div>
			</div>
			<?php
			
			$number = 1;

			$query_limit = "SELECT * FROM tbl_pre_question,tbl_pre_choose_quest,test_question WHERE (tbl_pre_question.pre_exam_id=tbl_pre_choose_quest.pre_exam_id) AND (tbl_pre_question.access_code = '$code') AND (tbl_pre_choose_quest.question_id = test_question.question_id)";

			$result_limit = mysqli_query($sqlcon,$query_limit);



			while ($rows = mysqli_fetch_array($result_limit)) { ?>

			<div class="col-lg-12">
				<div class="card mb-2">
					<div class="card-body m-2">
						<div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body table-reponsive" style="background-color: rgb(219, 235, 247);" >
										<table class="table table-borderless">
											<thead class="mb-4">
											</thead>
											<tbody style="font-size: 17px;">
												<tr>
													<p class="fw-bold fs-5 "> Question:</p>
												</tr>
												 <tr>
												 	<th>
												 		<b><span><?php echo $number ?>.&nbsp;<?php echo $rows['questions_title']; ?></span></b>
												 	</th>
												 </tr>
												 <tr>
												 	<td><span><input class="form-check-input pl-4 ms-5 my.checkbox " type="radio" name="examcheck[<?php echo $rows['question_id'] ?>]" id="rd1" value="A"> A. <?php echo $rows['option_a']; ?></span></td>
												 </tr>
												 <tr>
												 	<td><span><input class="form-check-input pl-4 ms-5 my.checkbox" type="radio" name="examcheck[<?php echo $rows['question_id'] ?>]" id="rd2" value="B"> B.<?php echo $rows['option_b']; ?></span></td>
												 </tr>
												 <tr>
												 	<td><span><input class="form-check-input pl-4 ms-5 my.checkbox" type="radio" name="examcheck[<?php echo $rows['question_id'] ?>]" id="rd3" value="C"> C. <?php echo $rows['option_c']; ?></span></td>
												 </tr>
												 <tr>
												 	<td><span><input class="form-check-input pl-4 ms-5 my.checkbox" type="radio" name="examcheck[<?php echo $rows['question_id'] ?>]" id="rd4" value="D"> D. <?php echo $rows['option_d']; ?></span></td>
												 </tr>

											</tbody>
													<input type="hidden" name="pre_exam_id" value="<?php echo $rows['pre_exam_id']; ?>">
													<input type="hidden" name="update_pre_question" value="<?php echo $code; ?>">
													<input type="hidden" name="sub_acc_id" value="<?php echo $_SESSION['acc_id']; ?>">
													<input type="hidden" name="total_quest" value="<?php echo $rows['total_question']; ?>">
										</table>
									</div>
								</div>
							</div>
						</div>
						
						
					</div>
				</div>
			</div>
			<?php
				$number++;
				}

				$loan = array();

				$buss = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question,tbl_pre_choose_quest,test_question WHERE (tbl_pre_question.pre_exam_id=tbl_pre_choose_quest.pre_exam_id) AND (tbl_pre_question.access_code = '$code') AND (tbl_pre_choose_quest.question_id = test_question.question_id)");

				while ($gpr = mysqli_fetch_assoc($buss)) {
					
					$loan[] = $gpr;
				}

				foreach ($loan as $valued) {
						
					echo '<input type="hidden" class="input-control" name="question_di[]" value="'.$valued['question_id'].'">';
				}
			?>

		</div>
		<div class="d-flex justify-content-center mt-3">
			<!-- submit button -->
		   <input type="submit" value="submit" class="btn btn-success rounded  mx-2 px-5 pb-2 d-flex text-uppercase btn-lg">
		</div>
		
	</form>
</div>
</body>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="../TimeCircles-master/inc/TimeCircles.js"></script>
<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function(){
  window.addEventListener('scroll', function() {
      if (window.scrollY > 50) {
        document.getElementById('timer').classList.add('fixed-top');
        // add padding top to show content behind navbar
        navbar_height = document.querySelector('.card').offsetHeight;
        document.body.style.paddingTop = navbar_height + 'px';
      } else {
        document.getElementById('timer').classList.remove('fixed-top');
         // remove padding top from body
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
      document.getElementById('form2').submit();
    }

    var tm = setTimeout(function(){setInterval()},1000)
  },2000);


</script>
</html>