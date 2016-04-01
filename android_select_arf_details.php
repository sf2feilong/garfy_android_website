<?php
	include 'db.php';

	$user=$_REQUEST['user'];
	$arf_id=$_REQUEST['arf_id'];

	$query = "SELECT * FROM arf_t WHERE arf_id = ?";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $query);
	mysqli_stmt_bind_param($stmt,"s",$arf_id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	while($rows = mysqli_fetch_assoc($result)){
		$flag[] = $rows['title'];
		$flag[] = $rows['arf_expiry_date'];
		$flag[] = $rows['content'];
		$flag[] = $rows['post_to'];
		$flag[] = $rows['viewable_to'];
		$flag[] = $rows['confirm_by'];
		$flag[] = $rows['remarks'];
	}

	print(json_encode($flag));

?>