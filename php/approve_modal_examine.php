<?php

require_once 'conn.php';

$userid =  $_POST['userid']; 


$prep = mysqli_query($sqlcon,"SELECT * FROM tbl_pre_question WHERE pre_exam_id='$userid'");

while ($row = mysqli_fetch_assoc($prep)) { ?>

<form class="form" action="../admin/exam_approve.php" method="POST">
    <div class="modal-body">
        <div class="container d-flex justify-content-center">
            <input type="hidden" name="update_id" value="<?php echo $row['pre_exam_id']; ?>">
            <input type="hidden" name="access" value="<?php echo $row['access_code']; ?>">
            <input type="hidden" name="prepared_by" value="<?php echo $row['prepared_by']; ?> ">
        </div>
        <div class="modal-footer d-flex justify-content-center border-0">
            <input type="submit" name="save" class="btn btn-success px-5 pb-2 text-white" value="YES">
            <button  type="button" data-id="<?php echo $row['pre_exam_id']; ?>" class="btn btn-danger px-5 pb-2 text-white nobtn"  data-bs-toggle="modal" data-bs-dismiss="modal">NO</button>
            <button type="button" class="btn btn-secondary  px-4 pb-2 text-white" data-bs-dismiss="modal">CANCEL</button>
        </div>
    </div>
</form>

<?php } ?>



  <!-- View modal --->
 <script type="text/javascript">

   $(document).ready(function(){
    $('.nobtn').click(function(){
      var userids = $(this).data('id');

      $.ajax({
        url: '../php/reject_modal_examine.php',
        type: 'post',
        data: {userids: userids},
        success: function(response){
          $('.viewser').html(response);
          $('#editer').modal('show');
        }
      });
    });
   });
 </script>



