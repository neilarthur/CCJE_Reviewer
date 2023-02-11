<?php

require_once 'conn.php';

$userids =  $_POST['userids']; 


$preps = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question WHERE pre_exam_id='$userids'");

while ($rows = mysqli_fetch_assoc($preps)) { ?>

<form class="form" action="../admin/exam_approve.php" method="POST">
     <div class="modal-body">

        <div class="form-floating">
            <textarea class="form-control" name="comment" placeholder="Leave a comment here" id="floatingTextarea"  style="height: 120px"></textarea>

            <label for="floatingTextarea">Leave a comment here:</label>
        </div>
        <input type="hidden" name="update_id" value="<?php echo $rows['pre_exam_id']; ?>">
    </div>
    <div class="modal-footer border-0">
        <input type="submit" name="reject" class="btn btn-success px-5 pb-2 text-white" value="SEND">
        <button class="btn btn-secondary px-5 pb-2" data-bs-target="#edit" data-bs-toggle="modal" data-bs-dismiss="modal">BACK</button>
    </div>
</form>

<?php } ?>