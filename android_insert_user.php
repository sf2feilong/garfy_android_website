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

	
	if($id_number == ""){
		$flag['code'] = 2;
		if($first_name == ""){
			$flag['code'] = 8;
			if($last_name == ""){
				$flag['code'] = 9;
				if($contact_number = ""){
					$flag['code'] = 10;
					if($e_first_name == ""){
						$flag['code'] = 11;
						if($e_last_name == ""){
							$flag['code'] = 12;
						}
					}
				}
			}
			
		}
	}
	else if($first_name == ""){
		$flag['code'] = 3;
		if($last_name == ""){
			$flag['code'] = 13;
			if($contact_number == ""){
				$flag['code'] = 14;
				if($e_first_name == ""){
					$flag['code'] = 15;
					if($e_last_name == ""){
						$flag['code'] = 16;
					}
				}
			}
		}
	}
	else if($last_name == ""){
		$flag['code'] = 4;
		if($contact_number == ""){
			$flag['code'] = 17;
			if($e_first_name == ""){
				$flag['code'] = 18;
				if($e_last_name == ""){
					$flag['code'] = 19;
				}
			}
		}
	}
	else if($contact_number == ""){
		$flag['code'] = 5;
		if($e_first_name == ""){
			$flag['code'] = 20;
			if($e_last_name == ""){
				$flag['code'] = 21;
			}
		}
	}
	else if($e_first_name == ""){
		$flag['code'] = 6;
		if($e_last_name == ""){
			$flag['code'] = 22;
		}
	}
	else if($e_last_name == ""){
		$flag['code'] = 7;
	}
	else{
		$insert_user_sql = "INSERT INTO user_t
							VALUES('$id_number', '$first_name', '$last_name', '$e_first_name',
								'$e_last_name', '$contact_number', MD5('password'), '$user_level', 'yes')";
		if($insert_user_query = mysqli_query($conn, $insert_user_sql)){
			$flag['code'] = 1;
			if($user_type == "student"){
				$insert_student_sql = "INSERT INTO student_t VALUES('$id_number', '$extra')";
				if($insert_student_query = mysqli_query($conn, $insert_student_sql)){
					$flag['code'] = 111;
					$user_log_sql = "INSERT INTO manage_user_log_t VALUES('$user', '$id_number', NOW(), 'create')";
					if($user_log_query = mysqli_query($conn, $user_log_sql)){
						$flag['code'] = 1111;
					}
				}
			}
			else if($user_type == "employee"){
				$insert_employee_sql = "INSERT INTO employee_t VALUES('$id_number', '$extra')";
				if($insert_employee_query = mysqli_query($conn, $insert_employee_sql)){
					$flag['code'] = 112;
					$user_log_sql = "INSERT INTO manage_user_log_t VALUES('$user', '$id_number', NOW(), 'create')";
					if($user_log_query = mysqli_query($conn, $user_log_sql)){
						$flag['code'] = 1112;
					}
				}
			}
			else if($user_type == "chairperson"){
				$insert_employee_sql = "INSERT INTO employee_t VALUES('$id_number', '$extra')";
				if($insert_employee_query = mysqli_query($conn, $insert_employee_sql)){
					$flag['code'] = 113;
					$user_log_sql = "INSERT INTO manage_user_log_t VALUES('$user', '$id_number', NOW(), 'create')";
					if($user_log_query = mysqli_query($conn, $user_log_sql)){
						$flag['code'] = 1113;
					}
				}
			}
		}
	}


	print(json_encode($flag));
?>