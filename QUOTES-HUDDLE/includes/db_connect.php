<?php
  session_start(); 


	//Connecting to a dabase
	$dbServername = "localhost";
	$dbUsername   = "root";
	$dbPassword   = "";
	$dbName 	  =	"loginSystem";

	$conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

	// if ($conn->connect_error) {
 //   			 die("Connection failed: " . $conn->connect_error);
	// }
	// else{
	// 	echo "<h1>Connected successfully!</h1>";
	// }

?>

