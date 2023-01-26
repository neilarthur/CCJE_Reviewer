<?php

	require_once '../php/conn.php';

	$scoreA = 0;
	$scoreB = 0;
	$scoreC = 0;
	$scoreD = 0;

	$userid =  $_POST['userid'];

	$view1 = mysqli_query($sqlcon,"SELECT * FROM test_question,tbl_pre_student_ans WHERE (test_question.question_id=tbl_pre_student_ans.question_id) AND (tbl_pre_student_ans.pre_exam_id='{$_GET['id']}') AND test_question.question_id='$userid'");

	$num_rows = mysqli_num_rows($view1);

	while (list($question_id,$subject_name,$level_difficulty,$questions_title,$option_a,$option_b,$option_c,$option_d,$correct_ans,$acc_id,$status,$date_created,$student_ans_id,$exam_check) = mysqli_fetch_row($view1)) {

		$larv = $exam_check;

		$sign = $correct_ans;


		if ($sign = 'A') {

			$data[]
		}


		#di ako sure sa compute by
	$marks = round(($scoreA/$num_rows)*100);
	$marksB = round(($scoreB/$num_rows)*100);
	$marksC = round(($scoreC/$num_rows)*100);
	$marksD = round(($scoreD/$num_rows)*100);
	?>
	<canvas id="myChart" style="height: 100px; width: 250px;"></canvas>
	<script>
		const ctx = document.getElementById('myChart').getContext('2d');
		const myChart = new Chart(ctx, {
		    type: 'bar',
		    data: {
		        labels: ['A. Murder','B.  Parricide','C. Homicide','D. Qualified Homicide'],
		        datasets: [{
		            label: 'Correct Response',
		            data: [10,9,8,6],
		            backgroundColor: [
		            'rgba(15, 157, 88)',
		            'rgba(204, 204, 204)',
		            'rgba(204, 204, 204)',
		            'rgba(204, 204, 204)',
		                
		                
		            ],
		            borderColor: [
		            'rgb(15, 157, 88)',
		            'rgb(204, 204, 204)',
		            'rgb(204, 204, 204)',
		            'rgb(204, 204, 204)',
		                
		            ],
		            borderWidth: 1
		        }]
		    },
		    options: {
		    	indexAxis: 'y',
		        scales: {
		            y: {
		               ticks: { color: '##000000', beginAtZero: true , precision: 0 }
		            }
		        }
		    },
		});
	</script>
</div>
<div class="card mt-3 m-4 border-0">
	<div class="card-body">
		<label class="d-flex ps-1 justify-content-start">Question</label>
		<textarea type="text" name="last_name" class="form-control"readonly="">Berto, with evident premeditation and treachery killed his father. What was the crime committed?</textarea> 
		<label class="d-flex ps-1 mt-2 justify-content-start" >Area of Exam</label>
		<input type="text" name="last_name" class="form-control" value="Criminal Jurisprudence " readonly="">
		<label class="d-flex ps-1 mt-2 justify-content-start">Level of diffculty</label>
		<input type="text" name="last_name" class="form-control" value="EASY" readonly="">
		<label  class="d-flex ps-1 mt-2 justify-content-start">Percentage</label>
		<input type="text" name="last_name" class="form-control" value="100%" readonly="">
	</div>		
</div>