<?php session_start();  ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Registration Form</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

		<link rel="stylesheet" href="../BS/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="../BS/js/jquery.min.js"></script>
		<script src="../BS/js/bootstrap.min.js"></script>

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="formstyle.css">
		<link href="../loginForm/loginStyle.css" rel="stylesheet" />

	</head>

	<body>
	<?php include "../includes/sessionStarting.php" ?>
	<?php include "../includes/navbar.php" ?>



	<br> <br> <br> <br> <br> 

	<div class="NEWFONT">
		<div class="wrapper" style="background-image: url('images/home.jpg');">

			<div class="inner">
				<div class="image-holder">
					<img src="images/q3.jpg" alt="" >
				</div>
				<!-- INCLUDING formelements.php -->
				<?php
					include "formelements.php";
				?>
			</div>
		</div>
	</div>
		

	<br> <br> <br>

	<?php include "../includes/footer.php" ?>
	<?php include "../loginForm/loginReg.php" ?>

	</body>
</html>