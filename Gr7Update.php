<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

	$LastUpdate = ReadScalar(ExecuteSqlQuery("SELECT LastUpdate7 FROM clock WHERE Id='1'"));
	echo "$LastUpdate pull was LastUpdate";
	$LastUpdate = strtotime($LastUpdate);
	$today = date('Y-m-d');
	$today = strtotime($today);
	$NextAdvance = $LastUpdate + 0; //1hr = 3600, 1 day = 86400, 1 week = 604800;

	if($NextAdvance <= $today)
	{
		echo "Next is $NextAdvance<br>";
		echo "Today is $today<br>";
		echo "LU is $LastUpdate<br>";
		echo "Next is less than LU, so it should advance<br>";

		$Count = ReadScalar(ExecuteSqlQuery("SELECT COUNT(StockId) FROM stocks7"));
		echo $Count;
		$x = 1;
		While($x<=$Count)
		{
			$Stock = ReadScalar(ExecuteSqlQuery("SELECT * FROM stocks7 WHERE StockId ='$x'"));
			$Company = $Stock['Company'];
            
			$OldPrice = $Stock['PrevPrice'];
            echo "Old Price was $OldPrice...";
			$Growth = $Stock['Growth'];
            echo "Growth is $Growth...";
			$EarningsPrev = $Stock['EarningsCurr'];
			$Shares = $Stock['Shares'];
			$Brand = $Stock['BrandEquity'];
            $CurrAss = $Stock['CurrAssets'];
            $Inventory = $Stock['Inventory'];
            $CurrLiab = $Stock['CurrLiab'];
            $TotAss = $Stock['TotAssets'];
            $TotLiab = $Stock['TotLiab'];
            $EBITDA = $Stock['EBITDA'];
            $IntExp = $Stock['InterestExpense'];

            // start figuring out the price
            $PEG = ($EarningsPrev/$Shares)+$Brand;
            echo "Brand is $Brand and New PEG is $PEG...";
            $Quick = (($CurrAss - $Inventory)/$CurrLiab)-1;
            echo "New Quick is $Quick...";
            $Curr = ($CurrAss/$CurrLiab)-1.2;
            echo "New Curr is $Curr...";
            $Debt = ($TotLiab/$TotAss)-0.6;
            echo "New Debt is $Debt...";
            $D2E = ($TotLiab/($TotAss-$TotLiab))-2;
            echo "New D2E is $D2E...";
            $TIE = ($EBITDA/$IntExp)-2.5;
            echo "New TIE is $TIE...";
            
            $PEGAmt = (1+(rand(-3,3)/100))*(0.6*$PEG);
            $Amt = 0.08*$PEG;
            echo "New PEGAMT is $PEGAmt... EAch following should be close to $Amt...";
            $QuickAmt = (1+(rand(-10,10)/100))*((0.08+(0.08*$Quick))*$PEG);
            echo "New QuickAMT is $QuickAmt...";
            $CurrAmt = (1+(rand(-10,10)/100))*((0.08+(0.08*$Curr))*$PEG);
            echo "New CurrAMT is $CurrAmt...";
            $DebtAmt = (1+(rand(-10,10)/100))*((0.08+(0.08*-$Debt))*$PEG);
            echo "New DebtAMT is $DebtAmt...";
            $D2EAmt = (1+(rand(-10,10)/100))*((0.08+(0.08*$D2E))*$PEG);
            echo "New D2EAMT is $D2EAmt...";
            $TIEAmt = (1+(rand(-10,10)/100))*(((0.08*$TIE)/2)*$PEG);
            echo "New TIEAMT is $TIEAmt...";

            $PrevPrice = $PEGAmt+$QuickAmt+$CurrAmt+$DebtAmt+$D2EAmt+$TIEAmt;
			$PrevPrice = number_format((float)$PrevPrice, 2, '.', '');


            // calculate info for next 'year'
			$Growth = rand(-20,20)/100 + 1;
            $EarningsCurr = $EarningsPrev/($Growth);
			$EarningsCurr = ceil($EarningsCurr);
            $Rand = rand(-5,5)/100;
            $NewCurrAss = $CurrAss/($Growth+$Rand);
			$NewCurrAss = ceil($NewCurrAss);
            $Rand = rand(-5,5)/100;
            $NewInv = $Inventory/($Growth+$Rand);
			$NewInv = ceil($NewInv);
            $Rand = rand(-5,5)/100;
            $NewCurrLiab = $CurrLiab/($Growth+$Rand);
			$NewCurrLiab = ceil($NewCurrLiab);
            $Rand = rand(-5,5)/100;
            $NewTotAss = $TotAss/($Growth+$Rand);
			$NewTotAss = ceil($NewTotAss);
            $Rand = rand(-5,5)/100;
            $NewTotLiab = $TotLiab/($Growth+$Rand);
			$NewTotLiab = ceil($NewTotLiab);
            $Rand = rand(-5,5)/100;
            $NewEBITDA = $EBITDA/($Growth+$Rand);
			$NewEBITDA = ceil($NewEBITDA);
            $Rand = rand(-5,5)/100;
            $NewIntExp = $IntExp/($Growth+$Rand);
			$NewIntExp = ceil($NewIntExp);
            $NewBrand = rand(-5,5)+$Brand;
            if($NewBrand<0){$NewBrand=rand(15,50);}
            else if ($NewBrand>50){$NewBrand=35;}

			$insertQuery = "UPDATE stocks7 SET Growth=?, EarningsPrev=?, EarningsCurr=?, PrevPrice=?, BrandEquity=?, CurrAssets=?, CurrLiab=?, EBITDA=?, InterestExpense=?, Inventory=?, TotAssets=?, TotLiab=? WHERE StockId=?";
			ExecuteSqlQuery($insertQuery, $Growth, $EarningsPrev, $EarningsCurr, $PrevPrice, $NewBrand, $NewCurrAss, $NewCurrLiab, $NewEBITDA, $NewIntExp, $NewInv, $NewTotAss, $NewTotLiab, $x);
			
			echo "$Company is updated";
			echo "$x<br><br><br>";
			$x++;
		}
		$today2 = date('Y-m-d');
		$insertQuery = "UPDATE clock SET LastUpdate7=? WHERE Id=?";
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
 


