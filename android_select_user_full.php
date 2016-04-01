<?php
	include 'db.php';

	$user = $_REQUEST['user'];
	$id_number = $_REQUEST['id_number'];
	$first_name = $_REQUEST['first_name'];
	$last_name = $_REQUEST['last_name'];
	$method = $_REQUEST['method'];

	$first_name = "%".$first_name."%";
	$last_name = "%".$last_name."%";

	if($method == "full"){
		$query = "SELECT * FROM user_t
			WHERE user_id = ?
			AND first_name LIKE ?
			AND last_name LIKE ?;";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $query);
		mysqli_stmt_bind_param($stmt,"sss", $id_number, $first_name, $last_name);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		while($rows = mysqli_fetch_assoc($result)){
			$flag[] = $rows['user_id'];
			$flag[] = $rows['first_name'];
			$flag[] = $rows['last_name'];
			$flag[] = $rows['active'];
		}
	}
	else if($method == "id first"){
		$query = "SELECT * FROM user_t
			WHERE user_id = ?
			AND first_name LIKE ?";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $query);
		mysqli_stmt_bind_param($stmt,"ss", $id_number, $first_name);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		while($rows = mysqli_fetch_assoc($result)){
			$flag[] = $rows['user_id'];
			$flag[] = $rows['first_name'];
			$flag[] = $rows['last_name'];
			$flag[] = $rows['active'];
		}
	}
	else if($method == "id last"){
		$query = "SELECT * FROM user_t
			WHERE user_id = ?
			AND last_name LIKE ?";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $query);
		mysqli_stmt_bind_param($stmt,"ss", $id_number, $last_name);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		while($rows = mysqli_fetch_assoc($result)){
			$flag[] = $rows['user_id'];
			$flag[] = $rows['first_name'];
			$flag[] = $rows['last_name'];
			$flag[] = $rows['active'];
		}
	}
	else if($method == "id"){
		$query = "SELECT * FROM user_t
			WHERE user_id = ?";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $query);
		mysqli_stmt_bind_param($stmt,"s", $id_number);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		while($rows = mysqli_fetch_assoc($result)){
			$flag[] = $rows['user_id'];
			$flag[] = $rows['first_name'];
			$flag[] = $rows['last_name'];
			$flag[] = $rows['active'];
		}
	}
	else if($method == "first last"){
		$query = "SELECT * FROM user_t
			WHERE first_name LIKE ?
			AND last_name LIKE ?;";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $query);
		mysqli_stmt_bind_param($stmt,"ss", $first_name, $last_name);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		while($rows = mysqli_fetch_assoc($result)){
			$flag[] = $rows['user_id'];
			$flag[] = $rows['first_name'];
			$flag[] = $rows['last_name'];
			$flag[] = $rows['active'];
		}
	}
	else if($method == "first"){
		$query = "SELECT * FROM user_t
			WHERE first_name LIKE ?";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $query);
		mysqli_stmt_bind_param($stmt,"s", $first_name);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		while($rows = mysqli_fetch_assoc($result)){
			$flag[] = $rows['user_id'];
			$flag[] = $rows['first_name'];
			$flag[] = $rows['last_name'];
			$flag[] = $rows['active'];
		}
	}
	else if($method == "last"){
		$query = "SELECT * FROM user_t
			WHERE last_name LIKE ?;";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $query);
		mysqli_stmt_bind_param($stmt,"s", $last_name);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		while($rows = mysqli_fetch_assoc($result)){
			$flag[] = $rows['user_id'];
			$flag[] = $rows['first_name'];
			$flag[] = $rows['last_name'];
			$flag[] = $rows['active'];
		}
	}
	

	print(json_encode($flag));
?>