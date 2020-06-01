<?php session_start();  ?>

<!DOCTYPE html>
<html>
<head>
  <title>Quote's Huddle</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="style.css" rel="stylesheet" />
    <link rel="stylesheet" href="authorCard.css">
    <link href="../loginForm/loginStyle.css" rel="stylesheet" />

</head>

<body>
<?php include "../includes/sessionStarting.php" ?>
<?php include "../includes/navbar.php" ?>


<br> <br> <br>

<div class="jumbotron text-center" >
  <h1>MY PROFILE</h1>
</div>
  <br> <br>

<div class="container">


<?php 
	$user_name = $_SESSION['user_name'];
	$user_first= $_SESSION['user_first'];
	$user_last=$_SESSION['user_last'];
	$user_email=$_SESSION['user_email'];
	$user_gender=$_SESSION['user_gender'];

	$full_name = $user_first." ".$user_last;
 ?>

    <div class="row">
		<?php
			echo"<pre><h3> NAME       :".$full_name."</h3></pre>";
		?>
	</div>

	<div class="row">
		<?php
			echo "<pre><h3> USERNAME   :".$user_name."</h3></pre>";
		?>
	</div>

    <div class="row">
		<?php
			echo "<pre><h3> EMAIL      :".$user_email."</h3></pre>";
		?>
	</div>

    <div class="row">
		<?php
			$gender='';
			if($user_gender=='male')  			$gender = 'Male';
			elseif ($user_gender=='female')     $gender = 'Female';
			elseif ( $user_gender=='other')     $gender = 'Other';

			echo "<pre><h3> GENDER     :". $gender . "</h3>";
		?>
	</div>

	<?php 
		 $author_selected = $full_name; 

	    // echo "<br><br>The option selected was ".$author_selected ."<br><br><br>";

	    $sql_author_quotes = "SELECT DISTINCT quote_text FROM quotes WHERE quote_author='".$author_selected."'
	    ORDER BY rand();";
		$result1 = mysqli_query($conn,$sql_author_quotes);
		$resultCheck1= mysqli_num_rows($result1);
		$total_rows = $resultCheck1;

	 ?>

	 <div class="cards clearfix"> 

	<?php 

		if($resultCheck1>0){

			echo "<center><div id=\"heading\"> Quotes by ".$author_selected."</div>";

			//col1
			echo "<div class=\"card-col-1\">"; //start of first column
			for ($i=1; $i <=ceil($total_rows/3) ; $i++) { 
				    $randomImageHeight = rand(240, 340);  //Image heright
				    $relation = 280/$randomImageHeight;
				    $padding = 100/$relation;
				    $rand_no =mt_rand()/ mt_getrandmax();


				    $row1 = mysqli_fetch_assoc($result1);
				    $quote_text=$row1["quote_text"];

				    echo "<div class=\"card\">";
				    echo "<div class=\"top\" style=\"padding-bottom:".$padding."%\">";

				    echo "<img src=\"https://www.unsplash.it/280/".$randomImageHeight."/?random&sig=".$rand_no."\"> ";

				    echo "</div>";

				    echo "<div class=\"bottom\">";

				    echo "<p>".$quote_text."</p>";

				    echo "</div></div>";

			}
			echo "</div>";


			//col2
				echo "<div class=\"card-col-2\">"; //start of first column
			for ($i=1; $i <=round($total_rows/3) ; $i++) { 
				    $randomImageHeight = rand(240, 340);  //Image heright
				    $relation = 280/$randomImageHeight;
				    $padding = 100/$relation;
				    $rand_no =mt_rand()/ mt_getrandmax();


				    $row1 = mysqli_fetch_assoc($result1);
				    $quote_text=$row1["quote_text"];

				    echo "<div class=\"card\">";
				    echo "<div class=\"top\" style=\"padding-bottom:".$padding."%\">";

				    echo "<img src=\"https://www.unsplash.it/280/".$randomImageHeight."/?random&sig=".$rand_no."\"> ";

				    echo "</div>";

				    echo "<div class=\"bottom\">";

				    echo "<p>".$quote_text."</p>";

				    echo "</div></div>";

			}
			echo "</div>";

			//col3
			echo "<div class=\"card-col-3\">"; //start of first column
			for ($i=1; $i <=floor($total_rows/3) ; $i++) { 
				    $randomImageHeight = rand(240, 340);  //Image heright
				    $relation = 280/$randomImageHeight;
				    $padding = 100/$relation;
				    $rand_no =mt_rand()/ mt_getrandmax();


				    $row1 = mysqli_fetch_assoc($result1);
				    $quote_text=$row1["quote_text"];

				    echo "<div class=\"card\">";
				    echo "<div class=\"top\" style=\"padding-bottom:".$padding."%\">";

				    echo "<img src=\"https://www.unsplash.it/280/".$randomImageHeight."/?random&sig=".$rand_no."\"> ";

				    echo "</div>";

				    echo "<div class=\"bottom\">";

				    echo "<p>".$quote_text."</p>";

				    echo "</div></div>";

			}
			echo "</div>";

		}//end of cards printing

		else{
			echo "<center><div id=\"heading\"> No Quotes Available.</div>";
		}


 	?>
 	 

	</div>

</div>

<?php include "../includes/footer.php" ?>
<?php include "../loginForm/loginForm.php" ?>

</body>
</html>




