<?php 
require_once '../php/conn.php';

$notif = mysqli_query($sqlcon,"SELECT * FROM tbl_notification WHERE notif_status= '0'");
$count = mysqli_num_rows($notif);
while ($row = mysqli_fetch_array($notif)) { ?>
	 <span class= "position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $count; ?></span>
<?php }

?>