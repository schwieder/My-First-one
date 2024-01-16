<?php

    echo "<br>";
    date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");

    $date=date('w');
    $time=date('h');
    if($date == 0){echo "You can't set your roster on Sunday's as some teams play on Sunday";die;}
    else if($date == 6){echo "You can't set your roster on Saturday's";die;}
    else if($date == 5 && $time >= '3'){echo "You can't set your rosterS on Friday's after 3pm mt as some teams play on Friday";die;}


    $UserId = $_SESSION['UserId'];
	$LeagueId = $_POST['LeagueId'];
    $TeamId = $_POST['TeamId'];
    $QbPos = $_POST['QbPos'];
    $QbId = $_POST['QbId'];
    $RbPos = $_POST['RbPos'];
    $RbId = $_POST['RbId'];
    $Wr1Pos = $_POST['Wr1Pos'];
    $Wr1Id = $_POST['Wr1Id'];
    $Wr2Pos = $_POST['Wr2Pos'];
    $Wr2Id = $_POST['Wr2Id'];
    $KPos = $_POST['KPos'];
    $KId = $_POST['KId'];
    $FlexPos = $_POST['FlexPos'];
    $FlexId = $_POST['FlexId'];
    $LeagueId = $_POST['LeagueId'];
    $array = [$QbId,$RbId,$Wr1Id,$Wr2Id,$FlexId,$KId];
    $z = array_unique($array);
    $x = 0;
    for ($i = 0; $i < count($z); $i++) {
        $x++;
    }

    if($QbPos!="QB"){echo "Your QB isn't set as a QB"; die;}
    else if($RbPos!="RB"){echo "Your RB isn't set as an RB";die;}
    else if($Wr1Pos!="WR"){echo "Your Wr1 isn't set as a Wr";die;}
    else if($Wr2Pos!="WR"){echo "Your Wr2 isn't set as a Wr";die;}
    else if($FlexPos=="QB"){echo "Your Flex can't be a QB";die;}
    else if($KPos!="K"){echo "Your Kicker isn't set as a K";die;}
    else if($x != 6){echo "There weren't 6 unique players chosen. A player was started more than once.";}
    else
    {
        // input into the table
        $insertQuery = "UPDATE fantteamsstarters SET Qb=$QbId, Rb=$RbId, Wr1=$Wr1Id, Wr2=$Wr2Id, K=$KId, Flex=$FlexId WHERE LeagueId=$LeagueId AND TeamId=$TeamId AND OwnerId=$UserId";
        ExecuteSqlQuery($insertQuery);
        echo "your starters have been set."; 
    }
