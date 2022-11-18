<?php

session_start();

require_once 'conn.php';

$id = $_SESSION['acc_id'];

$difficult = $_POST['diff'];
$subjects = $_POST['area_exam'];

$sql=mysqli_query($sqlcon,"SELECT * FROM `test_question` WHERE `acc_id`='$id' AND  level_difficulty LIKE '%$difficult%' AND `subject_name` LIKE '%$subjects%' ORDER BY rand()");

$quiz_filt = mysqli_num_rows($sql);


 ?>
 <style type="text/css">
    .my-custom-scrollbar {
    position: relative;
    height: 450px;
    overflow: auto;
    }
    .table-wrapper-scroll-y {
    display: block;
    }
 </style>
<link href="../css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/datatables-1.10.25.min.css" />
<p class="fw-bold">Questions matching this filter:<?php echo $quiz_filt; ?></p>
 <div class="table-responsive-xl">
<div class="table-wrapper-scroll-y my-custom-scrollbar">
  <table  class="table table-hover bg-light" style="font-size: 15px;" id="standing">
    <thead>
      <tr>  
        <th scope="col">Question</th>
      </tr>
    </thead>
    <tbody>
      <?php

      if (mysqli_num_rows($sql) ==0) { ?>

        <tr class="table-danger">
          <td hidden=""></td>
          <td class="text-center">No Record of Question yet.</td>
        </tr>

      <?php } elseif (mysqli_num_rows($sql) >0) { ?>

        <?php 
        while ($now = mysqli_fetch_assoc($sql)) { $_SESSION['exam'] = $now['question_id'];  ?>

          <tr>
            <td hidden=""><input type="hidden" name="unique_quest[]" value="<?php echo $now['question_id']; ?>"></td>
            <td><?php echo $now['questions_title']; ?></td>
          </tr>
        <?php } ?>

      <?php } ?>
    </tbody>
  </table>
</div>
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
  $(document).ready(function(){
    $('.prev_btn').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: '../php/prev_quiz_bank.php',
            type: 'post',
            data: {userid: userid},
            success: function(response){
              $('.loggin').html(response);
              $('#question_bank_prev').modal('show');
            }
          });
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


  



