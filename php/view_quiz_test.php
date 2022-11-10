<?php


require_once 'conn.php';

$userid =  $_POST['userid'];

$view_quiz = mysqli_query($sqlcon, "SELECT * FROM test_question,student_choice WHERE (test_question.question_id = student_choice.question_id) AND test_question.question_id = '$userid'");

while ($rows = mysqli_fetch_assoc($view_quiz)) { ?>

	<div class="table-responsive">
		<table  class="align-middle mb-0 table table-borderless">
			<thead class="mb-4">
				<th class="text-left pl-1 fs-5">Question: </th>
			</thead>
			<tbody style="font-size: 17px;">
				<tr>
					<th>
						<b><span><?php echo $rows['questions_title']; ?></span>
					</th>
				</tr>
				<tr>
					<td>
						<span><input   class="form-check-input pl-4 ms-5" type="radio"  id="exampleRadios1" value="A" disabled > A. <?php echo $rows['option_a']; ?></span>
					</td>
				</tr>

				<tr>
					<td>
						<span><input   class="form-check-input pl-4 ms-5" type="radio"  id="exampleRadios1" value="B" disabled > B. <?php echo $rows['option_b']; ?></span>
					</td>
				</tr>

				<tr>
					<td>
						<span><input   class="form-check-input pl-4 ms-5" type="radio"  id="exampleRadios1" value="C" disabled > C. <?php echo $rows['option_c']; ?></span>
					</td>
				</tr>

				<tr>
					
				</tr>

					<td>
						<span><input   class="form-check-input pl-4 ms-5" type="radio"  id="exampleRadios1" value="D" disabled > D. <?php echo $rows['option_d']; ?></span>
					</td>
				</tr>
				</tr>

					<td>
						<span class="text-success"><b class="me-2">Correct Answer:</b><b  class=" pl-4"  id="exampleRadios1">&nbsp;<?php echo $rows['correct_ans']; ?>&nbsp;. <?php if ($rows['correct_ans'] =='A') {
							echo $rows['option_a']; }elseif ($rows['correct_ans'] =='B') { echo $rows['option_b'];}elseif ($rows['correct_ans']== 'C') { echo $rows['option_c'];}elseif ($rows['option_d']) { echo $rows['option_d'];} ?></b></span>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
<?php }


?>