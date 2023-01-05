<?php

require_once 'conn.php';

$userid = $_POST['userid'];

$del_accounts = "SELECT * FROM test_question WHERE question_id ='$userid' ";

$result_del = mysqli_query($sqlcon,$del_accounts);

while ($rows = mysqli_fetch_assoc($result_del)) { ?>

	<form class="form" action="../php/archive_question.php" method="Post">
		<div class="modal-body">
			<div class="container">
				<input type="hidden" name="update_id" value="<?php echo $rows['question_id']; ?>">
			</div>
			<div class="modal-footer d-flex justify-content-center  border-0">
				<input type="submit" name="save" class="btn btn-success px-5 pb-2 text-white rounded-pill" value="YES">
				<button type="button" class="btn btn-danger btn  px-5 pb-2 text-white rounded-pill" data-bs-dismiss="modal">NO</button>
			</div>
		</div>
	</form>
<?php 
}
?>