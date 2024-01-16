<?php

	date_default_timezone_set('America/Edmonton');
	require_once("MSql.php");
	require_once("Mfunctions.php");

	

	If (logged_in())
	{
		$Email = $_SESSION['Email'];
		$Id = ReadScalar(ExecuteSqlQuery("SELECT Id FROM 9users WHERE Email ='$Email'"));
		$TS = $_SESSION['TS'];



		if ($TS == "T")
		{

?>


<!doctype.html>


	<html>

	<head>

	<title>Social 9 Game </title>
	<link rel="stylesheet" href="/9/css/styles.css" />
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
   
	</head>

	<body>

	<div id="error" style=" <?php if($error !="") { ?> display:block; <?php } ?> "><?php echo $error ?></div>

	<div id="wrapper">
				This is Math 


	<div id="navMenu">
				
		
<ul>
<li><a href="9profile.php">Menu</a>
<ul>
<li><a href="9addClass.php"  > Add Class </a></li>
<li><a href="9Students2.php"  > Students </a></li>
<li><a href="9Business2.php"  > Edit Businesses </a></li>
<li><a href="9Advance.php"  > Advance </a></li>
<li><a href="9logout.php"  > Logout </a></li>

</ul>

</ul>

</li>
</ul>
		
		
		</div>

		
	
	<?php
	}
		if ($TS == "S")
	   {
			$ClassId = ReadScalar(ExecuteSqlQuery("SELECT ClassId FROM 9users WHERE Email ='$Email'"));
			$PMId = ReadScalar(ExecuteSqlQuery("SELECT ClassId FROM 9users WHERE Email ='$Email'"));
			$Inbox = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM message WHERE recipient = ? and Accept = ?", $Id, 'P'));
			

?>

<!doctype.html>


	<html>

	<head>
	
	<title>Social 9 game </title>
	<link rel="stylesheet" href="/9/css/styles.css" />
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	</head>
	
	<body>
	
	<div id="error" style=" <?php if($error !="") { ?> display:block; <?php } ?> "><?php echo $error ?></div>

	<div id="wrapper">
				This is Math 


	<div id="navMenu">
				
		
<ul>
<li><a href="9profile.php">Menu</a>
<ul>
<li><a href="9Try2.php"  > Questions </a></li>
<li><a href="9Inventory.php"  > Inventory </a></li>
<li><a href="9Country.php"  > Country Info</a></li>
<?php
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT  PM FROM PM WHERE ClassId = ?", $ClassId)) as $pm)
{
	if ($pm == $Id)
	{
		?><li><a href="9PMStudent.php"> Prime Minister </a></li><?php
	}
}
?>
<li><a href="9StuBusiness.php"  > Business Management </a></li>
<li><a href="9Life.php"  > Life </a></li>
<li><a href="9Family.php"  > Family </a></li>
<li><a href="9Message.php"  > Trade/Message(<?php echo $Inbox;?>)</a></li>
<li><a href="9logout.php"  > Logout </a></li>

</ul>

</li>
</ul>
		
		
		</div>
<?php
	
	
	   }
	}

	?>