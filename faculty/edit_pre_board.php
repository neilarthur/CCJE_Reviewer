<?php

require_once '../php/conn.php';

$userid = $_POST['userid'];

$say = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question WHERE pre_exam_id = '$userid'");


while ($bows = mysqli_fetch_assoc($say)) {


	$dow = $bows['time_limit'] /60;

	?>
<form class="form" action="../php/update_pre_board.php" method="POST">
	<div class="card border-0">
		<div class="card-body m-2">
			<div class="mb-3">
				<label  class="form-label">Description</label>
				<input type="hidden" name="update_id" value="<?php echo $bows['pre_exam_id']; ?>">
				<textarea type="text" class="form-control" name="description" rows="2"><?php echo $bows['description']; ?></textarea>
			</div>
			<div class="row">
				<div class="col-sm-5">
					<div class="mb-3">
						<label  class="form-label">Subject Exam</label>
						<div class="form-group">
							<select class="form-select" name="subjects" id="subjects">
								<option selected><?php echo $bows['subjects']; ?></option>
								<option value="Criminal Jurisprudence">Criminal Jurisprudence</option>
								<option value="Law Enforcement">Law Enforcement</option>
								<option value="Criminalistics">Criminalistics</option>
								<option value="Crime Detection and Investigation">Crime Detection and Investigation</option>
								<option value="Criminal Sociology">Criminal Sociology</option>
								<option value="Correctional Administration">Correctional Administration</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="mb-2">
						<label class="form-label">Level of Difficulty</label>
						<div class="input-group">
							<select class="form-select custom-select mb-3  difficult" name="difficult" id="difficult">
								<option selected><?php echo $bows['levels_name']; ?></option>
								<option value="Easy">Easy</option>
								<option  value="Moderate">Moderate</option>
								<option value="Hard">Hard</option>
							</select>
							<input type="hidden" name="hidden_exam" id="hidden_exam" />
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="mb-3">
						<label class="form-label">Time Limit</label>
						<div class="form-group">
							<select class="form-select" name="time_limit" id="time_limit">
								<option selected value="<?php echo $bows['time_limit'] ?>"><?php echo $bows['time_limit'] /60 ?> mins</option>
								<?php

		                          if ($bows['time_limit']=='1200') { ?>
		                          <option value="1200">20 mins</option>
		                          <option value="1800">30 mins</option>
		                          <option value="3600">1 hr</option>
		                          <option value="7200">2 Hours</option>
		                          <option value="10800">3 hours</option>

		                          <?php } elseif ($bows['time_limit']=='1800') { ?>
		                          <option value="1200">20 mins</option>
		                          <option value="1800">30 mins</option>
		                          <option value="3600">1 hr</option>
		                          <option value="7200">2 Hours</option>
		                          <option value="10800">3 hours</option>

		                          <?php } elseif ($bows['time_limit']=='3600') { ?>
		                          <option value="1200">20 mins</option>
		                          <option value="1800">30 mins</option>
		                          <option value="3600">1 hr</option>
		                          <option value="7200">2 Hours</option>
		                          <option value="10800">3 hours</option>

		                          <?php } elseif ($bows['time_limit']=='7200') { ?>
		                          <option value="1200">20 mins</option>
		                          <option value="1800">30 mins</option>
		                          <option value="3600">1 hr</option>
		                          <option value="7200">2 Hours</option>
		                          <option value="10800">3 hours</option>

		                          <?php } elseif ($bows['time_limit']=='10800') { ?>
		                          <option value="1200">20 mins</option>
		                          <option value="1800">30 mins</option>
		                          <option value="3600">1 hr</option>
		                          <option value="7200">2 Hours</option>
		                          <option value="10800">3 hours</option>
		                          <?php } ?>
		                    </select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="mb-3">
							<label class="form-label">Total of Questions</label>
							<div class="form-group">
								<select class="form-select" name="t_question" id="total_questions">
										<?php
											for($i = 100; $i >= 20; $i-=20){

												echo ' <option>'.$i.'</option>';
											}
											?>

								</select>
							</div>
						</div>
					</div>
					
					<div class="col-sm-4">
						<div class="mb-3">
							<label class="form-label">Access Code</label>
							<input type="text" class="form-control" name="access_code" value="<?php echo $bows['access_code']; ?>" readonly>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer d-flex justify-content-center border-0 mb-2">
		<button type="submit" name="save" class="btn btn-success px-4 pb-2 text-white"><i class="fas fa-save me-2"></i>Save Change</button>
		<button type="button" class="btn btn-danger btn  px-5 pb-2 text-white" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>Close</button>
	</div>
</form>

<?php
 } 
?>