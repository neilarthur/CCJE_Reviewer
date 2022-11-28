<?php

require_once 'conn.php';


$userid =  $_POST['userid']; 

$say =  "SELECT * FROM accounts WHERE acc_id= '$userid'";

$results = mysqli_query($sqlcon, $say);

while ($row = mysqli_fetch_array($results)) { ?>

	<form class="form"  method="POST" action="../php/approve_accounts.php">
		<div class="modal-body">
			<div class="container d-flex justify-content-center">
				<input type="hidden" name="acc_id" value="<?php echo $row['acc_id']; ?>">
				<input type="hidden" name="email_ad" value="<?php echo $row['email_address']; ?>">
			</div>
			<div class="modal-footer d-flex justify-content-center border-0">
				<input type="submit" name="approval" class="btn btn-success px-5 pb-2 text-whiter rounded-pill" value="YES">
				<button type="button" class="btn btn-danger  px-5 pb-2 text-white rounded-pill" data-bs-dismiss="modal">NO</button>
			</div>
		</div>
	</form>
<?php } ?>