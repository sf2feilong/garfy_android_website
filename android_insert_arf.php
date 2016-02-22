<?php
	include 'db.php';

	$user=$_REQUEST['user'];
	$title=$_REQUEST['title'];
	$end_date=$_REQUEST['end'];
	$details=$_REQUEST['details'];
	$post_to=$_REQUEST['postTo'];
	$viewable_to=$_REQUEST['viewableTo'];
	$confirm_by=$_REQUEST['confirmBy'];


	$arf_id = 0; 


	$flag['code'] = 0;

	if($title == ""){
		$flag['code'] = 2;
		/*if($end_date == ""){
			$flag['code'] = 8;*/
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
	/*else if($end_date == ""){
		$flag['code'] = 3;
		if($details == ""){
			$flag['code'] = 13;
			if($post_to == ""){
				$flag['code'] = 14;
				if($viewable_to == ""){
					$flag['code'] = 15;
					if($confirm_by == ""){
						$flag['code'] = 16;
					}
				}
			}
		}
	}*/
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

	if($title != "" && $details != "" && $post_to != "" && $viewable_to != ""){
		if($r=mysqli_query($conn, "INSERT INTO arf_t VALUES('','$user','$title','$details',NOW(),'$end_date','$post_to','$viewable_to','$confirm_by',NULL,'active') ")){
		//$flag['code'] = 0;

		$arf_if_query= mysqli_query($conn,"SELECT MAX(arf_id) FROM arf_t WHERE user_id='$user'");
		while($rows = mysqli_fetch_assoc($arf_if_query)){
			$arf_id = $rows['MAX(arf_id)'];
		}

		if($row=mysqli_query($conn, "INSERT INTO manage_arf_log_t VALUES('$user','$arf_id',NOW(),'created') ")){
			$flag['code'] = 1;
		}
	}		
	}


	

	print(json_encode($flag));

?>