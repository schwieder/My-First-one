<?php

	require_once("Header.php");

	$Grade = $_SESSION['Grade'];
	
?>

<html>
	<head>
		<title>Stock Market Game</title>
		<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	</head>
	<body>

<script type="text/javascript">
function Gr4()
{

	$.ajax({

			url:"Gr4Portfolio.php",
			type:"POST",
			success: function(show_students){

				if(!show_students.error) {

					$("#Research").html(show_students);

				}
			}

		});

}
function Gr5()
{

	$.ajax({

			url:"Gr5Portfolio.php",
			type:"POST",
			success: function(show_students){

				if(!show_students.error) {

					$("#Research").html(show_students);

				}
			}

		});

}
function Gr7()
{

	$.ajax({

			url:"Gr7Portfolio.php",
			type:"POST",
			success: function(show_students){

				if(!show_students.error) {

					$("#Research").html(show_students);

				}
			}

		});

}

$(document).ready(function(){

<?php

if($Grade == "4"){
?>
	Gr4();
<?php
}
else if($Grade == "5"){
?>
	Gr5();
<?php
}
else if($Grade == "7"){
?>
	Gr7();
<?php
}
else {
?>
	alert("This page isn't for you");
<?php
}
?>

});

</script>

	
<form method="post" action="Research.php">

	<div align="Center" id="Research">
	<br>


</form>
	
</body>
</html>
</form>