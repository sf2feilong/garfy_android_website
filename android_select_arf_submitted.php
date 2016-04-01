<?php
	include 'db.php';

	$user=$_REQUEST['user'];
	$level=$_REQUEST['level'];
	$category=$_REQUEST['category'];

	if($level == "mid" || $level == "high"){
		$position=$_REQUEST['position'];
	}

	if($category == "submitted"){
		$low_sql = "SELECT manage_arf_log_t.arf_id, arf_t.title FROM manage_arf_log_t
					INNER JOIN arf_t
					ON manage_arf_log_t.arf_id = arf_t.arf_id 
					WHERE arf_t.user_id = '$user'
					AND manage_arf_log_t.type = 'created'
					AND arf_t.status = 'pending'
					OR arf_t.status = 'active'";
		$low_query = mysqli_query($conn, $low_sql);
		$low_num = mysqli_num_rows($low_query);

		if($low_num > 0){
				while($low_rows = mysqli_fetch_assoc($low_query)){
				$flag[] = $low_rows['arf_id'];
				$flag[] = $low_rows['title'];
			}
		}
		else{
			$flag[] = 'none';
		}

		
	}
	else if($category == "drafts"){
		$low_sql = "SELECT manage_arf_log_t.arf_id, arf_t.title FROM manage_arf_log_t
					INNER JOIN arf_t
					ON manage_arf_log_t.arf_id = arf_t.arf_id 
					WHERE arf_t.user_id = '$user'
					AND manage_arf_log_t.type = 'draft'
					AND arf_t.status = 'inactive'";
		$low_query = mysqli_query($conn, $low_sql);
		$low_num = mysqli_num_rows($low_query);

		if($low_num > 0){
				while($low_rows = mysqli_fetch_assoc($low_query)){
				$flag[] = $low_rows['arf_id'];
				$flag[] = $low_rows['title'];
			}
		}
		else{
			$flag[] = 'none';
		}
	}
	else if($category == "for re-edit"){
		$low_sql = "SELECT manage_arf_log_t.arf_id, arf_t.title FROM manage_arf_log_t
					INNER JOIN arf_t
					ON manage_arf_log_t.arf_id = arf_t.arf_id 
					WHERE arf_t.user_id = '$user'
					AND manage_arf_log_t.type = 'for re-edit'
					AND arf_t.status = 'pending'";
		$low_query = mysqli_query($conn, $low_sql);
		$low_num = mysqli_num_rows($low_query);

		if($low_num > 0){
				while($low_rows = mysqli_fetch_assoc($low_query)){
				$flag[] = $low_rows['arf_id'];
				$flag[] = $low_rows['title'];
			}
		}
		else{
			$flag[] = 'none';
		}
	}
	else if($category == "rejected" || $category == "censor rejected"){
		$low_sql = "SELECT manage_arf_log_t.arf_id, arf_t.title FROM manage_arf_log_t
					INNER JOIN arf_t
					ON manage_arf_log_t.arf_id = arf_t.arf_id 
					WHERE arf_t.user_id = '$user'
					AND manage_arf_log_t.type = 'rejected'
					OR manage_arf_log_t.type = 'censor rejected'
					AND arf_t.status = 'pending'";
		$low_query = mysqli_query($conn, $low_sql);
		$low_num = mysqli_num_rows($low_query);

		if($low_num > 0){
				while($low_rows = mysqli_fetch_assoc($low_query)){
				$flag[] = $low_rows['arf_id'];
				$flag[] = $low_rows['title'];
			}
		}
		else{
			$flag[] = 'none';
		}
	}
	else if($category == "received" && $position == "censor"){
		$low_sql = "SELECT manage_arf_log_t.arf_id, arf_t.title FROM manage_arf_log_t
					INNER JOIN arf_t
					ON manage_arf_log_t.arf_id = arf_t.arf_id 
					WHERE manage_arf_log_t.type = 'pending'
					AND arf_t.status = 'pending'";
		$low_query = mysqli_query($conn, $low_sql);
		$low_num = mysqli_num_rows($low_query);

		if($low_num > 0){
				while($low_rows = mysqli_fetch_assoc($low_query)){
				$flag[] = $low_rows['arf_id'];
				$flag[] = $low_rows['title'];
			}
		}
		else{
			$flag[] = 'none';
		}
	}

	/*else{
		$sql = "SELECT manage_arf_log_t.arf_id, arf_t.title FROM manage_arf_log_t
				INNER JOIN arf_t
				ON manage_arf_log_t.arf_id = arf_t.arf_id
				WHERE manage_arf_log_t.type = 'created'";
		$query = mysqli_query($conn, $sql);
		while($rows = mysqli_fetch_assoc($query)){
			$flag[] = $rows['arf_id'];
			$flag[] = $rows['title'];
		}
		
	}*/

	print(json_encode($flag));
	

?>