<?php

session_start();

require_once 'conn.php';

$id = $_SESSION['acc_id'];


$difficult = $_POST['difficult'];
$subjects = $_POST['subjects'];

$sql=mysqli_query($sqlcon,"SELECT * FROM `test_question` WHERE `acc_id`='$id' AND  level_difficulty LIKE '%$difficult%' AND `subject_name` LIKE '%$subjects%' ");


 ?>

 <div class="table-responsive">
   <table id="questTab" class="align-middle mb-0 table table-borderless table-hover">
    <thead>
      <tr>

        <th scope="col">Area of Exam</th>
        <th scope="col">Level_difficulty</th>
        <th scope="col">Question</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($rows = mysqli_fetch_assoc($sql)) {

        ?>
      <tr>
        <td><?php echo $rows['question_id']; ?></td>
        <td><?php echo $rows['subject_name']; ?></td>
        <td><?php echo $rows['level_difficulty']; ?></td>
        <td><?php echo $rows['questions_title']; ?></td>
        <td>
          <div class="d-flex flex-row justify-content-center">
            <button data-id='<?php echo $rows['question_id'];  ?>' class="btn btn-primary  mx-2 viewbtn" data-bs-toggle="modal" data-bs-target="#ViewQuestion" type="button"><i class="fas fa-eye"></i></button>
            <button data-id='<?php echo $rows['question_id'];  ?>' class="btn btn-warning  mx-2 editbtn" data-bs-toggle="modal" data-bs-target="#EditAccount" type="button"><i class="fas fa-edit"></i></button>
            <button class="btn btn-secondary mx-2 deletebtn" data-bs-toggle="modal" data-bs-target="#ArchiveAccount" type="button"><i class="fas fa-trash"></i></button>
          </div>
        </td>
     </tr>

   <?php } ?>
    </tbody>
  </table>
 </div>




  <script src="../js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../js/dt-1.10.25datatables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


 <!-- View modal --->
 <script type="text/javascript">

   $(document).ready(function(){
    $('.viewbtn').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: '../php/view_question.php?acc_id=<?php echo $_SESSION['acc_id']; ?>',
        type: 'post',
        data: {userid: userid},
        success: function(response){
          $('.view').html(response);
          $('#ViewQuestion').modal('show');
        }
      });
    });
   });
 </script>


  <!-- Edit modal --->
 <script type="text/javascript">

   $(document).ready(function(){
    $('.editbtn').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: '../php/edit_questions.php',
        type: 'post',
        data: {userid: userid},
        success: function(response){
          $('.logs').html(response);
          $('#EditAccount').modal('show');
        }
      });
    });
   });
 </script>


 <!--Archive -->
<script type="text/javascript">
  $(document).ready(function() {
    $('.deletebtn').on('click', function() {

      $('#ArchiveAccount').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            console.log(data);
            $('#delete_id').val(data[0]);
        })
  });
 </script>









  







  



