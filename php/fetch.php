<?php

session_start();

require_once 'conn.php';

$id = $_SESSION['acc_id'];

$difficult = $_POST['difficult'];
$subjects = $_POST['subjects'];

$sql=mysqli_query($sqlcon,"SELECT * FROM `test_question` WHERE `acc_id`='$id' AND  level_difficulty LIKE '%$difficult%' AND `subject_name` LIKE '%$subjects%' ");


 ?>
 <div class="table-responsive">
   <table id="students" class="align-middle mb-0 table table-borderless table-hover">
    <thead>
      <tr>
        <th scope="col"><input type="checkbox" name="adsad" id="select-all"> Select</th>
        <th scope="col">Subjects</th>
        <th scope="col">Question</th>
        <th scope="col">Difficulty</th>
        <th scope="col" class="text-center">Correct Answer</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($now = mysqli_fetch_assoc($sql)) {

        $_SESSION['exam'] = $now['question_id']; ?>
      <tr>

       <td><input type="checkbox" class="checkbox" name="chkl[]" id="question_id<?php echo $now['question_id'];  ?>"  value="<?php echo $_SESSION['exam'] ?>" data-id="<?php echo $now['question_id']; ?>"></td>
       <td hidden=""><?php echo $now['question_id']; ?></td>
       <td><?php echo $now['subject_name']; ?> </td>
       <td><?php echo $now['level_difficulty']; ?></td>
       <td>
          <b><?php echo $now['questions_title']; ?></b><br>
          <span class="pl-4 text-success ms-4">A. <?php echo $now['option_a']; ?></span><br>
          <span class="pl-4 text-success ms-4">B. <?php echo $now["option_b"]; ?></span><br>
          <span class="pl-4 text-success ms-4">C. <?php echo $now["option_c"]; ?></span><br>
          <span class="pl-4 text-success ms-4">D. <?php echo $now["option_d"]; ?></span><br>
       </td>
       <td class="text-success fw-bold text-center"><?php echo $now["correct_ans"]; ?></td>
     </tr>

   <?php } ?>
    </tbody>
  </table>
 </div>
  

  <script src="../js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../js/dt-1.10.25datatables.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#example1').DataTable({
      paging: true
    });
  });
</script>


<script type="text/javascript">
  // $(".checkbox").on("click" ,function(){
    
  // })

  $(document).ready(function(){

    var $checkboxes = $('#students td input[type="checkbox"]');
        
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
      var $checkboxes = $('#students td input[type="checkbox"]');
         
        var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
        var total_question = $("#total_questions").val();
       
        
        if (countCheckedCheckboxes < total_question) { 
             alert("The selected questions is less than the total questions in the test." ); 
             return false;
         }
         return true;
    } 
</script>


<script type="text/javascript">
  $(document).ready(function(){
    $("#form1 #select-all").click(function(){
      $("#form1 input[type='checkbox']").prop('checked',this.checked);
    });
  }); 
</script>




  







  



