<?php session_start();  ?>

<?php include "../includes/sessionStarting.php" ?>

<!DOCTYPE html>
<html>
<head>
  <title>Quote's Huddle</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../BS/css/bootstrap.min.css">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:300,400,700'>

  <script src="../BS/js/jquery.min.js"></script>
  <script src="../BS/js/bootstrap.min.js"></script>
  
  <link href="style.css" rel="stylesheet"/>
  <link href="../loginForm/loginStyle.css" rel="stylesheet" />

</head>
<body>
<?php include "../includes/navbar.php" ?>

<br><br><br><br><br><br><br>

<div class="container">
  <form method="POST">
    <div>
        <center><label for="Textarea1">Upload Your Quote</label></center><br><br>
        <textarea class="form-control" maxlength='100' name="quote_area" id="Textarea1" rows="7" placeholder="Enter Quote text"></textarea>
        <br><br>
        <center><button type="submit" name="submitQuote" class="myButton">Submit</button>
</center>

    </div>
  </form>

</div>

<?php
  require "../phpspellcheck/include.php";
  $mySpell = new SpellAsYouType();
  $mySpell->InstallationPath = "../phpspellcheck/";
  $mySpell->Fields = "ALL";
  //echo $mySpell->Activate();
?>


<div class="container">
  <div class="errorText">
  <?php 

    $quoteText="";
    $errorStatus=False;
    if (isset($_POST['submitQuote']) and $_SERVER["REQUEST_METHOD"] == "POST"){
      $quoteText3=$_POST["quote_area"];
      $quoteText=$quoteText2= mysqli_real_escape_string($conn,$_POST["quote_area"]);
        //Post is a superglobal

      echo"<br><h1>Your quote :\"".stripcslashes($quoteText)."\"<h1>" ;
    }


    $r1='/[!@#$%^*()\/_=+{}<>]/';  //specialchars

    if(preg_match_all($r1,$quoteText)>0){
           echo"<br><h1>Specialcharacters not allowed.</h1>";
           $errorStatus=True;
    }
    elseif(str_word_count($quoteText)<2) {
          echo"<br><h1>Minimum two words required.</h1>" ;
          $errorStatus=True;
    }
    elseif($errorStatus==False){
        $sql_query = "SELECT DISTINCT quote_text FROM `quotes`;";
        $result = mysqli_query($conn,$sql_query) ;
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck>0){

          while ( $row = mysqli_fetch_assoc($result)) {

            $quote_fetched =$row["quote_text"];

            if( strtolower($quoteText2) == strtolower($quote_fetched) OR 
                $quoteText3==$quote_fetched OR 
                strtolower($quoteText3)==strtolower($quote_fetched) OR
                strtolower($quoteText)==strtolower($quote_fetched) 
              ){
                echo "<h1>Quote already exists in the database! We do not support plagiarism.</h1>";
                $errorStatus=True;
                break;
            }
            }//while

        }//if      
    }//elseif

    if($errorStatus==False) {
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

        $quoteText=trim($quoteText);
        $quoteText=stripslashes($quoteText);
        $words=explode(" ",$quoteText);
        $last_word = end($words);
        if(strpos($last_word, '.')){
          $last_word=substr_replace($last_word ,"",-1);
          $index = count( $words ) - 1;
          $words[$index]=$last_word;
        }

        foreach($words as $word){
          //Spelling check
            $spelledItRight = $spellcheckObject->SpellCheckWord($word);
            if(!$spelledItRight){
              echo "<h1>Please enter correct spelling of words and appropriate words.</h1>";
              $errorStatus=True;
              break;
            }
        }

        foreach($words as $word){
          //Check if there are badwords used
            $spelledItRight = $spellcheckObject->SpellCheckWord($word);
            if(!$spelledItRight AND  $spellcheckObject->ErrorTypeWord($word)=="B"){
              //B  stands for badword
              echo "<h1>Bad words Strictly not allowed.</h1>";
              $errorStatus=True;
              break;
            }
        }
      }

    if($errorStatus==False){//SUCCESS IF
      //No errors
      $author_name=$_SESSION['user_first']." ".$_SESSION['user_last'];
      //Insert the quote inside in the database using the query as we are good to go
      $insert_query = "INSERT INTO quotes(`quote_text`, `quote_author`) VALUES ('$quoteText','$author_name');";
      mysqli_query($conn,$insert_query);

      //Redirecting the page to home page for now
        $_SESSION['upload_msg']="Quote Uploaded!";
        // header("Location:./upload.php");

    }//end of success if
      
  ?>

<?php 
if(isset($_SESSION['upload_msg'])){
    echo "<script>alert('" . $_SESSION['upload_msg']."'); </script>";
    //to not make the error message appear again after refresh:
    unset($_SESSION['upload_msg']);
  }
?>

  </div>

</div>


<br><br><br>


<?php include "../loginForm/loginHome.php" ;?>
<?php include "../includes/footer.php"; ?>

</body>

</html>

