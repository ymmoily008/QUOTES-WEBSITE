<?php session_start();  ?>
<?php 

function valid_pass($candidate) {
   $r1='/[A-Z]/';  //Uppercase
   $r2='/[a-z]/';  //lowercase
   $r3='/[!@#$%^&*()\-_=+{};:,<.>]/';  //specialchars
   $r4='/[0-9]/';  //numbers

   if(preg_match_all($r1,$candidate)<1) return FALSE;

   if(preg_match_all($r2,$candidate)<1) return FALSE;

   if(preg_match_all($r3,$candidate)<1) return FALSE;

   if(preg_match_all($r4,$candidate)<1) return FALSE;

   if(strlen($candidate)<8) return FALSE;

   return TRUE;
}

//VARIABLES FOR STORING DATA 
$fname=$lname=$uname=$email=$gender=$pass1=$pass2=$user_name="";

$errormsg=""; //TO DISPLAY THE ERROR AT THE END OF THE STRING
$errorStatus=False;

if (isset($_POST['submit']) and $_SERVER["REQUEST_METHOD"] == "POST"){

	include_once '../includes/db_connect.php';
				
	$fname = mysqli_real_escape_string($conn,$_POST["fname"]);  //Post is a superglobal
	$lname = mysqli_real_escape_string($conn,$_POST["lname"]);
	$email = mysqli_real_escape_string($conn,$_POST["emailId"]);
	$gender= mysqli_real_escape_string($conn,$_POST["Gender"]);
	$pass1 = mysqli_real_escape_string($conn,$_POST["password1"]);
	$pass2 = mysqli_real_escape_string($conn,$_POST["password2"]);
	$user_name=mysqli_real_escape_string($conn,$_POST["username"]);

	// $errormsg= $errormsg."<br><i>*Gender=</i>".$gender;	

	//Validations
	if(!preg_match("/^[a-zA-Z'-]+$/",$fname)){
			$errormsg= $errormsg."<br><i>*Invalid First Name</i>";
			$errorStatus=True;
	}

	if(!preg_match("/^[a-zA-Z'-]+$/",$lname)){
			$errormsg= $errormsg."<br><i>*Invalid Last Name</i>";
			$errorStatus=True;
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errormsg= $errormsg."<br><i>*Invalid Email Format</i>";
			$errorStatus=True;
	}


	if (strlen($gender)<2) {
		$errormsg= $errormsg."<br><i>*Gender not selected.</i>";
		$errorStatus=True;
	}

	if($pass1=="" or $pass2==""){
		$errormsg = $errormsg."<br><i>*Don't leave blank password.</i>";
		$errorStatus=True;
	}
	else if($pass1!=$pass2 and $pass1!=""){
		$errormsg = $errormsg."<br><i>*Passwords do not match</i>";
		$errorStatus=True;
	}	
	else if(!valid_pass($pass1)){
		$errormsg = $errormsg."<br><i>*Password is too weak<br>Add atleast one special character,upper and lower case letter and nos.Length should be atleast 8.</i>";
		$errorStatus=True;
	}

	$sql_query = "SELECT user_id FROM users WHERE user_name='$user_name';";
	$result = mysqli_query($conn,$sql_query) ;
	$resultCheck = mysqli_num_rows($result);

	if($resultCheck>0){
		$errormsg = $errormsg."<br><i>*Username already taken</i>";
		$errorStatus=True;
	}
	
	$sql_query1 = "SELECT user_email FROM users WHERE user_name='$email';";
	$result1 = mysqli_query($conn,$sql_query1) ;
	$resultCheck1 = mysqli_num_rows($result);

	if($resultCheck1>0){
		$errormsg = $errormsg."<br><i>*One Account already registered on this emailId.</i>";
		$errorStatus=True;
	}
	
	if(strtolower($user_name)=="admin"){
		$errormsg = $errormsg."<br><i>*Username Not allowed</i>";
		$errorStatus=True;
	}

	if($errorStatus==False){
		//No errors
		//hashing the password
		$hashed_pwd = password_hash($pass1, PASSWORD_DEFAULT);

		//Insert the user inside in the database using the query as we are good to go
		$insert_query = "INSERT INTO users(user_first,user_last,user_email,user_gender,user_name,pwd) VALUES ('$fname','$lname','$email','$gender','$user_name','$hashed_pwd');";
		mysqli_query($conn,$insert_query);

		//Redirecting the page to home page for now
			$_SESSION['user_name']=$user_name;
			$_SESSION['user_gender']=$gender;
			$_SESSION['user_first']=$fname;
			$_SESSION['user_last']=$lname;
			$_SESSION['user_email']=$email;

			$_SESSION['loginMessage']="You Registered!";
			echo "<script>alert('Successfully Registered and logged in!'); </script>";
		  header("Location:../home/index.php");
		  exit();

	}//end of success if

}	//End of post method if

// End of php tag
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

		<h3>Registration Page</h3>
		<div class="form-group">
			<!-- First name field-->
			<input 	 id="here"
					 type="text" 
					 placeholder="First Name" 
					 class="form-control" 
					 name="fname" 
					 value="<?php echo $fname;?>"
			>
			<!-- Last name field-->
			<input 	 type="text"
					 placeholder="Last Name" 
					 class="form-control" 
					 name="lname"  
					 value="<?php echo $lname;?>"
			>
		</div>

		<div class="form-wrapper">
			<!-- Username -->
			<input  type="text" 
					placeholder="Username" 
					class="form-control"
					name="username"
					value="<?php echo $user_name;?>"
			>
			<i class="zmdi zmdi-account"></i>
		</div>

		<div class="form-wrapper">
			<!-- Email Address -->
			<input 	type="text" 
					placeholder="Email Address" 
					class="form-control" name="emailId"  
					value="<?php echo $email;?>"
			>
			<i class="zmdi zmdi-email"></i>
		</div>


		<div class="form-wrapper">
			<!--Gender Select  -->
			<select name="Gender" id="" class="form-control ">
				<option value="">Gender</option>

				<option value="male"<?php if (isset($gender) && $gender=="male") echo "selected";?>>
				Male
				</option>

				<option value="female" <?php if (isset($gender) && $gender=="female") echo "selected";?>>Female
				</option>

				<option value="other" <?php if (isset($gender) && $gender=="other") echo "selected";?>>Other
				</option>

			</select>
			<i class="zmdi zmdi-caret-down" style="font-size: 17px"></i>
		</div>

		<div class="form-wrapper">
			<!-- Password -->
			<input  type="password" 
					placeholder="Password" 
					class="form-control"
					name="password1"
			>
			<i class="zmdi zmdi-lock"></i>
		</div>

		<div class="form-wrapper">
			<!--Confirm Password -->
			<input 	type="password" 
					placeholder="Confirm Password" 
					class="form-control" 
					name="password2"
			>
			<i class="zmdi zmdi-lock"></i>
		</div>

		<button type="submit" name="submit" > 
			<!--Register button--> 
			Register
			<i class="zmdi zmdi-arrow-right"></i>
		</button>

		<br>
		<p id="ER"><?php echo "$errormsg" ?><p> <!--ERROR message to be displayed -->

	</form>




