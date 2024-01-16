<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

	

	If (logged_in())
	{
		
		$User = $_SESSION['User'];
		$UserId = $_SESSION['UserId'];
		$Role = $_SESSION['Role']; //not for hky
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

	<div id="menu">
		<a href="League.php">League</a>
		<a href="Team.php">Teams</a>
		<a href="Recruiting.php">Recruiting</a>
		<a href="hkyStats.php">Leaders</a>
	</div>

	<div id="navMenu">
				
		
	<ul>
	<li><a href="profile.php">Menu</a>
		<ul>
			<li><a href="Research.php"  > Research </a></li>
			<li><a href="Portfolio.php"  > Portfolio </a></li>
			<li><a href="logout.php"  > Logout </a></li>
		</ul>
	</li>
	</ul>
		
		
	</div>



<?php
	}

	?>