<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

	$LastUpdate = ReadScalar(ExecuteSqlQuery("SELECT LastUpdate4 FROM clock WHERE Id='1'"));
	echo "$LastUpdate pull was LastUpdate";
	$LastUpdate = strtotime($LastUpdate);
	$today = date('Y-m-d');
	$today = strtotime($today);
	$NextAdvance = $LastUpdate + 3600; //1hr = 3600, 1 day = 86400, 1 week = 604800;

	if($NextAdvance < $today)
	{
		echo "Next is $NextAdvance<br>";
		echo "Today is $today<br>";
		echo "LU is $LastUpdate<br>";
		echo "Next is less than LU, so it should advance";

		$Count = ReadScalar(ExecuteSqlQuery("SELECT COUNT(StockId) FROM stocks4"));
		echo $Count;
		$x = 1;
		While($x<=$Count)
		{
			$Stock = ReadScalar(ExecuteSqlQuery("SELECT * FROM stocks4 WHERE StockId ='$x'"));
			$Company = $Stock['Company'];

			$Growth = rand(-20,20)/100 + 1;
			$EarningsPrev = $Stock['EarningsCurr'];
			$Shares = $Stock['Shares'];
			$Company = $Stock['Company'];
			
			$PrevPrice = $EarningsPrev/$Shares;
			$EarningsCurr = $EarningsPrev/$Growth;
			$PrevPrice = number_format((float)$PrevPrice, 2, '.', '');
			$EarningsCurr = ceil($EarningsCurr);
			
			$insertQuery = "UPDATE stocks4 SET EarningsPrev=?, EarningsCurr=?, PrevPrice=? WHERE StockId=?";
			ExecuteSqlQuery($insertQuery, $EarningsPrev, $EarningsCurr, $PrevPrice, $x);
			
			echo "$Company is updated";
			echo "$x<br>";
			$x++;
		}	
		$today2 = date('Y-m-d');
		$insertQuery = "UPDATE clock SET LastUpdate4=? WHERE Id=?";
		ExecuteSqlQuery($insertQuery, $today2, "1");



	}
	else
	{
		echo "Next is $NextAdvance<br>";
		echo "Today is $today<br>";
		echo "LU is $LastUpdate<br>";
		echo "Next is more or equal than LU, so it should not advance";
	}

die;	
 



