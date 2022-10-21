<?php

session_start();

include_once 'conn.php';

session_destroy();

header("location:index.php");

?>