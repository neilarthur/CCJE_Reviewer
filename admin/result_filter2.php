<?php

require_once '../php/conn.php';


$area = $_POST['area'];

$counter = 1;

$sql=mysqli_query($sqlcon,"SELECT * FROM  tbl_exam_result,tbl_pre_question,accounts WHERE (tbl_exam_result.pre_exam_id =tbl_pre_question.pre_exam_id) AND (tbl_exam_result.acc_id = accounts.acc_id) AND (accounts.section='4B') AND (tbl_pre_question.subjects LIKE '%$area%') ");
?>

<div  class="table-responsive-xl" id="flex">
	<div class="table-wrapper-scroll-y my-custom-scrollbar">
		<table class="table table-hover bg-light align-middle w-100" id="result2Tab">
	<thead>
		<tr>
			<th scope="col" hidden>ID</th>
			<th scope="col">No.</th>
			<th scope="col">Student Name</th>
			<th scope="col">Year & Section</th>
			<th scope="col">Area of Exam</th>
			<th scope="col">Total Questions</th>
			<th scope="col">Time Limit</th>
			<th scope="col" class="text-center">Score</th>
			<th scope="col" class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>

		<?php

		if (mysqli_num_rows($sql) == 0) {
			
			echo '

					<tr>
			<td</td>
			<td></td>
			<td></td>
			<td></td>
			<td>No Records .......</td>
		</tr>
			';
		}
		elseif (mysqli_num_rows($sql) >0) {
			
		

			while ($row = mysqli_fetch_assoc($sql)) { ?>

				<tr>
						<td hidden><?php echo $row['acc_id'] ?></td>
						<td><?php echo $counter ;?></td>
	                    <td><?php echo $row['last_name']." ".$row['first_name']." ".$row['middle_name']?></td>
	                    <td class="ps-5"><?php echo $row['section'] ?></td>
	                    <td><?php echo $row['subjects'] ?></td>
	                    <td class="ps-5"><?php echo $row['total_question'] ?></td>
	                    <td><?php echo $row['time_limit'] /3600?> hr(s)</td>
	                    <td style="padding-left: 55px;"><?php echo $row['score'] ?></td>
	                    <td>
	                    	<div class="d-flex justify-content-center me-3" >
	                    		<button data-id="<?php echo $row['exam_result_id']; ?>" type="button" class="btn btn-primary  mx-2 view_btn" data-bs-toggle="modal" ><i class="fas fa-eye"></i></button>
	                    	</div>
	                    </td>
	                </tr>

				
			<?php  }$counter++;}
	 ?>
			
			</tbody>
		</table>
	</div>
</div>


<script type="text/javascript">

   $(document).ready(function(){
    $('.view_btn').click(function(){
      var userid = $(this).data('id');

      $.ajax({
        url: '../php/view_results_acc.php',
        type: 'post',
        data: {userid: userid},
        success: function(response){
          $('.mugs').html(response);
          $('#viewToggle').modal('show');
        }
      });
    });
   });
 </script>