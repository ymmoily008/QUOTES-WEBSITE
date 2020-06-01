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
    <link href="../loginForm/loginStyle.css" rel="stylesheet" />


</head>

<body>
<?php include "../includes/sessionStarting.php" ?>
<?php include "../includes/navbar.php" ?>

<br> <br> <br>

<div class="jumbotron text-center" >
  <h1>ABOUT US</h1>
  <p>Aspire To Aspire!</p> 
  <p></p> 
</div>

  <br> <br>

  <div class="container">
    <div class="row">

       <div class="col-sm-3 info">
        <h3 class="minihead"><br>A Galore Of Quotes<br><br></h3>
        <p class="yellowStyle"><br><br>To serve our users with some of the best & inspiring quotes and also to provide them  significant information about some profilic authors which have faded away with time. <br> <br>  <br>
        </p>

       </div>

       <div class="col-sm-1"></div>

      <div class="col-sm-3 info">
        <h3 class="minihead"><br>User friendly attractive interface<br><br></h3>
        <p class="yellowStyle"><br><br>We provide a secure and free interface for uou to browse quotes of your choice.We believe access to the spoken word gives us a unique glimpse into the beauty of the world.<br><br></p>
      </div>

       <div class="col-sm-1"></div>

      <div class="col-sm-4 info">
        <h3 class="minihead"><br>Share your thoughts<br><br></h3>      
           <p class="yellowStyle"><br><br><br>Once you have signed in, you can build your profile by adding your own quotes.Registeration is necessary to post your quotes.We make sure the your quotes will be credited to you only.However,you can browse our site without having to sign in.<br><br><br></p>
    </div>
  </div>
</div>

<br><br>
<br> <br> <br>

<?php include "../includes/footer.php" ?>
<?php include "../loginForm/loginForm.php" ?>

</body>
</html>







