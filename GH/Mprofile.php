<?php

	require_once("MHeader.php");
	
	$error = "";

	if ($TS == 'T')
{
?>
	<html>
<head>
<title>Page Title</title>
</head>
<body>

<h1>Instructions</h1>
<p>

Math
</p>


</body>
</html>
	
<?php
}

if ($TS != 'T')
{
?>
	<html>
<head>
<title>Page Title</title>
</head>
<body>
<br>
<h1 align=center>Instructions - PLEASE READ!!!!	</h1>
<p>
<?php
$SId = ReadScalar(ExecuteSqlQuery("SELECT Id FROM musers WHERE Email ='$Email'"));
?>

Math

<?php
}


?>
</p>

</body>
</html>
		</div
		
	</body>
	
</html>