<?php

session_start();
require_once '../php/conn.php';

$exam_id =  $_POST['exam_id'];

$view_code = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question WHERE pre_exam_id='$exam_id'");

while ($rows = mysqli_fetch_assoc($view_code)) { ?>

	<form action="function_response.php" method="POST">
        <div class="form-group d-flex justify-content-center">
        	<input type="hidden" name="acc_id" value="<?php echo $_SESSION['acc_id']; ?>">
        	<input type="hidden" name="test_id" value="<?php echo $rows['pre_exam_id']; ?>">
            <textarea type="text" class="form-control " name="response" rows="3" required></textarea>
            
        </div>
        <div class="modal-footer d-flex justify-content-center border-0">
            <input type="submit" name="subs" class="btn btn-success px-5 pb-2 text-white" value="SUBMIT">
        </div>
    </form>
<?php } ?>