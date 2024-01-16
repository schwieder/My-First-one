<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

	$Grade = $_SESSION['Grade'];
	if($Grade != "7"){ echo "You're not in Gr 7, if you are please contact the administrator"; die; }
	
	$Money = $_SESSION['Money'];
	$UserId = $_SESSION['UserId'];
	$Amount = $_POST['amount'];
	$StockId = $_POST['StockId'];
	$Stock = ReadScalar(ExecuteSqlQuery("SELECT * FROM stocks7 WHERE StockId ='$StockId'"));
	$StockName = $Stock['Company'];
	$StockPrice = $Stock['PrevPrice'];
	$Cost = $Amount*$StockPrice;

	$NewMoney = ($Money) - ($StockPrice*$Amount);
	$NewMoney = number_format((float)$NewMoney, 2, '.', '');	
	if($NewMoney < 0)
	{
		echo "You don't have enough money for this. You will be charged $100 for wasting the broker's time";
		$NewMoney = $Money-100;
		$insertQuery = "UPDATE stockusers SET Money=? WHERE Id=?";
		ExecuteSqlQuery($insertQuery, $NewMoney, $UserId);
		$_SESSION['Money'] = $Money-100;
	}
	else if(Stock_Exists($StockId))
	{
		$insertQuery = "UPDATE stockusers SET Money=? WHERE Id=?";
		ExecuteSqlQuery($insertQuery, $NewMoney, $UserId);
		$_SESSION['Money'] = $NewMoney;
		
		$result =  ReadScalar(ExecuteSqlQuery("SELECT * FROM trades WHERE UserId ='$UserId' AND CompanyId = $StockId"));
		$AmountPrev = $result['Amount'];
		$NewAmount = $AmountPrev + $Amount;

		$insertQuery = "UPDATE trades SET Amount=? WHERE UserId=? AND CompanyId=?";
		ExecuteSqlQuery($insertQuery, $NewAmount, $UserId, $StockId);
	
		echo "You now own $NewAmount shares of $StockName with $$NewMoney remaining";
		echo "<br>";
		echo "Transaction was $Amount x $StockPrice = $Cost";
	}
	else
	{
		$insertQuery = "UPDATE stockusers SET Money=? WHERE Id=?";
		ExecuteSqlQuery($insertQuery, $NewMoney, $UserId);
		$_SESSION['Money'] = $NewMoney;
		
		$insertQuery = "INSERT INTO trades(UserId,CompanyId,Amount) VALUES (?,?,?)";
		ExecuteSqlQuery($insertQuery, $UserId,$StockId,$Amount);
	
		echo "You now own $Amount shares of $StockName with $$NewMoney remaining";
		echo "<br>";
		echo "Transaction was $Amount x $StockPrice = $Cost";
	}

