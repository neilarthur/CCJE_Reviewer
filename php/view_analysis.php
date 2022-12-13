<!-- Bootstrap CSS -->
<link href="../css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">

<?php

session_start();

require_once 'conn.php';

$scoreA = 0;
$scoreB = 0;
$scoreC = 0;
$scoreD = 0;

$userid =  $_POST['userid'];




$view = mysqli_query($sqlcon, "SELECT * FROM test_question,tbl_pre_student_ans WHERE (test_question.question_id=tbl_pre_student_ans.question_id) AND test_question.question_id = '$userid' AND tbl_pre_student_ans.question_id='$userid' AND (tbl_pre_student_ans.pre_exam_id='{$_GET['id']}')");

$num_rows = mysqli_num_rows($view);

while (list($question_id,$subject_name,$level_difficulty,$questions_title,$option_a,$option_b,$option_c,$option_d,$correct_ans,$acc_id,$status,$date_created,$student_ans_id,$exam_check) = mysqli_fetch_row($view)) { 

	if ($exam_check == 'A') {
		$scoreA++;
	}
	elseif ($exam_check == 'B') {
		$scoreB++;
	}
	elseif ($exam_check =='C') {
		$scoreC++;
	}
	elseif ($exam_check =='D') {
		$scoreD++;
	}

		#di ako sure sa compute by
		$marks = round(($scoreA/$num_rows)*100);
		$marksB = round(($scoreB/$num_rows)*100);
		$marksC = round(($scoreC/$num_rows)*100);
		$marksD = round(($scoreD/$num_rows)*100);

	?>

	<h4 class="d-flex ps-1 fw-bold justify-content-start">Question:</h4>
		<textarea type="text" name="last_name" class="form-control mt-3 ps-2 mb-3 bg-white" rows="3" readonly=""><?php echo $questions_title; ?></textarea> 
		<div class="row mb-2">
			<div class="col-md-6">
				<label class="d-flex ps-1 justify-content-start fw-bold">Option A</label>
				<textarea type="text" name="option_a" class="form-control " rows="2" readonly= ""><?php echo $option_a ?></textarea>
			</div>
			<div class="col-md-6">
				<div class="card h-100">
					<div class="card-body">
						<p>Count: <span class="fw-bold"><?php echo $scoreA; ?></span> (<?php echo $marks; ?>%)</p>
						<div class="progress"  style="height:25px">
							<div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: <?php echo $marks; ?>%" aria-valuenow="<?php echo $marks; ?>" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mb-2">
			<div class="col-md-6">
				<label class="d-flex ps-1 justify-content-start fw-bold">Option B</label>
				<textarea type="text" name="option_a" class="form-control" rows="2" readonly= ""><?php echo $option_b ?></textarea>
			</div>
			<div class="col-md-6">
				<div class="card h-100">
					<div class="card-body">
						<p>Count:<span class="fw-bold"><?php echo $scoreB; ?></span> (<?php echo $marksB; ?>%)</p>
						<div class="progress" style="height:25px">
							<div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: <?php echo $marksB; ?>%" aria-valuenow="<?php echo $marksB; ?>" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mb-2">
			<div class="col-md-6">
				<label class="d-flex ps-1 justify-content-start fw-bold">Option C</label>
				<textarea type="text" name="option_a" class="form-control" rows="2" readonly= ""><?php echo $option_c ?></textarea>
			</div>
			<div class="col-md-6">
				<div class="card h-100">
					<div class="card-body">
						<p>Count:  <span class="fw-bold"><?php echo $scoreC; ?></span> (<?php echo $marksC; ?>%)</p>
						<div class="progress" style="height:25px">
							<div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: <?php echo $marksC; ?>%" aria-valuenow="<?php echo $marksC ?>" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label class="d-flex ps-1 justify-content-start fw-bold">Option D</label>
				<textarea type="text" name="option_a" class="form-control" rows="2" readonly= ""><?php echo $option_d ?></textarea>
			</div>
			<div class="col-md-6">
				<div class="card h-100">
					<div class="card-body">
						<p>Count: <span class="fw-bold"><?php echo $scoreD; ?></span> (<?php echo $marksD; ?>%)</p>
						<div class="progress" style="height:25px">
							<div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: <?php echo $marksD; ?>%"  aria-valuenow="<?php echo $marksD; ?>" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

<?php } ?>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/accessibility.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="../js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../js/dt-1.10.25datatables.min.js"></script>