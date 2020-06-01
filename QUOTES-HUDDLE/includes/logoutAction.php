<?php 
	session_start();
    // unset($_SESSION['loginMessage']);
    // unset($_SESSION['user_id']);
    // unset($_SESSION['user_name']);
    echo "<script>alert('Successfully Logged Out!'); </script>";
    session_destroy();
    session_start();
    $_SESSION['logOutMsg'] = True; 

	header("Location:../home/index.php");	

?>
