<?php


require_once 'conn.php';

$userid =  $_POST['userid'];

$view_quiz = mysqli_query($sqlcon, "SELECT * FROM test_question WHERE question_id = '$userid'");

while ($rows = mysqli_fetch_assoc($view_quiz)) { ?>

	<div class ="table responsive" >
	<table class="align-middle mb-0 table table-borderless table-striped table-hover" id="quesTab">
		<thead class="mb-4">
			<tr>

				<th class="col">Area of Exam</th>
				<th class="col">Level of Difficulty</th>
				<th class="text-left pl-1">Question</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php echo $rows['subject_name']; ?></td>
				<td><?php echo $rows['level_difficulty']; ?></td>
				<td>
					<b><?php echo $rows['questions_title']; ?></b><br>
					<span class="pl-4 text-success ms-4">A.<?php echo $rows['option_a']; ?></span><br>
					<span class="pl-4 text-success ms-4">B.<?php echo $rows['option_b']; ?></span><br>
					<span class="pl-4 text-success ms-4">C.<?php echo $rows['option_c'];?></span><br>
					<span class="pl-4 text-success ms-4">D.<?php echo $rows['option_d']; ?></span><br>
					<b class="text-success fw-bold">Correct answer:<?php echo $rows['correct_ans']; ?>.<?php if ($rows['correct_ans'] =='A') {
						echo $rows['option_a']; }elseif ($rows['correct_ans']=='B') { echo $rows['option_b'];}elseif ($rows['correct_ans']=='C') {echo $rows['option_c'];}elseif ($rows['correct_ans']=='D') {
							echo $rows['option_d'];}  ?></b><br>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<?php } ?>