<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

	

	If (logged_in())
	{
		
		$User = $_SESSION['User'];
		$UserId = $_SESSION['UserId'];
		$FName = $_SESSION['First'];
		$LName = $_SESSION['Last'];
		$Money = $_SESSION['Money']; //not for hky
		$Grade = $_SESSION['Grade']; //not for hky
		
		?>

<!doctype.html>


	<html>

	<head>
	
	<title>Stock game</title>
	<link rel="stylesheet" href="css/styles.css" />
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	</head>
	
	<body>

	<div id="wrapper">
				Don't be a Gambler 

	<div id="navMenu">
				
		
	<ul>
	<li><a href="profile.php">Menu</a>
		<ul>
			<?php
			if ($UserId=="27"){
				echo '<li><a href="login.php"  > Add students </a></li>';
			}
?>			<li><a href="Research.php"  > Research </a></li>
			<li><a href="Portfolio.php"  > Portfolio </a></li>
			<li><a href="logout.php"  > Logout </a></li>
		</ul>
	</li>
	</ul>
		
		
	</div>



<?php
	}

	?>