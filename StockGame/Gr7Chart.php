<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");
	$Grade = $_SESSION['Grade'];
	if($Grade != "7"){ die; }
	
	$StockType = $_POST['StockType'];
	$Sort = $_POST['Sort'];

	echo '<table class="gridtable" id="admintable" style="text-align:center;"><tr></tr>
	<tr>'
		?>
		<th><input type='button' rel="Company" id=<?php echo $StockType;?> align="right" style="height:20px;width:100px;" class='btn btn-success Chart' value='Company'></th>
		<th><input type='button' rel="PrevPrice" id=<?php echo $StockType;?> align="right" style="height:20px;width:40px;" class='btn btn-success Chart' value='Price'></th>
		<th><input type='button' rel="EarningsCurr" id=<?php echo $StockType;?> align="right" style="height:20px;width:70px;" class='btn btn-success Chart' value='Curr Earn'></th>
		<th><input type='button' rel="EarningsPrev" id=<?php echo $StockType;?> align="right" style="height:20px;width:70px;" class='btn btn-success Chart' value='Prev Earn'></th>
		<th><input type='button' rel="Shares" id=<?php echo $StockType;?> align="right" style="height:20px;width:70px;" class='btn btn-success Chart' value='Shares'></th>
		<th><input type='button' rel="CurrAssets" id=<?php echo $StockType;?> align="right" style="height:20px;width:70px;" class='btn btn-success Chart' value='CurrAss'></th>
		<th><input type='button' rel="Inventory" id=<?php echo $StockType;?> align="right" style="height:20px;width:70px;" class='btn btn-success Chart' value='Inv'></th>
		<th><input type='button' rel="CurrLiab" id=<?php echo $StockType;?> align="right" style="height:20px;width:70px;" class='btn btn-success Chart' value='CurrLiab'></th>
		<th><input type='button' rel="TotAssets" id=<?php echo $StockType;?> align="right" style="height:20px;width:70px;" class='btn btn-success Chart' value='TotAss'></th>
		<th><input type='button' rel="TotLiab" id=<?php echo $StockType;?> align="right" style="height:20px;width:70px;" class='btn btn-success Chart' value='TotLiab'></th>
		<th><input type='button' rel="EBITDA" id=<?php echo $StockType;?> align="right" style="height:20px;width:70px;" class='btn btn-success Chart' value='EBITDA'></th>
		<th><input type='button' rel="InterestExpense" id=<?php echo $StockType;?> align="right" style="height:20px;width:70px;" class='btn btn-success Chart' value='IntExp'></th>
		<?php
	echo '
		';
	echo '</tr><tbody>';

	foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM stocks7 WHERE Sector = '$StockType' ORDER BY $Sort")) as $row)
	{
		echo '<tr>';
		echo '<td>'.$row['Company'].'</td>';
		echo '<td>'.$row['PrevPrice'].'</td>';
		echo '<td>'.$row['EarningsCurr'].'</td>';
		echo '<td>'.$row['EarningsPrev'].'</td>';
		echo '<td>'.$row['Shares'].'</td>';
		echo '<td>'.$row['CurrAssets'].'</td>';
		echo '<td>'.$row['Inventory'].'</td>';
		echo '<td>'.$row['CurrLiab'].'</td>';
		echo '<td>'.$row['TotAssets'].'</td>';
		echo '<td>'.$row['TotLiab'].'</td>';
		echo '<td>'.$row['EBITDA'].'</td>';
		echo '<td>'.$row['InterestExpense'].'</td>';
		echo '<td><input type="button" id="'.$row['StockId'].'" align="right" style="height:20px;width:70px;" class="btn btn-success Buy" value="Buy"></td>';
		echo '</tr>';
	}
	echo '</tbody>';

?>

<script type="text/javascript">
	$(document).ready(function(){
		$(".Chart").on('click', function(){
			var StockType = $(this).attr("id");
			var Sort = $(this).attr("rel");
			$.post("Gr7Chart.php", {StockType: StockType, Sort: Sort}, function(data){
				$("#Chart").html(data);
			});
		});
		$(".Buy").on('click', function(){
			var StockId = $(this).attr("id");
			$.post("Gr7Buy.php", {StockId: StockId}, function(data){
				$("#Chart").html(data);
			});
		});

	});

</script>
