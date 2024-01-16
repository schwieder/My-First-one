<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

	$Grade = $_SESSION['Grade'];
	if($Grade != "5"){ echo "You're not in Gr 5, if you are please contact the administrator"; die; }

	$UserId = $_SESSION['UserId'];
	$Money = $_SESSION['Money'];
	$TotalValue = 0;
?>

<html>
	<head>
		<title>Stock Market Game</title>
		<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	</head>
	<body>

<script type="text/javascript">
$(document).ready(function(){
	$(".Sell").on('click', function(){
		var StockId = $(this).attr("id");
		$.post("Gr5Sell.php", {StockId: StockId}, function(data){
			$("#Research").html(data);
		});
	});
});

</script>

	
<form method="post" action="Research.php">
<br>
<br>

	<div align="Center" id="Research">
	<br>

<?php

	echo '<table class="gridtable" id="admintable" style="text-align:center;"><tr></tr>
	<tr>'
		?>
		<th>Company Name</th>
		<th>Sector</th>
		<th>Current Price</th>
		<th>Amount Held</th>
		<th>Value</th>
		<?php
	echo '
		';
	echo '</tr><tbody>';

	foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM trades WHERE UserId = '$UserId' ORDER BY Amount Desc")) as $row)
	{
		$CId = $row['CompanyId'];
		$Amount = $row['Amount'];
		$result = ReadScalar(ExecuteSqlQuery("SELECT * FROM stocks5 WHERE StockId ='$CId'"));
		$Price = $result['PrevPrice'];
		$Value = $Price*$Amount;
		$TotalValue = $TotalValue + $Value;
		if($result['Sector'] == "Te"){$Sector = "Technology";}
		else if($result['Sector'] == "Ma"){$Sector = "Maufacturing";}
		else if($result['Sector'] == "Di"){$Sector = "Dining";}
		else if($result['Sector'] == "Ot"){$Sector = "Other";}

		echo '<tr>';
		echo '<td>'.$result['Company'].'</td>';
		echo '<td>'.$Sector.'</td>';
		echo '<td>'.$Price.'</td>';
		echo '<td>'.$Amount.'</td>';
		echo '<td>'.$Value.'</td>';
		echo '<td><input type="button" id="'.$row['CompanyId'].'" align="right" style="height:20px;width:70px;" class="btn btn-success Sell" value="Sell"></td>';
		echo '</tr>';
	}
	
		echo '<td>Cash</td>';
		echo '<td> - </td>';
		echo '<td> - </td>';
		echo '<td> - </td>';
		echo '<td>'.$Money.'</td>';
		echo '</tr>';
	$TotalValue = $TotalValue + $Money;
		echo '<td>Total Value</td>';
		echo '<td> - </td>';
		echo '<td> - </td>';
		echo '<td> - </td>';
		echo '<td>'.$TotalValue.'</td>';
		echo '</tr>';

	echo '</tbody>';

?>


</form>
	
</body>
</html>
</form>



