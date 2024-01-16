<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

	$Grade = $_SESSION['Grade'];
	if($Grade != "5"){ die; }	

?>

<html>
	<head>
		<title>Stock Market</title>
		<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	</head>
	<body>

<script type="text/javascript">
	$(document).ready(function(){
		$(".Chart").on('click', function(){
			var StockType = $(this).attr("id");
			var Sort = $(this).attr("rel");
			$.post("Gr5Chart.php", {StockType: StockType, Sort: Sort}, function(data){
				$("#Chart").html(data);
				
			});	
		});
	});

</script>

	
<form method="post" action="Message.php">

	<div align="Center" id="Initial-Title">
	<br>
	Please select which industry you would like to research
	<br><br>
	<input type='button' rel="Company" id="Ma" align="right" style="height:20px;width:200px;" class='btn btn-success Chart' value='Manufacturing'>
	<input type='button' rel="Company" id="Te" align="left" style="height:20px;width:200px;" class='btn btn-success Chart' value='Technology'>	
	<input type='button' rel="Company" id="Di" align="left" style="height:20px;width:200px;" class='btn btn-success Chart' value='Dining Services'>	
	<input type='button' rel="Company" id="Ot" align="left" style="height:20px;width:200px;" class='btn btn-success Chart' value='Other'>	
	

	</div>
	<br>
	<div id="Chart" align="center">
	</div>
</form>
	
</body>
</html>
</form>
