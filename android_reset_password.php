<?php
	include 'db.php';

	$user = $_REQUEST['user'];
	$id = $_REQUEST['id'];
	$pin = $_REQUEST['pin'];

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
		$new_pass = "password";

		mysqli_autocommit($conn, false);

		$new_pass = MD5($new_pass);


		$old_query = "UPDATE user_t
				SET password = ?
				WHERE user_id = ?";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $old_query);
		mysqli_stmt_bind_param($stmt,'ss',$new_pass, $id);
		
		if(mysqli_stmt_execute($stmt)){
			//$log_query = "INSERT INTO manage_user_log_t VALUES('$user','$user', NOW(), 'password change')";
			$log_query = "INSERT INTO manage_reset_log_t VALUES(?,?, NOW(), 'password')";
			$log_stmt = mysqli_stmt_init($conn);
			mysqli_stmt_prepare($log_stmt, $log_query);
			mysqli_stmt_bind_param($log_stmt,"ss",$user,$id);
			if(mysqli_stmt_execute($log_stmt)){
				$flag['code'] = 1;
			}
			
		}

		mysqli_autocommit($conn, true);

	}else{

	}


	

		print(json_encode($flag));

?>