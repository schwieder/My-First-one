<?php

	require_once("Header.php");

    echo "<br />";
    $HomeId = "Flames";
    $AwayId = "Oilers";
    $HomeGames = ReadScalar(ExecuteSqlQuery("SELECT Games FROM hockeygames WHERE TeamId ='$HomeId'"));
    $AwayGames = ReadScalar(ExecuteSqlQuery("SELECT Games FROM hockeygames WHERE TeamId ='$AwayId'"));
    $HomeGames = $HomeGames + 1;
    $AwayGames = $AwayGames + 1;
    $insertQuery = "UPDATE hockeygames SET Games=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $HomeGames, $HomeId);
    $insertQuery = "UPDATE hockeygames SET Games=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $AwayGames, $AwayId);
    $HScore = 0;
    $AScore = 0;

    $Hgoalie = Array("Brick Wall", 0.91,19);
    $HgoalieSvP = $Hgoalie[1];
    $HgoalieDiff = ($HgoalieSvP - 0.91)*100;
    $Agoalie = Array("Soft Wall",0.91,39);
    $AgoalieSvP = $Hgoalie[1];
    $AgoalieDiff = ($AgoalieSvP - 0.91)*100;
    
    //////////////////////////////////////////////////////

    $HLW1 = Array("Matthew Tkachuk",14,1);
    $HC1 = Array("Elias Lindholm",12.5,2);
    $HRW1 = Array("Johnny Gaudreau",12.8,3);
    $HRD1 = Array("Noah Hanifin",4.3,4, 100); 
	$HLD1 = Array("Oliver Kylington",6.2,5, 100);

    $HLW2 = Array("Andrew Mangiapane",20.9,6);
    $HC2 = Array("Sean Monahan",10.7,7);
    $HRW2 = Array("Milan Lucic",18.2,8);
    $HRD2 = Array("Erik Gudbranson",0,9,130); 
	$HLD2 = Array("Rasmus Andersson",1.7,10,100);

    $HLW3 = Array("Blake Coleman", 6.5,11);
    $HC3 = Array("Mikael Backlund", 5.3,12);
    $HRW3 = Array("Dillon Dube", 6.1,13);
    $HRD3 = Array("Nikita Zadorov", 5.4,14,70); 
	$HLD3 = Array("Christopher Tanev", 3.0,15,50);


    $HLW4 = Array("Trevor Lewis", 6.1,16);
    $HC4 = Array("Tyler Pitlick", 0,17);
    $HRW4 = Array("Brad Richardson", 14.3,18);

    $HD1 = Array($HLD1, $HRD1);
    $HD2 = Array($HLD2, $HRD2);
    $HD3 = Array($HLD3, $HRD3);
    $HO1 = Array($HLW1, $HRW1, $HC1);
    $HO2 = Array($HLW2, $HRW2, $HC2);
    $HO3 = Array($HLW3, $HRW3, $HC3);
    $HO4 = Array($HLW4, $HRW4, $HC4);

    //////////////////////////////////////////

    $ALW1 = Array("Oiler Matthew Tkachuk",14,21);
    $AC1 = Array("Oiler Elias Lindholm",12.5,22);
    $ARW1 = Array("Oiler Johnny Gaudreau",12.8,23);
    $ARD1 = Array("Oiler Noah Hanifin",4.3,24, 100); 
	$ALD1 = Array("Oiler Oliver Kylington",6.2,25,100);

    $ALW2 = Array("Oiler Andrew Mangiapane",20.9,26);
    $AC2 = Array("Oiler Sean Monahan",10.7,27);
    $ARW2 = Array("Oiler Milan Lucic",18.2,28);
    $ARD2 = Array("Oiler Erik Gudbranson",0,29,100); 
	$ALD2 = Array("Oiler Rasmus Andersson",1.7,30,100);

    $ALW3 = Array("Oiler Blake Coleman", 6.5,31);
    $AC3 = Array("Oiler Mikael Backlund", 5.3,32);
    $ARW3 = Array("Oiler Dillon Dube", 6.1,33);
    $ARD3 = Array("Oiler Nikita Zadorov", 5.4,34,100); 
	$ALD3 = Array("Oiler Christopher Tanev", 3.0,35,100);


    $ALW4 = Array("Oiler Trevor Lewis", 6.1,36);
    $AC4 = Array("Oiler Tyler Pitlick", 0,37);
    $ARW4 = Array("Oiler Brad Richardson", 14.3,38);

    $AD1 = Array($ALD1, $ARD1);
    $AD2 = Array($ALD2, $ARD2);
    $AD3 = Array($ALD3, $ARD3);
    $AO1 = Array($ALW1, $ARW1, $AC1);
    $AO2 = Array($ALW2, $ARW2, $AC2);
    $AO3 = Array($ALW3, $ARW3, $AC3);
    $AO4 = Array($ALW4, $ARW4, $AC4);

    /////////////////////////////////////////////////////
    $TotalGoals = 0;
    $GoalInfo = array();
    $HShotsTotal = rand(45,55);
    $Heffort = rand(70,120)/100;
    $HShots = round($HShotsTotal - (($HShotsTotal*0.3) * ((($ARD1[3] + $ALD1[3])/200 * 0.44) + (($ARD2[3] + $ALD2[3])/200* 0.34) + (($ARD3[3] + $ALD3[3])/200*0.22)))* $Heffort);
    $blocked = $HShotsTotal - $HShots;

    // this is where we can enter shots blocked as a stat
    $HD1Stats = ReadScalar(ExecuteSqlQuery("SELECT * FROM hockeystats WHERE PlayerId ='$HomeId'"));
    $insertQuery = "INSERT INTO HockeyStats SET Name=?, Id=?";
    ExecuteSqlQuery($insertQuery, $v[0], $v[2]);


    $i=1;
    $AShotsTotal = rand(45,55);
    $Aeffort = rand(70,120)/100;
    $AShots = round($AShotsTotal - (($AShotsTotal*0.3) * ((($HRD1[3] + $HLD1[3])/200 * 0.44) + (($HRD2[3] + $HLD2[3])/200* 0.34) + (($HRD3[3] + $HLD3[3])/200*0.22)))* $Aeffort);
    $blocked = $AShotsTotal - $AShots;
    $ii=1;
    while($i<$HShots){
        if($i == 1)
        {
            $Per = "1";
        }
        else if($i == (floor($HShots/3)))
        {
            $Per = "2";
        }
        else if($i == (floor($HShots/3)*2))
        {
            $Per = "3";
        }
        
        if($i < $HShots)
        {
            $HShooter = rand (1,100);
            if($HShooter <13)
            {
                $k = array_rand($HD1);
                $v = $HD1[$k];
                $HShooterPercent =  $v[1];
            }
            else if($HShooter >12 && $HShooter<22)
            { 
                $k = array_rand($HD2);
                $v = $HD2[$k];
                $HShooterPercent =  $v[1];
            }
            else if($HShooter >21 && $HShooter<28)
            { 
                $k = array_rand($HD3);
                $v = $HD3[$k];
                $HShooterPercent =  $v[1];
            }
            else if($HShooter >27 && $HShooter<55)
            { 
                $k = array_rand($HO1);
                $v = $HO1[$k];
                $HShooterPercent =  $v[1];
            }
            else if($HShooter >54 && $HShooter<76)
            { 
                $k = array_rand($HO2);
                $v = $HO2[$k];
                $HShooterPercent =  $v[1];
            }
            else if($HShooter >75 && $HShooter<93)
            { 
                $k = array_rand($HO3);
                $v = $HO3[$k];
                $HShooterPercent =  $v[1];
            }
            else if($HShooter >92 && $HShooter<101)
            { 
                $k = array_rand($HO4);
                $v = $HO4[$k];
                $HShooterPercent =  $v[1];
            }

            $HShotChance = rand(0,1000)/10 - $AgoalieDiff;
            $HSuccess = 100-$HShooterPercent;
            if ($HShotChance < (100-$HShooterPercent)) {
            }
            else{
                $insertQuery = "INSERT INTO HockeyStats SET Name=?, Id=?";
                ExecuteSqlQuery($insertQuery, $v[0], $v[2]);
                $HScore++;
                $GoalInfo[$TotalGoals]["Period"]=$Per;
                $GoalInfo[$TotalGoals]["Person"]=$v[0];
                $GoalInfo[$TotalGoals]["HomeScore"]=$HScore;
                $GoalInfo[$TotalGoals]["AwayScore"]=$AScore;
                $GoalInfo[$TotalGoals]["i"]=$i;
                $TotalGoals++;
            }
            $i++;
        }

        if($ii < $AShots)
        {
            $AShooter = rand (1,100);
            if($AShooter <13)
            { 
                $k = array_rand($AD1);
                $v = $AD1[$k];
                $AShooterPercent =  $v[1];
            }
            else if($AShooter >12 && $AShooter<22)
            { 
                $k = array_rand($AD2);
                $v = $AD2[$k];
                $AShooterPercent =  $v[1];
            }
            else if($AShooter >21 && $AShooter<28)
            { 
                $k = array_rand($AD3);
                $v = $AD3[$k];
                $AShooterPercent =  $v[1];
            }
            else if($AShooter >27 && $AShooter<55)
            { 
                $k = array_rand($AO1);
                $v = $AO1[$k];
                $AShooterPercent =  $v[1];
            }
            else if($AShooter >54 && $AShooter<76)
            { 
                $k = array_rand($AO2);
                $v = $AO2[$k];
                $AShooterPercent =  $v[1];
            }
            else if($AShooter >75 && $AShooter<93)
            { 
                $k = array_rand($AO3);
                $v = $AO3[$k];
                $AShooterPercent =  $v[1];
            }
            else if($AShooter >92 && $AShooter<101)
            { 
                $k = array_rand($AO4);
                $v = $AO4[$k];
                $AShooterPercent =  $v[1];
            }

            $AShotChance = rand(0,1000)/10 - $HgoalieDiff;
            $ASuccess = 100-$AShooterPercent;
            if ($AShotChance < (100-$AShooterPercent)) {
            }
            else{
                /// need to figure this all out
                $Goals = ReadScalar(ExecuteSqlQuery("SELECT Goals FROM hkyplayers WHERE CompanyId ='$StockId' AND UserId = $UserId"));
                $insertQuery = "UPDATE HockeyPlayers SET Money=? WHERE Id=?";
                ExecuteSqlQuery($insertQuery, $NewMoney, $UserId);
                $insertQuery = "UPDATE HockeyPlayers SET Name=?, Id=?";
                ExecuteSqlQuery($insertQuery, $v[0], $v[2]);
                $AScore++;
                $GoalInfo[$TotalGoals]["Period"]=$Per;
                $GoalInfo[$TotalGoals]["Person"]=$v[0];
                $GoalInfo[$TotalGoals]["HomeScore"]=$HScore;
                $GoalInfo[$TotalGoals]["AwayScore"]=$AScore;
                $GoalInfo[$TotalGoals]["i"]=$i;
                $TotalGoals++;
                }
            $ii++;
        }
    }

$P = 0;
foreach($GoalInfo as $k=>$var){
    extract($var);
    if($Period > $P){
        $P++;
        echo "<br />Period $P";
        echo "<br /><br />";
    }
    $ins = "Goal scored by".$Person.". Home Score is: ".$HomeScore." Away Score: ".$AwayScore."";
    echo $ins."<br />";
}

echo "<br />Shots for the home team: $HShots. Shots for the away team: $AShots.<br />";
$HSave = $HShots - $AwayScore;
$HSavePer = round($HSave/$HShots,3);
$ASave = $AShots - $HomeScore;
$ASavePer = round($ASave/$AShots,3);
echo "$Hgoalie saved  $HSave shots, for a save percentage of $HSavePer. ";
echo "$Agoalie saved  $ASave shots, for a save percentage of $ASavePer. ";
// can enter the stuff above for stats
