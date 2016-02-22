<?php
	include 'db.php';

	$user=$_REQUEST['user'];
	$title=$_REQUEST['title'];
	$end_date=$_REQUEST['endDate'];
	$details=$_REQUEST['details'];
	$post_to=$_REQUEST['postTo'];
	$viewable_to=$_REQUEST['viewableTo'];
	$confirm_by=$_REQUEST['confirmBy'];



	$flag['code'] = 0;

	if($r=mysqli_query($conn, "INSERT INTO arf_t VALUES('','$title','$details',NOW(),'$end_date','$post_to','$viewable_to','$confirm_by',NULL,'active') ")){
		$flag['code'] = 1;
	}		

	print(json_encode($flag));

?>