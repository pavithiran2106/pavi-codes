<?php

$sname= "127.0.0.1:3310";
$unmae= "root";
$password = "";

$db_name = "assesement";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}