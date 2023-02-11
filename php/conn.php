<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "ccjeexam";

$sqlcon = mysqli_connect($hostname,$username,$password,$dbname);

if (mysqli_connect_errno()) {

	die("failed to established connection".mysqli_connect_errno());
}
?>