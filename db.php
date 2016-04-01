<?php
	$host='localhost';
	$uname='root';
	$pwd='';
	$db="garfy";

	$conn = mysqli_connect($host,$uname,$pwd) or die("connection failed");
	$select_db = mysqli_select_db($conn, $db) or die("db selection failed");
?>