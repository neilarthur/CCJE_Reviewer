<?php

require_once '../php/conn.php';

$sql = "UPDATE tbl_response SET response_stat='1'";

$res = mysqli_query($sqlcon,$sql);

if ($res) {
	echo "Success";
}
else {
	echo "Failed";
}
?>