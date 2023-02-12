<?php
session_start();
require_once '../php/conn.php';

$notif = mysqli_query($sqlcon,"SELECT * FROM tbl_response,accounts WHERE response_stat= '0' AND accounts.acc_id='{$_SESSION['acc_id']}'");

$response = mysqli_query($sqlcon,"SELECT * FROM tbl_admin_response,accounts WHERE notif_stat_student= '0' AND accounts.acc_id='{$_SESSION['acc_id']}'");


$count = mysqli_num_rows($notif);
$counted = mysqli_num_rows($response);

while ($row = mysqli_fetch_array($notif)) {
	while ($raw = mysqli_fetch_assoc($response)) { ?>
		 <span class= "position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $count; ?></span>
		 <span class= "position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $counted; ?></span>
		 
		<?php
	}
}
?>
