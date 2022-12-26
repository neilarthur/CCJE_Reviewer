<?php 

require_once 'conn.php';

$userid =  $_POST['userid'];

$say =  "SELECT * FROM tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND (tbl_exam_result.exam_result_id = '$userid')";

$exam = mysqli_query($sqlcon, $say);

while ($rows =mysqli_fetch_assoc($exam)) {

echo '<div class="modal-body">
<div class="card" style="border-style: none;">
	<div class="card-body">
		

		 
		 	<div class="row">
		 	<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 py-2 me-5">
		 		<img src="data:image;base64,'.base64_encode($rows["image_size"]).'" id="img" alt="preview" class="rounded-circle mb-3" height="200px" width="200px"  style=" object-fit: cover;">'

		 ?>
		 	<span>Email address: <p class="fw-bold"><?php echo $rows['email_address']; ?></p></span>
		 	</div>
		 	<div class="col-lg-7">
		 		<label class="d-flex ps-1 justify-content-start fw-bold" >Name</label>
			<input type="text" name="last_name" class="form-control" value="<?php echo $rows['last_name']." ".$rows['first_name']." ".$rows['middle_name']?> ">
			<label class="d-flex ps-1 mt-2 justify-content-start fw-bold">Section</label>
			<input type="text" name="last_name" class="form-control" value="<?php echo $rows['section']; ?>">
			<label  class="d-flex ps-1 mt-2 justify-content-start fw-bold">Area of Examination</label>
			<input type="text" name="last_name" class="form-control" value="<?php echo $rows['subjects']; ?>">
			<label  class="d-flex ps-1 mt-2 justify-content-start fw-bold">Score</label>
			<input type="text" name="last_name" class="form-control" value="<?php echo $rows['score']; ?>">
			<label  class="d-flex ps-1 mt-2 justify-content-start fw-bold">Percentage</label>
			<input type="text" name="last_name" class="form-control" value="<?php echo $rows['score_percent']; ?>.00%">
			<label  class="d-flex ps-1 mt-2 justify-content-start fw-bolder">Total corect answers</label>
			<input type="text" name="last_name" class="form-control" value="<?php echo $rows['score']; ?> out of <?php echo $rows['total_question']; ?>">
		 	</div>
		 </div>
<?php } ?>