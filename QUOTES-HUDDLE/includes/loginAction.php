<?php 
	include_once 'db_connect.php';
	session_start();


	$uid = mysqli_real_escape_string($conn,$_POST['username']);
	$pass1 = mysqli_real_escape_string($conn,$_POST['password']);


	// echo "Here inside login Action.  ".$uid." ".$pass1;

	if(empty($uid) || empty($pass1)){ 	//Check if inputs are empty
		$login_error="Do not leave blank fields!";
		// echo "<br>Came here";
	} 
	else{
		$sql_query2 ="SELECT * FROM users WHERE user_name=?";

		$stmt= mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql_query2)){
			// echo "<br>Statement not prepared";
			header("Location:../home/index.php?error=Invalidfields");
			exit();
		}
		else{

			// echo "<br>Statement prepared!";
			mysqli_stmt_bind_param($stmt,"s",$uid);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			if($row = mysqli_fetch_assoc($result)){
				$pwdCheck = password_verify($pass1,$row['pwd']);
				if($pwdCheck==False){
					// echo "<br>Password verification unsuccessful";
					$login_error="Wrong password";
					// echo $login_error;
					$_SESSION['loginMessage']="Wrong password!";
					header("Location:../home/index.php?error=Wrongpassword");
					exit();
				}
				else if($pwdCheck==True){

					$_SESSION['user_id']=$row['user_id'];
					// $_SESSION['user_name']=$row['user_name'];
					$_SESSION['user_name']=$row['user_name'];
					$_SESSION['user_first']=$row['user_first'];
					$_SESSION['user_last']=$row['user_last'];
					$_SESSION['user_email']=$row['user_email'];
					$_SESSION['user_gender']= $row['user_gender'];
					$_SESSION['loginMessage']="You logged in!";
					// echo "<br> <script> alert(\"Successfully Registered\"); </script>";
					header("Location:../home/index.php");	
					// header("Location:../home/index.php?login=Success");
					exit();
				}
			}
			else{
				//No username
				$login_error="Username does not exist";
				$_SESSION['loginMessage']="Username does not exist!";
				header("Location:../home/index.php?error=usernameNotExists");
				exit();
			}
		}
	}

// echo "<br>Exits here finally";
exit();

?>