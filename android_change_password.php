<?php
	include 'db.php';
	 
	$user = $_POST['user'];
	$old_pass=$_POST['old_pass'];
	$new_pass=$_POST['new_pass'];
	$confirm_pass=$_POST['confirm_pass'];
	$original_pass = "";

	$flag['code']=0;

	if($old_pass == ""){
		$flag['code'] = 2;
		if($new_pass == ""){
			$flag['code'] = 5;
			if($confirm_pass == ""){
				$flag['code'] = 6;
			}
		}
	}
	else if($new_pass == ""){
		$flag['code'] = 3;
		if($confirm_pass == ""){
			$flag['code'] = 7;
		}
	}
	else if($confirm_pass == ""){
		$flag['code'] = 4;
	}

	if($new_pass != $confirm_pass){
		$flag['code'] = 8;
	}

	$old_query = "SELECT * FROM user_t
				WHERE user_id = ?";
	//$old_query = mysqli_query($conn, $old_sql);
	$stmt = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($stmt, $old_query);
	mysqli_stmt_bind_param($stmt,"s",$user);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	while($old_row = mysqli_fetch_assoc($result)){
		$original_pass = $old_row['password'];
	}
	$old_pass = MD5($old_pass);
	if($old_pass == $original_pass && $new_pass == $confirm_pass){

		mysqli_autocommit($conn, false);

		$new_pass = MD5($new_pass);


		$old_query = "UPDATE user_t
				SET password = ?
				WHERE user_id = ?";
		$stmt = mysqli_stmt_init($conn);
		mysqli_stmt_prepare($stmt, $old_query);
		mysqli_stmt_bind_param($stmt,'ss',$new_pass, $user);
		
		if(mysqli_stmt_execute($stmt)){
			//$log_query = "INSERT INTO manage_user_log_t VALUES('$user','$user', NOW(), 'password change')";
			$log_query = "INSERT INTO manage_user_log_t VALUES(?,?, NOW(), 'password change')";
			$log_stmt = mysqli_stmt_init($conn);
			mysqli_stmt_prepare($log_stmt, $log_query);
			mysqli_stmt_bind_param($log_stmt,"ss",$user,$user);
			if(mysqli_stmt_execute($log_stmt)){
				$flag['code'] = 1;
			}
			
		}

		mysqli_autocommit($conn, true);
	}
	print(json_encode($flag));
?>