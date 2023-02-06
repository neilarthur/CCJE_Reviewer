<?php

$hostname = "sql110.epizy.com";
$username = "epiz_33536061";
$password = "DvTdJ96CKnDx";
$dbname = "epiz_33536061_ccjeexam";

$sqlcon = mysqli_connect($hostname,$username,$password,$dbname);

if (mysqli_connect_errno()) {

	die("failed to established connection".mysqli_connect_errno());
}
?>