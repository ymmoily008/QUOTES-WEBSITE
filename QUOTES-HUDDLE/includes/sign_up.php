<?php 

if(	isset($_POST['submit']) ){
	include_once 'db_connect.php';

}
else{
	header("Location: ../rgform/regform.php");
	exit();
}


?>
