<?php

require_once '../php/conn.php';

$sql2 ="UPDATE tbl_admin_response SET notif_stat_student='1'";

$res2 = mysqli_query($sqlcon,$sql2);

if ($res2) {
	echo "Success";
}
else {
	echo "Failed";
}
?>