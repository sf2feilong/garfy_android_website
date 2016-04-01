<?php
	include 'db.php';

	$user = $_REQUEST['user'];

	$query=mysqli_query($conn, "SELECT * FROM user_t");
	while($row=mysqli_fetch_assoc($query))
	{
		$flag[] = $row['user_id'];
		$flag[] = $row['first_name'];
		$flag[] = $row['last_name'];
		$flag[] = $row['active'];

		
	}

	print(json_encode($flag));
?>