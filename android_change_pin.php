<?php
	include 'db.php';
	 
	$user = $_POST['user'];
	$old_pin=$_POST['old_pin'];
	$new_pin=$_POST['new_pin'];
	$confirm_pin=$_POST['confirm_pin'];
	$original_pin = "";
	$default = 2016;

	$flag['code']=0;

	if($old_pin == ""){
		$flag['code'] = 2;
		if($new_pin == ""){
			$flag['code'] = 5;
			if($confirm_pin == ""){
				$flag['code'] = 6;
			}
		}
	}
	else if($new_pin == ""){
		$flag['code'] = 3;
		if($confirm_pin == ""){
			$flag['code'] = 7;
		}
	}
	else if($confirm_pin == ""){
		$flag['code'] = 4;
	}
	else if($new_pin == MD5($default) || $confirm_pin == MD5($default)){
		$flag['code'] = 9;
	}

	if($new_pin != $confirm_pin){
		$flag['code'] = 8;
	}

	$old_sql = "SELECT * FROM admin_t
				WHERE admin_id = '$user'";
	$old_query = mysqli_query($conn, $old_sql);
	while($old_row = mysqli_fetch_assoc($old_query)){
		$original_pin = $old_row['pin'];
	}
	$old_pin = MD5($old_pin);
	if($old_pin == $original_pin && $new_pin == $confirm_pin){

		$sql = "UPDATE admin_t
				SET pin = MD5('$new_pin')
				WHERE admin_id = '$user'";
		if($query = mysqli_query($conn, $sql)){
			$flag['code'] = 111;
			$log_sql = "INSERT INTO manage_user_log_t VALUES('$user','$user', NOW(), 'pin change')";
			if($log_query = mysqli_query($conn, $log_sql)){
				$flag['code'] = 1;
			}
		}
	}
	print(json_encode($flag));
?>