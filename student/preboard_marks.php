<?php

session_start();
require_once '../php/conn.php';

$userid =  $_POST['userid'];

$view_code = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question WHERE pre_exam_id='$userid'");

while ($rows = mysqli_fetch_assoc($view_code)) { ?>

	<form action="student_access.php" method="POST">
	<?php if (isset($_GET['error'])) { ?>
          <p class="error"><center><b style="color: red;"><?php echo $_GET['error'];  ?></b></center></p>
        <?php }  
        ?>
        <div class="form-group d-flex justify-content-center">
        	<input type="hidden" name="acc_id" value="<?php echo $_SESSION['acc_id']; ?>">
        	<input type="hidden" name="pre_exam" value="<?php echo $rows['pre_exam_id']; ?>">
            <input type="text" class="form-control" name="access_code" placeholder="Enter Access Code">
            
        </div>
        <div class="modal-footer d-flex justify-content-center border-0">
            <input type="submit" name="save" class="btn btn-success px-5 pb-2 text-white" value="Enter">
        </div>
    </form>
<?php } ?>