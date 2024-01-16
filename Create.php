<?php
die;
	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");


	$array = [
];
	$arrayLength = count($array);
        
        $i = 0;
        while ($i < $arrayLength)
        {
            echo $array[$i] ."<br />";
			$Company = $array[$i];
			$Growth = rand(-20,20)/100 + 1;
			$BrandEq = rand(15,50);
			$EarningsPrev =rand(200000,5000000);
			$Shares = rand(1,30)*10000;
			$PrevPrice = $EarningsPrev/$Shares;
			echo $EarningsPrev;
			echo " / ";
			echo $Shares;
			echo " = ";
			echo $PrevPrice;
			
			$EarningsCurr = $EarningsPrev/$Growth;


			$insertQuery = "INSERT INTO stocks5(Company,PrevPrice,Growth,EarningsCurr,EarningsPrev,Shares,BrandEquity, Sector) VALUES (?,?,?,?,?,?,?,'')";
			if(ExecuteSqlQuery($insertQuery, $Company,$PrevPrice,$Growth,$EarningsCurr,$EarningsPrev,$Shares, $BrandEq))
			{
				echo "$Company has been placed";
			}
            $i++;


        }

die;
