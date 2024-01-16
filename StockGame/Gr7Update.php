<?php

	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

	$LastUpdate = ReadScalar(ExecuteSqlQuery("SELECT LastUpdate7 FROM clock WHERE Id='1'"));
	echo "$LastUpdate pull was LastUpdate";
	$LastUpdate = strtotime($LastUpdate);
	$today = date('Y-m-d');
	$today = strtotime($today);
	$NextAdvance = $LastUpdate + (86400*2); //1hr = 3600, 1 day = 86400, 1 week = 604800;

//	if($NextAdvance <= $today)
	if(1==1)
	{
		echo "Next is $NextAdvance<br>";
		echo "Today is $today<br>";
		echo "LU is $LastUpdate<br>";
		echo "Next is less than LU, so it should advance<br>";

		$Count = ReadScalar(ExecuteSqlQuery("SELECT COUNT(StockId) FROM stocks7"));
//		echo $Count;
		$x = 1;
		While($x<=$Count)
		{
			echo $x;
			$Stock = ReadScalar(ExecuteSqlQuery("SELECT * FROM stocks7 WHERE StockId ='$x'"));
			$Company = $Stock['Company'];
            
			$OldPrice = $Stock['PrevPrice'];
			$Growth = $Stock['Growth'];
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
            $Quick = (($CurrAss - $Inventory)/$CurrLiab)-1;
            $Curr = ($CurrAss/$CurrLiab)-1.2;
            $Debt = ($TotLiab/$TotAss)-0.6;
            $D2E = ($TotLiab/($TotAss-$TotLiab))-2;
            $TIE = ($EBITDA/$IntExp)-2.5;
            

            $PEGAmt = (0.41*$PEG);
            $Amt = 0.08*$PEG;
            $QuickAmt = ((0.17+(0.17*$Quick))*$PEG);  //(1+(rand(-10,10)/100))*((0.08+(0.08*$Quick))*$PEG);
            $CurrAmt = ((0.11+(0.11*$Curr))*$PEG);
            $DebtAmt = ((0.17+(0.17*-$Debt))*$PEG);
            $D2EAmt = ((0.11+(0.11*$D2E))*$PEG);
            $TIEAmt = (((0.03*$TIE)/2)*$PEG);

            $PrevPrice = $PEGAmt+$QuickAmt+$CurrAmt+$DebtAmt+$D2EAmt+$TIEAmt;
			$PrevPrice = number_format((float)$PrevPrice, 2, '.', '');
		
            if($PrevPrice < 0){
        		$Company = $x;
				$Growth = rand(-20,20)/100 + 1;
				$BrandEq = rand(15,50);
				$EarningsPrev =rand(200000,5000000);
				$EarningsCurr = Ceil($EarningsPrev/$Growth);
				$Shares = rand(1,30)*10000;
				$PrevPrice = $EarningsPrev/$Shares + $BrandEq;
				$CurrAss = Ceil(rand(20,70)/10*$EarningsCurr);
				$Inv = rand(70,135)/100*$EarningsCurr; 
				$CurrLiab = Ceil(rand(70,93)/100*$CurrAss);
				$TotAss = Ceil(rand(100,150)/10*$EarningsCurr);
				$TotLiab = Ceil(rand(35,70)/100*$TotAss);
				$EBIT = Ceil(rand(150,195)/100*$EarningsCurr);
				$IntExp = Ceil(rand(30,60)/100*$EarningsCurr);

				/////////////// Remember to enter the code //////////////////
				$insertQuery = "UPDATE stocks7 SET PrevPrice=?,Growth=?,EarningsCurr=?,EarningsPrev=?,Shares=?,BrandEquity=?,CurrAssets=?,Inventory=?,CurrLiab=?,TotAssets=?,TotLiab=?,EBITDA=?,InterestExpense=? WHERE StockId=?";
				ExecuteSqlQuery($insertQuery, $PrevPrice,$Growth,$EarningsCurr,$EarningsPrev,$Shares, $BrandEq, $CurrAss, $Inv, $CurrLiab, $TotAss, $TotLiab, $EBIT, $IntExp, $x);
                $x++;

            }
        	else {

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
                
                $x++;
		    }
		$today2 = date('Y-m-d');
		$insertQuery = "UPDATE clock SET LastUpdate7=? WHERE Id=?";
		ExecuteSqlQuery($insertQuery, $today2, "1");
		}
	}
	else
	{
		echo "Next is $NextAdvance<br>";
		echo "Today is $today<br>";
		echo "LU is $LastUpdate<br>";
		echo "Next is more or equal than LU, so it should not advance";
	}

die;	
 



