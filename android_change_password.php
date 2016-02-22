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

	if($new_pass != $confirmpass){
		$flag['code'] = 8;
	}

	$old_sql = "SELECT * FROM user_t
				WHERE user_id = '$user'";
	$old_query = mysqli_query($conn, $old_sql);
	while($old_row = mysqli_fetch_assoc($old_query)){
		$original_pass = $old_row['password'];
	}
	$old_pass = MD5($old_pass);
	if($old_pass == $original_pass /*&& $new_pass == $confirm_pass*/){

		$sql = "UPDATE user_t
				SET password = MD5('$new_pass')
				WHERE user_id = '$user'";
		if($query = mysqli_query($conn, $sql)){
			$flag['code'] = 1;
	}
}
	print(json_encode($flag));
?>