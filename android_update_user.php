<?php
	include 'db.php';

	$user=$_REQUEST['user'];//blank
	$id_number=$_REQUEST['id_number'];//blank
	$first_name=$_REQUEST['first_name'];//blank
	$last_name=$_REQUEST['last_name'];//blank
	$contact_number=$_REQUEST['contact_number'];//blank
	$e_first_name=$_REQUEST['e_first_name'];//blank
	$e_last_name=$_REQUEST['e_last_name'];//blank
	$user_level=$_REQUEST['user_level'];
	$user_type=$_REQUEST['user_type'];
	$extra=$_REQUEST['extra'];

	$flag['code'] = 0;

	$pin = MD5($pin);

	$query = "SELECT * FROM admin_t WHERE admin_id = ?";
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $query);
	mysqli_stmt_bind_param($stmt,"s",$user);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	while($rows = mysqli_fetch_assoc($result)){
		$current_pin = $rows['pin'];
	}

	if($current_pin == $pin){

		mysqli_autocommit($conn, false);

		$fname_query = "UPDATE user_t
				SET first_name = '$first_name'
				WHERE user_id = ?";
		$fname_stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($fname_stmt, $fname_query);
		mysqli_stmt_bind_param($fname_stmt,'s', $id_number);
		mysqli_stmt_execute($fname_stmt);

		$lname_query = "UPDATE user_t
				SET last_name = '$last_name'
				WHERE user_id = ?";
		$lname_stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($lname_stmt, $lname_query);
		mysqli_stmt_bind_param($lname_stmt,'s', $id_number);
		mysqli_stmt_execute($lname_stmt);

		$contact_query = "UPDATE user_t
				SET contact_number = '$contact_number'
				WHERE user_id = ?";
		$contact_stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($contact_stmt, $contact_query);
		mysqli_stmt_bind_param($contact_stmt,'s', $id_number);
		mysqli_stmt_execute($contact_stmt);

		$efname_query = "UPDATE user_t
				SET e_first_name = '$e_first_name'
				WHERE user_id = ?";
		$efname_stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($efname_stmt, $efname_query);
		mysqli_stmt_bind_param($efname_stmt,'s', $id_number);
		mysqli_stmt_execute($efname_stmt);

		$elname_query = "UPDATE user_t
				SET e_last_name = '$e_last_name'
				WHERE user_id = ?";
		$elname_stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($elname_stmt, $elname_query);
		mysqli_stmt_bind_param($elname_stmt,'s', $id_number);
		mysqli_stmt_execute($elname_stmt);

		$level_query = "UPDATE user_t
				SET level = '$user_level'
				WHERE user_id = ?";
		$level_stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($level_stmt, $level_query);
		mysqli_stmt_bind_param($level_stmt,'s', $id_number);
		mysqli_stmt_execute($level_stmt);

		$level_query = "UPDATE user_t
				SET level = '$user_level'
				WHERE user_id = ?";
		$level_stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($level_stmt, $level_query);
		mysqli_stmt_bind_param($level_stmt,'s', $id_number);
		mysqli_stmt_execute($level_stmt);



		mysqli_autocommit($conn, true);

		$flag['code'] = 23;

	}else{

	}


	

		print(json_encode($flag));

?>