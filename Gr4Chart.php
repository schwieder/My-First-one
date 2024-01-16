<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");
	$Grade = $_SESSION['Grade'];
	if($Grade != "4"){ die; }
	
	$StockType = $_POST['StockType'];
	$Sort = $_POST['Sort'];

	echo '<table class="gridtable" id="admintable" style="text-align:center;"><tr></tr>
	<tr>'
		?>
		<th><input type='button' rel="Company" id=<?php echo $StockType;?> align="right" style="height:20px;width:200px;" class='btn btn-success Chart' value='Company'></th>
		<th><input type='button' rel="PrevPrice" id=<?php echo $StockType;?> align="right" style="height:20px;width:130px;" class='btn btn-success Chart' value='Price'></th>
		<th><input type='button' rel="EarningsCurr" id=<?php echo $StockType;?> align="right" style="height:20px;width:200px;" class='btn btn-success Chart' value='Current Earnings'></th>
		<th><input type='button' rel="Shares" id=<?php echo $StockType;?> align="right" style="height:20px;width:200px;" class='btn btn-success Chart' value='# of Shareholders'></th>
		<?php
	echo '
		';
	echo '</tr><tbody>';

	foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM stocks4 WHERE Sector = '$StockType' ORDER BY $Sort")) as $row)
	{
		echo '<tr>';
		echo '<td>'.$row['Company'].'</td>';
		echo '<td>'.$row['PrevPrice'].'</td>';
		echo '<td>'.$row['EarningsCurr'].'</td>';
		echo '<td>'.$row['Shares'].'</td>';
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
			$.post("Gr4Chart.php", {StockType: StockType, Sort: Sort}, function(data){
				$("#Chart").html(data);
			});
		});
		$(".Buy").on('click', function(){
			var StockId = $(this).attr("id");
			$.post("Gr4Buy.php", {StockId: StockId}, function(data){
				$("#Chart").html(data);
			});
		});

	});

</script>
