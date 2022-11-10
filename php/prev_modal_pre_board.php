<?php


require_once 'conn.php';

$userid =  $_POST['userid'];

$view_quiz = mysqli_query($sqlcon, "SELECT * FROM test_question,tbl_pre_choose_quest WHERE (test_question.question_id = tbl_pre_choose_quest.question_id) AND test_question.question_id = '$userid'");

while ($rows = mysqli_fetch_assoc($view_quiz)) { ?>
	<div class="card">
	<div class="card-body bg-white">
		<div class="card m-2">
			<div class="card-body" style="background-color: rgb(219, 235, 247);">
				<table class="align-middle mb-0 table table-borderless " >
					<thead class="mb-4">
						<th class="text-left pl-1 fs-5">Question:</th>
					</thead>
					<tbody style="font-size: 17px;">
						<tr>
							<th>
								<b><span><?php echo $rows['questions_title']; ?></span></b>
							</th>
						</tr>
					   		<tr>
					   			<td>
					   				<span><input   class="form-check-input pl-4 ms-5" type="radio"  id="exampleRadios1" value="A" disabled > A. <?php echo $rows['option_a']; ?></span>
					   			</td>
                        </tr>
                        <tr>
					   			<td>
					   				<span><input   class="form-check-input pl-4 ms-5" type="radio"  id="exampleRadios1" value="A" disabled > B. <?php echo $rows['option_b']; ?></span>
					   			</td>
                        </tr>
                        <tr>
					   			<td>
					   				<span><input   class="form-check-input pl-4 ms-5" type="radio"  id="exampleRadios1" value="A" disabled > C. <?php echo $rows['option_c']; ?></span>
					   			</td>
                        </tr>
                        <tr>
					   			<td>
					   				<span><input   class="form-check-input pl-4 ms-5" type="radio"  id="exampleRadios1" value="A" disabled > D. <?php echo $rows['option_d']; ?></span>
					   			</td>
                        </tr>
                        </tr>

						<td>
							<span class="text-success"><input   class="form-check-input pl-4 ms-5" type="radio"  id="exampleRadios1" checked="" disabled >&nbsp;<?php echo $rows['correct_ans']; ?>&nbsp;&nbsp;.<?php if ($rows['correct_ans'] =='A') {
								echo $rows['option_a']; }elseif ($rows['correct_ans'] =='B') { echo $rows['option_b'];}elseif ($rows['correct_ans']== 'C') { echo $rows['option_c'];}elseif ($rows['option_d']) { echo $rows['option_d'];} ?></span>
						</td>
					</tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php }


?>