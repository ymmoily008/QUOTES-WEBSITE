<div class="collapse navbar-collapse" id="navbar-collapse-main">
	<ul class="nav navbar-nav navbar-right">
		
	
		<li><a  class="link1" href="../home/index.php">HOME </a></li>
		<li><a  class="link2" href="../Search/search_quotes.php">BROWSE </a></li>
		<li><a  class="link3" href="../authors/authors.php">AUTHORS </a></li>

		<?php
			 if(!isset($_SESSION['user_name'] )){
			 	echo "<li><a class=\"link4\" href=\"../rgform/regform.php\">REGISTER</a></li>";
			 	echo "<li><a class=\"link5\" href=\"#myModal\" data-toggle=\"modal\">LOGIN</a></li>";
			}else{
				echo "<li><a class=\"link9\" href=\"../myprofile/myprofile.php\">PROFILE</a></li>";
				echo "<li><a class=\"link8\" href=\"../Upload/upload.php\">UPLOAD</a></li>";
			}
		?>		

	<!-- 	<li><a  class="link4" href="../rgform/regform.php">REGISTER </a></li>
		<li><a  class="link5" href="#myModal" data-toggle="modal">LOGIN </a></li>
 -->

		<li><a  class="link6" href="../aboutus/aboutus.php">ABOUT </a></li>
		<?php
			 if(isset($_SESSION['user_name'] )){
			 	echo "<li><a  class=\"link7\" href=\"../includes/logoutAction.php\">LOGOUT</a></li>";
			}
		?>		

	</ul>
</div>

<script type="text/javascript">
	
	var url = window.location.pathname;
	var filename = url.substring(url.lastIndexOf('/')+1);

	var header = document.getElementById("navbar-collapse-main");
	// alert(filename);

	if(filename=="index.php"){
			var current_link = header.getElementsByClassName("link1");
			current_link[0].className+=" active";
	}
	else if(filename=="regform.php"){
		var current_link = header.getElementsByClassName("link4");
		current_link[0].className+=" active";
	}
	else if(filename=="aboutus.php"){
		var current_link = header.getElementsByClassName("link6");
		current_link[0].className+=" active";
	}

	else if(filename=="search_quotes.php"){
		var current_link = header.getElementsByClassName("link2");
		current_link[0].className+=" active";
	}
	else if(filename=="authors.php"){
		var current_link = header.getElementsByClassName("link3");
		current_link[0].className+=" active";
	}
	else if(filename=="upload.php"){
		var current_link = header.getElementsByClassName("link8");
		current_link[0].className+=" active";
	}
	else if(filename=="myprofile.php"){
		var current_link = header.getElementsByClassName("link9");
		current_link[0].className+=" active";
	}


	var login_link  = header.getElementsByClassName("link5");
	login_link[0].addEventListener("click", function() {
		this.className +=" active";
	});

</script>