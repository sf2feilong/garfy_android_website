<?php
	include 'db.php';

	$user = $_REQUEST['user'];

	$sql = "SELECT * FROM user_t WHERE user_id = '$user'";
	$query=mysqli_query($conn, $sql);
	while($row=mysqli_fetch_assoc($query))
	{
		$flag[] = $row['level'];
		

		
	}

	print(json_encode($flag));
?>