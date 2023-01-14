<link rel="stylesheet" href="../css/jquery.durationpicker.css">

<?php

require_once 'conn.php';


$userid =  $_POST['userid']; 

$say =  "SELECT * FROM tbl_pre_question WHERE pre_exam_id= '$userid'";

$results = mysqli_query($sqlcon, $say);


while ($row = mysqli_fetch_array($results)) { ?>
 
<form action="update_pre_board.php" method="POST">
	<div class="modal-body">
		<div class="row">
      		<div class="col-lg-6">
      			<div class="card h-100">
      				<div class="card-body">
                <input type="hidden" name="update_id" value="<?php echo $row['pre_exam_id']; ?>">
      					<label  class="form-label fw-bold">Description</label>
      					<textarea type="text" class="form-control " name="description" placeholder="Answer the following" rows="7" required><?php echo $row['description'] ?></textarea>
      				</div>
      			</div>
      		</div>
      		<div class="col-lg-6">
      			<div class="card h-100">
      				<div class="card-body">
						<div class="input-group mt-2">
							<span class="input-group-text border-0 bg-white fw-bold">Area of Exam</span>
							<select class="form-select" name="subjects" id="subjects" required>
								<option selected value="<?php echo $row['subjects'] ?>"><?php echo $row['subjects'] ?></option>
								<option value="Criminal Jurisprudence">Criminal Jurisprudence</option>
								<option value="Law Enforcement">Law Enforcement</option>
								<option value="Criminalistics">Criminalistics</option>
								<option value="Crime Detection and Investigation">Crime Detection and Investigation</option>
								<option value="Criminal Sociology">Criminal Sociology</option>
								<option value="Correctional Administration">Correctional Administration</option>
							</select>
						</div>
						<div class="input-group mt-2">
							<span class="input-group-text border-0 bg-white fw-bold">Total of questions</span>
							<select class="form-control" name="t_question" id="total_questions" required>
								<option value="<?php echo $low['total_quest'] ?>" selected><?php echo $row['total_question'] ?></option>

                <?php
                for($i = 100; $i >= 20; $i-=20){

                  echo ' <option>'.$i.'</option>';
                }
                ?>

							</select>
						</div>
						<div class="mt-2">
							<div class="input-group ">
								<span class="input-group-text border-0 bg-white fw-bold me-3">Time limit</span>
								<label id="btn-example4"  type="text" hidden  style="font-size: 13px;"></label>
								<input name="time_limit" class="form-control" required value="<?php echo $row['time_limit']?>" />
		          </div>
      			</div>
      					<input type="hidden" name="prepared_by" value="<?php echo $_SESSION['acc_id'] ?>">
      				</div>
      			</div>
      		</div>
      	</div>
      </div>
      <div class="modal-footer d-flex justify-content-center border-0 mt-3 mb-2">
      	<button type="submit" name="create" onclick="getInputValue();"  class="btn btn-success" ><i class="fas fa-save me-2"></i>Save and Display</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times me-2"></i>Cancel</button>
      </div>
  </form>

<?php } ?>


<script src="../js/jquery.durationpicker.js"></script>
<script>
$(document).ready(function() {

	function getInputValue() {  // A method is used to get input value
     let value = document.getElementById("btn-example4").value;
     alert(value);     // Display the value
   }
   
    $('input[name=time_limit]').durationpicker({showDays: false})
    .on("change", function(){
        $('#btn-example4').text( $(this).val() +"(secs)");
    });

});
</script>