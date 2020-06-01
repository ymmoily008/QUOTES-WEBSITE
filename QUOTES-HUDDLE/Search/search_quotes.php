<?php session_start();  ?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Quote's Huddle</title>
	  <link rel="stylesheet" href="../BS/css/bootstrap.min.css">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:300,400,700'>
	  <link rel="stylesheet" href="searchStyle.css">
	  <link rel="stylesheet" href="cardStyle.css">
	  <script src="../BS/js/jquery.min.js"></script>
	  <script src="../BS/js/bootstrap.min.js"></script>

	 <link href="style.css" rel="stylesheet" />
	 <link href="../loginForm/loginStyle.css" rel="stylesheet" />
</head>
<body>
<!-- partial:index.partial.html -->

<?php include "../includes/sessionStarting.php" ?>
<?php include "../includes/navbar.php" ?>
<?php $searchword=""; ?>

<br> <br> <br> <br> <br> <br> <br>
<center>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div class="wrap">
   <div class="search">
      <input name="searchbar" type="text" class="searchTerm" placeholder="Enter a keyword"  value="<?php echo $searchword;?>" >
      <button name="submit_search" type="submit" class="searchButton">
	      <i class="fa fa-search"></i>
     </button>
   </div>
</div>
</form>
</center>

<br> <br>

<div class="container">
<?php
  require "../phpspellcheck/include.php";
  $mySpell = new SpellAsYouType();
  $mySpell->InstallationPath = "../phpspellcheck/";
  $mySpell->Fields = "TEXTINPUTS";
  //echo $mySpell->Activate();
?>

<?php

/*
0 - no error 
1 - No keyword entered
2 - More than one word
3 - Incorrect word
4- Badwords
5- Special Chars
*/
			$errorStatus=0;
			$searchword="";
		

			if (isset($_POST["submit_search"]) and $_SERVER["REQUEST_METHOD"] == "POST") {
				//Word selected
				$searchword =$_POST["searchbar"];
				$searchword = strtolower($searchword);
				 $r1='/[!@#$%^*()\/_=+{}<>-\[\]]/';  //specialchars



				if(   strlen(trim($searchword)) >1 ){

					 $words=explode(" ",$searchword);

					 if( count($words) >1 )
					 	$errorStatus=2;
					 elseif(preg_match_all($r1,$words[0])>0)
					 		$errorStatus=5;
					 else{

				 	        // require "../phpspellcheck/include.php";

					        $spellcheckObject = new PHPSpellCheck();

					        $spellcheckObject -> LicenceKey="TRIAL";

					        $spellcheckObject -> IgnoreAllCaps = false;
					        $spellcheckObject -> IgnoreNumeric = false;
					        $spellcheckObject -> CaseSensitive = true;
					        $spellcheckObject -> CheckGrammar = true;
					        $spellcheckObject -> Strict = true;

					        $spellcheckObject -> DictionaryPath = ("../phpspellcheck/dictionaries/"); 
					        $spellcheckObject -> SuggestionTollerance = 1;

					        $spellcheckObject -> LoadDictionary("English (International)") ;
					        $spellcheckObject -> LoadCustomDictionary("custom.txt");
					        $spellcheckObject -> LoadCustomBannedWords("language-rules/banned-words.txt"); 
					  
					        
					        $spellcheckObject -> LoadEnforcedCorrections("language-rules/enforced-corrections.txt");
					        $spellcheckObject -> LoadCommonTypos("language-rules/common-mistakes.txt");
					        $spelledItRight = $spellcheckObject->SpellCheckWord($words[0]);

				            if(!$spelledItRight AND  $spellcheckObject->ErrorTypeWord($words[0])=="B")
				              $errorStatus=4;  //Badword         
				            elseif(!$spelledItRight )
				              $errorStatus=3; 	//Incorrect word	            	
				            else{
				            	//No errors right word
				            	$errorStatus=0;
				               	$sql_query = "SELECT DISTINCT quote_text,quote_author FROM quotes WHERE LENGTH(quote_text<=40) AND quote_text LIKE'% ".$searchword." %' ORDER BY RAND() LIMIT 25" ;
								// echo "<center><h1>Word=".$searchword."</h1></center>";

				            }

					 }

					
				}
				else{
					$errorStatus=1; //there are no letter only blankspaces
				}
			}

			else {
			 	//Default page view and query when no word has been entered
			 	$errorStatus=0;                     
				$searchword="";       
				$flag=0;
				// echo "<center><h1>Word=".$searchword.".</h1></center>";
				$sql_query = "SELECT * FROM quotes WHERE LENGTH(quote_text<=27) ORDER BY RAND() LIMIT 5" ;
			}
			

			echo "<div class=\"cardWrapper\">";
			
			if($errorStatus==0){ //No error
	
					$result = mysqli_query($conn,$sql_query);
					$resultCheck = mysqli_num_rows($result);
					$counter = 501;

					if($resultCheck>0){
					echo "<center><h1>Quotes</h1></center><br>";
					echo "<div class=\"cardCols\">";
						// shuffle_assoc($result);

						while ( $row = mysqli_fetch_assoc($result)) {

							   
							$quote =$row["quote_text"];
							$author_name=$row["quote_author"];
							$url_img_no = $counter;						//Counter var
							$counter ++;
							$url_img_no=(string) $url_img_no;
							$url_img = "https://unsplash.it/".$url_img_no."/".$url_img_no."/";

							echo "<div class=\"cardColumn\" ontouchstart=\"this.classList.toggle('hover'); \"> ";
							echo "<div class=\"cardContainer\"> ";
							echo "<div class=\"cardFront\" style=\"background-image: url(".$url_img." )\"> ";
							//Change the url nos

							echo " <div class=\"cardInner\"> ";
							echo " <p>Quote by</p>";

							echo "<span>".$author_name."</span>"; 
							//Change the name of the author	

							echo "</div> </div> ";				
							echo "<div class=\"cardBack\"> ";			
							echo "<div class=\"cardInner\">";	
							echo "<p>".$quote."</p> ";	
							//Change the quote

							echo "</div> </div> </div> </div>";	

							}//while
					}//if

				else{
					//Correct word entered but no quotes found
						echo "<center><h1>No Quotes Available with keyword ".$searchword.".</h1></center>" ;
						echo "<center><h1>Try another or similar word .</h1></center><br><br>" ;
				}
			}   //end of errorStatus 0

			elseif($errorStatus==1){ 
				echo "<center><h1>Please enter a keyword.</h1></center><br>";
			}
			elseif($errorStatus==2){ 
				echo "<center><h1>Please enter a single keyword.</h1></center><br>";
			}
			elseif($errorStatus==3){ 
				echo "<center><h1>Please enter a correctly spelled keyword.</h1></center><br>";

				if(strlen($words[0]) <10){
				$didYouMean = implode(" ,",	$spellcheckObject->Suggestions($words[0]) );
				if(strlen($didYouMean) > 1 AND $didYouMean!='*PHP Spellcheck Trial* ,Please register online ,www.phpspellcheck.com')
					echo  "<center><h1>Did you mean:".$didYouMean."</h1></center><br>";
				}

			}
			elseif($errorStatus==4){ 
				echo "<center><h1>Please don't use badwords.</h1></center><br>";
			}
			elseif($errorStatus==5){ 
				echo "<center><h1>Special characters not allowed.</h1></center><br>";
			}

			echo "</div> </div>";	//don't touch

		?>
</div>

<br> <br><br> <br>
<br> <br>
<br> <br>
<br> <br>


<?php include "../includes/footer.php" ?>
<?php include "../loginForm/loginHome.php" ?>



</body>
</html>