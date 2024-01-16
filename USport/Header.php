<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

	

	If (logged_in())
	{
		$Email = $_SESSION['Email'];
?>


<!doctype.html>


	<html>

	<head>

		<title>USports Fantasy</title>
		<link rel="stylesheet" href="css/styles.css" />
		<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
   
	</head>

	<body>

	<div id="wrapper">

	<div id="navMenu">
				
			
	<ul>
	<li><a href="profile.php">Menu</a>
	<ul>
	<li><a href="logout.php"  > Logout </a></li>

	</ul>

	</ul>

	</li>
	</ul>
			
		
		</div>

		<br><br>
	
	<?php
	}
	else
	{
		header("location:logout.php");
		exit();
	}
