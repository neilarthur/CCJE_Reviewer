<?php

session_start();

require_once 'conn.php';

$id = $_SESSION['acc_id'];

$difficult = $_POST['difficult'];
$subjects = $_POST['subjects'];

$sql=mysqli_query($sqlcon,"SELECT * FROM `test_question` WHERE `acc_id`='$id' AND  level_difficulty LIKE '%$difficult%' AND `subject_name` LIKE '%$subjects%' ");


 ?>
<link href="../css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/datatables-1.10.25.min.css" />
 <div class="table-responsive">

  <table class="table table-hover bg-light" style="font-size: 15px;" id="pre_board">
    <thead>
      <tr>
        <th><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></th>  
        <th scope="col">Question</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php

      if (mysqli_num_rows($sql) ==0) { ?>

        <tr class="table-danger">
          <td></td>
          <td class="text-center">No Record of Question yet.</td>
          <td></td>
        </tr>

      <?php } elseif (mysqli_num_rows($sql) >0) { ?>

        <?php 
        while ($now = mysqli_fetch_assoc($sql)) { $_SESSION['exam'] = $now['question_id'];  ?>

          <tr>
            <td><input type="checkbox" class="checkbox" name="chkl[]" id="question_id<?php echo $now['question_id'];  ?>"  value="<?php echo $_SESSION['exam'] ?>" data-id="<?php echo $now['question_id']; ?>"></td>
            <td><?php echo $now['questions_title']; ?></td>
            
              <td><button data-id="<?php echo $now['question_id']; ?>"  type="button" class="btn btn-primary popover-test view_btn" data-bs-toggle="modal" data-bs-target="#exampleModalToggle2" data-bs-dismiss="modal"><i class="fas fa-eye"></i></button></td>
          </tr>
        <?php } ?>

      <?php } ?>
    </tbody>
  </table>
 </div>
  
<script src="../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/dt-1.10.25datatables.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#student').DataTable({
      paging: true
    });
  });
</script>


<script type="text/javascript">
  // $(".checkbox").on("click" ,function(){
    
  // })

  $(document).ready(function(){

    var $checkboxes = $('#example_test td input[type="checkbox"]');
        
    $checkboxes.change(function(){
        var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
        var total_question = $("#total_questions").val();
        var id = $(this).data("id");
        var check_box = $("question_id"+id)
        // alert(countCheckedCheckboxes);
        // alert(total_question);
        
        if (countCheckedCheckboxes>total_question) {
           if($(this).prop("checked") == true){
              alert("Questions already rich the limit of the test." );
             $(this).prop('checked', false);
            }
        }
    
    });

});

  function validate_question(){
      var $checkboxes = $('#example_test td input[type="checkbox"]');
         
        var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
        var total_question = $("#total_questions").val();
       
        
        if (countCheckedCheckboxes < total_question) { 
             alert("The selected questions is less than the total questions in the test." ); 
             return false;
         } 

         return true;
    } 
</script>

<!-- preview modal --->
 <script type="text/javascript">

   $(document).ready(function(){
    $('.view_btn').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: '../php/view_modal_pre_editing.php',
        type: 'post',
        data: {userid: userid},
        success: function(response){
          $('.logs').html(response);
          $('#exampleModalToggle2').modal('show');
        }
      });
    });
   });
 </script>


  



