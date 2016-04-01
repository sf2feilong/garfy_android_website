<?php
	include 'db.php';

	$user=$_REQUEST['user'];
	$title=$_REQUEST['title'];
	$end_date=$_REQUEST['end'];
	$details=$_REQUEST['details'];
	$post_to=$_REQUEST['postTo'];
	$viewable_to=$_REQUEST['viewableTo'];
	$confirm_by=$_REQUEST['confirmBy'];
	$category=$_REQUEST['category'];
	$remarks=$_REQUEST['remarks'];

	$position_sql = "SELECT * FROM employee_t WHERE employee_id = '$user'";
	$position_query = mysqli_query($conn, $position_sql);
	$position_num = mysqli_num_rows($position_query);
	if($position_num > 0){
		while($rows = mysqli_fetch_assoc($position_query)){
			$position = $rows['position'];
		}
	}


	$arf_id = 0; 


	$flag['code'] = 0;

	if($title == ""){
		$flag['code'] = 2;
			if($details == ""){
				$flag['code'] = 9;
				if($post_to == ""){
					$flag['code'] = 10;
					if($viewable_to == ""){
						$flag['code'] = 11;
						if($confirm_by == ""){
							$flag['code'] = 12;
						}
					}
				}
			}
	}
	else if($details == ""){
		$flag['code'] = 4;
		if($post_to == ""){
			$flag['code'] = 17;
			if($viewable_to == ""){
				$flag['code'] = 18;
				if($confirm_by == ""){
					$flag['code'] = 19;
				}
			}
		}
	}
	else if($post_to == ""){
		$flag['code'] = 5;
		if($viewable_to == ""){
			$flag['code'] = 20;
			if($confirm_by == ""){
				$flag['code'] = 21;
			}
		}
	}
	else if($viewable_to == ""){
		$flag['code'] = 6;
		if($confirm_by == ""){
			$flag['code'] = 22;
		}
	}
	else if($confirm_by == ""){
		$flag['code'] = 7;
	}
	else{

	}

	if($category == "submit"){
		$category = 'pending';
		$type = 'created';
	}
	else if($category == "draft"){
		$category = "inactive";
		$type = 'draft';
	}
	else if($category == "edit"){
		$category == "pending";
		$type = 'edit';
	}
	else if($category == "confirm"){
		$category = "active";
		if($position == "censor"){
			$type = 'censor approved';
		}
		$type = 'approved';
	}
	else if($category == "for re-edit"){
		$category = "pending";
		$type = 'for re-edit';
	}
	else if($category == "rejected"){
		$category = "pending";
		if($position == "censor"){
			$type = 'censor rejected';
		}
		$type = 'rejected';
	}
	else if($category == "delete"){
		$category = "inactive";
		$type = 'delete';
	}
	else{

	}

	if($title != "" && $details != "" && $post_to != "" && $viewable_to != ""){
		if($r=mysqli_query($conn, "INSERT INTO arf_t VALUES('','$user','$title','$details',NOW(),'$end_date','$post_to','$viewable_to','$confirm_by',NULL,'$category') ")){

		$arf_if_query= mysqli_query($conn,"SELECT MAX(arf_id) FROM arf_t WHERE user_id='$user'");
		while($rows = mysqli_fetch_assoc($arf_if_query)){
			$arf_id = $rows['MAX(arf_id)'];
		}

		if($row=mysqli_query($conn, "INSERT INTO manage_arf_log_t VALUES('$user','$arf_id',NOW(),'$type') ")){
			$flag['code'] = 1;
		}
	}		
	}


	

	print(json_encode($flag));

?>