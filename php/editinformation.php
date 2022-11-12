<link rel="stylesheet" href="../css/jquery.durationpicker.css">

<?php

require_once 'conn.php';


$userid =  $_POST['userid']; 

$say =  "SELECT * FROM choose_question WHERE test_id= '$userid'";

$results = mysqli_query($sqlcon, $say);


while ($row = mysqli_fetch_array($results)) { ?>
 
		<div class="row">
      		<div class="col-lg-6">
      			<div class="card h-100">
      				<div class="card-body">
      					<label  class="form-label fw-bold">Title</label>
      					<input type="text" class="form-control mb-3" name="title" placeholder="Untitled form" required>
      					<label  class="form-label fw-bold">Description</label>
      					<textarea type="text" class="form-control " name="description" placeholder="Answer the following" rows="7" required></textarea>
      				</div>
      			</div>
      		</div>
      		<div class="col-lg-6">
      			<div class="card">
      				<div class="card-body">
      					<div class="input-group">
      						<span class="input-group-text  border-0 bg-white fw-bold">Section</span>
							<select class="form-select " name="class_section" required>
								<option selected value="4A">4A</option>
								<option value="4B">4B</option>
								<option value="4C">4C</option>
							</select>
						</div>
						<div class="input-group mt-2">
							<span class="input-group-text border-0 bg-white fw-bold">Type of Test</span>
							<select class="form-select" name="type_exam" required>
								<option selected alue="Quiz">Quiz</option>
								<option value="LongQuiz">Long Quiz</option>
							</select>
						</div>
						<div class="input-group mt-2">
							<span class="input-group-text border-0 bg-white fw-bold">Area of Exam</span>
							<select class="form-select" name="subjects" id="subjects" required>
								<option selected value="">Select Category</option>
								<option value="Criminal Jurisprudence">Criminal Jurisprudence</option>
								<option value="Law Enforcement">Law Enforcement</option>
								<option value="Criminalistics">Criminalistics</option>
								<option value="Crime Detection and Investigation">Crime Detection and Investigation</option>
								<option value="Criminal Sociology">Criminal Sociology</option>
								<option value="Correctional Administration">Correctional Administration</option>
							</select>
						</div>
						<div class="input-group mt-2">
							<span class="input-group-text border-0 bg-white fw-bold">Level of difficulty</span>
							<select class="form-select custom-select difficult" name="difficult" id="difficult" required>
								<option selected value="">Select Difficulty</option>
								<option value="Easy">Easy</option>
								<option  value="Moderate">Moderate</option>
								<option value="Hard">Hard</option>
							</select>
							<input type="hidden" name="hidden_exam" id="hidden_exam" />
						</div>
						<div class="input-group mt-2">
							<span class="input-group-text border-0 bg-white fw-bold">Total of questions</span>
							<select class="form-control" name="t_question" id="total_questions" required>
								<?php
  								for($i = 5; $i <= 50; $i+=5){

  									echo ' <option>'.$i.'</option>';
  								}
  								?>

							</select>
						</div>
						<div class="mt-2">
							<div class="input-group ">
								<span class="input-group-text border-0 bg-white fw-bold me-3">Time limit</span>
								<label id="btn-example4"  type="text" hidden  style="font-size: 13px;"></label>
								<input name="time_limit" class="form-control" required/>
		                    </div>
      					</div>
      					<input type="hidden" name="prepared_by" value="<?php echo $_SESSION['acc_id'] ?>">
      					<div class="input-group mt-2">
      						<span class="input-group-text border-0 bg-white fw-bold">Open the quiz</span>
      					    <input type="date" name="start_time" class="form-control" required=>
      					</div>
      					<div class="input-group mt-2">
      						<span class="input-group-text border-0 bg-white fw-bold">Close the quiz</span>
      					    <input type="date" name="close_time" class="form-control" required= >
      					</div>
      				</div>
      			</div>
      		</div>
      	</div>
      	 <div class="modal-footer d-flex justify-content-center border-0 mt-3 mb-2">
      	<button type="submit" name="create" onclick="getInputValue();"  class="btn btn-success" ><i class="fas fa-save me-2"></i>Save and Display</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>Cancel</button>
      </div>

<?php } ?>

<script src="../js/jquery.durationpicker.js"></script>