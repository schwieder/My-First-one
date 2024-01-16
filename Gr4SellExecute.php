<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

	$Grade = $_SESSION['Grade'];
	if($Grade != "4"){ echo "You're not in Gr 4, if you are please contact the administrator"; die; }
	
	$Money = $_SESSION['Money'];
	$UserId = $_SESSION['UserId'];
	$StockId = $_POST['StockId'];
	$Amount = $_POST['amount'];
	$TotalAmount = ReadScalar(ExecuteSqlQuery("SELECT Amount FROM trades WHERE CompanyId ='$StockId' AND UserId = $UserId"));
	$Stock = ReadScalar(ExecuteSqlQuery("SELECT * FROM stocks4 WHERE StockId ='$StockId'"));
	$StockName = $Stock['Company'];
	$StockPrice = $Stock['PrevPrice'];
	$Value = $Amount*$StockPrice;
	$Value2 = $Value - 25;
	$Remaining = $TotalAmount - $Amount;
	
	if($Amount <0)
	{
		$NewMoney = ($Money - 1000);
		$insertQuery = "UPDATE users SET Money=? WHERE Id=?";
		ExecuteSqlQuery($insertQuery, $NewMoney, $UserId);
		$_SESSION['Money'] = $NewMoney;

		echo "You have attempted to cheat the system by selling a negative amount of stock. You have been penalized $1,000 You currently have $NewMoney in your account.";

	}
	else if ($Remaining < 0)
	{
		$NewMoney = ($Money - 1000);
		$insertQuery = "UPDATE users SET Money=? WHERE Id=?";
		ExecuteSqlQuery($insertQuery, $NewMoney, $UserId);
		$_SESSION['Money'] = $NewMoney;
		
		echo "You have attempted to cheat the system by selling more stock then you have. You have been penalized $1,000 You currently have $NewMoney in your account.";
		
	}
	else if($Remaining > 0){
		$NewMoney = ($Money + $Value2);
		$insertQuery = "UPDATE trades SET Amount=? WHERE CompanyId = ? AND UserId = ?";
		ExecuteSqlQuery($insertQuery, $Remaining, $StockId, $UserId);
		$_SESSION['Money'] = $NewMoney;
		$insertQuery = "UPDATE users SET Money=? WHERE Id=?";
		ExecuteSqlQuery($insertQuery, $NewMoney, $UserId);
		
		echo "You have sold $Amount of $StockName earning you $Value2. You currently have $NewMoney in your account.";
		echo "<br>";
		echo "Transaction was $Amount x $StockPrice = $Value - $25 = $Value2";
		echo "<br>";
		echo "$Value2 + $Money = $NewMoney";
		
	}
	else if($Remaining == 0){
		$NewMoney = ($Money + $Value2);
		$insertQuery = "DELETE FROM trades WHERE CompanyId = ? AND UserId = ?";
		ExecuteSqlQuery($insertQuery, $StockId, $UserId);
		$_SESSION['Money'] = $NewMoney;
		$insertQuery = "UPDATE users SET Money=? WHERE Id=?";
		ExecuteSqlQuery($insertQuery, $NewMoney, $UserId);
		
		echo "You have sold $Amount of $StockName earning you $Value2. You currently have $NewMoney in your account.";
		echo "<br>";
		echo "Transaction was $Amount x $StockPrice = $Value - $25 = $Value2";
		echo "<br>";
		echo "$Value2 + $Money = $NewMoney";
		
	}

	?><br><br><?php
	echo '<input type="button" name="return" class="btn btn-success return" value="Return to Portfolio">';

?>




<script type="text/javascript">
	$(document).ready(function(){
		$(".return").on('click', function(){
			$.post("Portfolio.php", {}, function(data){
				$("#Research").html(data);
			});
		});
	});

</script>
