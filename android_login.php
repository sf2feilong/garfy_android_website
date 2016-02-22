<?php
	include 'db.php';
	 
	
	$user=$_REQUEST['user'];
	$pass=$_REQUEST['pass'];

	$flag['code']=0;

	//if(isset($_POST['submit'])){
		if($_REQUEST['user'] == ""){	
			//echo "<div id='error'>Username can't be blank.</div>";
			$flag['code']=2;
			if($_REQUEST['pass'] == ""){
				//echo "<div id='error'>Password can't be blank</div>";
				$flag['code']=6;	
			}
		}else{
			if($_REQUEST['pass'] == ""){
				//echo "<div id='error'>Password can't be blank</div>";
				$flag['code']=3;	
			}else{
				$user = $_REQUEST['user'];
				$check_user = mysqli_query($conn, "SELECT * FROM user_t WHERE user_id='$user'");
				$user_num = mysqli_num_rows($check_user);
				if($user_num == 1){
					$user = $_REQUEST['user'];
					$pass = md5($_REQUEST['pass']);
					$login = mysqli_query($conn, "SELECT * FROM user_t WHERE user_id='$user' AND password='$pass'");
					$login_num = mysqli_num_rows($login);
					if($login_num == 1){
						$_SESSION['user'] = $user;
						$flag['code']=1;
						//header('Location: select.php');
					}else{
						$pass = md5(md5(md5($_REQUEST['pass'])));
						//echo "<div id='error'>Username and password you provided does do not match.<Br><br>".$_POST['user']." - ".$pass."</div>";
						$flag['code']=4;
					}
				}else{
					//echo "<div id='error'>Username is not in database.</div>";
					$flag['code']=5;
				}
			}
		}
	//}

	
	/*if($r=mysqli_query($conn, ""))
	{
		$flag['code']=1;
	}*/

	print(json_encode($flag));
	//mysql_close($con);
	mysqli_close($conn);
?>