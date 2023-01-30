<?php

session_start();
require_once '../php/conn.php';

$userid =  $_POST['userid'];

$view_code = mysqli_query($sqlcon,"SELECT * FROM choose_question WHERE test_id='$userid'");

while ($rows = mysqli_fetch_assoc($view_code)) { ?>

	<form action="function_response.php" method="POST">
        <div class="form-group d-flex justify-content-center">
        	<input type="hidden" name="acc_id" value="<?php echo $_SESSION['acc_id']; ?>">
        	<input type="hidden" name="test_id" value="<?php echo $rows['test_id']; ?>">
            <textarea type="text" class="form-control mx-3" name="response" rows="3" required></textarea>
            
        </div>
        <div class="modal-footer d-flex justify-content-center border-0 mt-3">
            <input type="submit" name="subs" class="btn btn-success px-5 pb-2 text-white" value="SUBMIT">
        </div>
    </form>
<?php } ?>