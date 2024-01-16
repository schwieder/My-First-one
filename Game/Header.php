<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");
    require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'init.php');



	If (logged_in())
	{
		
		$User = $_SESSION['User'];
		$UserId = $_SESSION['UserId'];
		
		?>

<!doctype.html>


	<html>

	<head>
	
	<title>Baseball game</title>
	<link rel="stylesheet" href="css/styles.css" />
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	</head>
	
	<body>

	<div id="wrapper">
				homerun? 

	<div id="navMenu">
				
		
	<ul>
	<li><a href="profile.php">Menu</a>
		<ul>
			<?php
			if ($UserId=="27"){
				echo '<li><a href="login.php"  > Add students </a></li>';
			}
?>			<li><a href="roll.php"  > roll </a></li>
			<li><a href="logout.php"  > Logout </a></li>
		</ul>
	</li>
	</ul>
		
		
	</div>



<?php
	}
	else
	{
		header ('location: index.php');
	}

	?>