<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>PHPSpellCheck Example - Did You Mean Example</title>
</head>
<body>
<h2>Did You Mean....  SpellCheck Search Results</h2>

<?php
require "../include.php"   ;

$seachText = isset($_GET['searchBox'])?$_GET['searchBox']:"Hello wosrld";
 

function suggestionslink ($input){
	if((trim($input))==""){return "";}

	$spellcheckObject = new PHPSpellCheck();
	$spellcheckObject -> LicenceKey = "TRIAL";
	$spellcheckObject -> DictionaryPath = ("../dictionaries/");
	$spellcheckObject -> LoadDictionary("English (International)") ;  //OPTIONAL//
	$spellcheckObject -> LoadCustomDictionary("custom.txt");
    $suggestionText = $spellcheckObject ->didYouMean($input);

	if($suggestionText==""){return "";}

	return "<a href='".$_SERVER["SCRIPT_NAME"]."?searchBox=".htmlentities($suggestionText)."'>".$suggestionText."</a>";

}

?>

<form action="" method="get">
<input type="text" name="searchBox"  id="searchBox" value="<?echo $seachText?>" /><input type="submit" value="Search"  />
<h4><?php echo suggestionslink($seachText) ;?></h4>
</form>

</body>
</html>