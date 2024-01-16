<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");
require __DIR__. '/vendor/autoload.php';

$UserId = $_SESSION['UserId']; 
$Week = ReadScalar(ExecuteSqlQuery("SELECT CurrentWeek FROM fantweek"));

If($UserId != 2){die;}

//update scores for each team
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT TeamId FROM fantteams")) as $TeamId)
{

    foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM fantteamsstarters WHERE TeamId = '$TeamId'")) as $Row)
    {   
        $TeamTotalPoints = 0;
        $LeagueId = $Row['LeagueId'];
        $Starters=[];
        array_push($Starters, $Row['Qb'], $Row['Rb'], $Row['Wr1'], $Row['Wr2'], $Row['K'], $Row['Flex']);

        $Players = count($Starters);
        while($Players>0)
        {
            $PId = $Starters[0];
            if($PId != 0)
            {
                $Stats =  ReadScalar(ExecuteSqlQuery("SELECT * FROM stats WHERE Week=$Week && PlayerId = $PId"));

                $Points = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId'"));
                $Count = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE PlayerId='$PId' && Week='$Week'"));
                if($Count != 0){
                    $PlayerPoints = 
                    (($Points['PassYds'] * ($Stats['PassYds'])/25))+
                    (($Points['PassTds']  * $Stats['PassTds']))+
                    (($Points['PassInts'] * $Stats['Ints']))+
                    (($Points['RushYds']  * ($Stats['RushYds'])/10))+
                    (($Points['RushTds']  * $Stats['RushTds']))+
                    (($Points['RecYds']   * ($Stats['RecYds']/10)))+
                    (($Points['RecTds']   * $Stats['RecTds']))+
                    (($Points['KORYds']   * ($Stats['KORYds']/10)))+
                    (($Points['KORTds']   * $Stats['KORTds']))+
                    (($Points['PRYds']    * ($Stats['PRYds']/10)))+
                    (($Points['PRTds']    * $Stats['PRTds']))+
                    (($Points['Fum']      * $Stats['Fumbles']))+
                    (($Points['FumLost']  * $Stats['FumblesLost']))+
                    ($Stats['KickPts']);
                }
                else{$PlayerPoints = '0';}
            }
            else
            {$PlayerPoints = '0';}
            $TeamTotalPoints = $TeamTotalPoints + $PlayerPoints;
            $Starters = array_values(array_diff($Starters, array($PId)));

            $Players = count($Starters);
        }
    }
    $insertQuery = "UPDATE fantresult SET Score='$TeamTotalPoints' WHERE Week='$Week' && Team='$TeamId'";
    ExecuteSqlQuery($insertQuery);
    echo "Update $TeamId has $TeamTotalPoints<br>";

}

//find out who wins and update results
$Op = "Opp";
$Wk = "Week$Week$Op";
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM fantschedule")) as $Row)
{
    $TeamId = $Row['TeamId'];
    $Opp = $Row[$Wk];
    $OppScore = ReadScalar(ExecuteSqlQuery("SELECT Score FROM fantresult WHERE Week = $Week && Team='$Opp'"));
    $TeamScore = ReadScalar(ExecuteSqlQuery("SELECT Score FROM fantresult WHERE Week = $Week && Team='$TeamId'"));
    $TeamInfo = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantteams WHERE TeamId='$TeamId'"));
    $Losses=$TeamInfo['Losses'];
    $Wins=$TeamInfo['Wins'];
    $Ties=$TeamInfo['Ties'];
    $PtsFor=$TeamInfo['PointsFor'] + $TeamScore;
    $PtsAgainst=$TeamInfo['PointsAgainst'] + $OppScore;

    if($OppScore > $TeamScore)
    {
        $Losses = $Losses+1;
        echo "$TeamId Losses<br>";
    }
    else if ($OppScore < $TeamScore)
    {
        $Wins=$Wins+1;
        echo "$TeamId Wins<br>";
    }
    else if ($OppScore == $TeamScore)
    {
        $Ties=$Ties+1;
        echo "$TeamId Ties<br>";
    }
    $NotZero = $Wins+$Losses;
    if($NotZero == 0){$NotZero = 1;}
    $Percentage= round($Wins / ($NotZero));
    $insertQuery = "UPDATE fantteams SET Losses='$Losses', Wins=$Wins, Ties=$Ties, WinPercent=$Percentage, PointsFor=$PtsFor, PointsAgainst=$PtsAgainst WHERE TeamId='$TeamId'";
    ExecuteSqlQuery($insertQuery);
}

//update season ydg etc. for each player 
$Count=0;
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM stats WHERE Week = $Week")) as $Row)
{
    $PId = $Row['PlayerId'];
    $PRow = ReadScalar(ExecuteSqlQuery("SELECT * FROM roster WHERE PlayerId='$PId'"));
    $PassYds = $Row['PassYds'] + $PRow['PassYds'];
    $PassTds = $Row['PassTds'] + $PRow['PassTds'];
    $Ints = $Row['Ints'] + $PRow['Ints'];
    $RushYds = $Row['RushYds'] + $PRow['RushYds'];
    $RushTds = $Row['RushTds'] + $PRow['RushTds'];
    $RecYds = $Row['RecYds'] + $PRow['RecYds'];
    $RecTds = $Row['RecTds'] + $PRow['RecTds'];
    $KORYds = $Row['KORYds'] + $PRow['KORYds'];
    $KORTds = $Row['KORTds'] + $PRow['KORTds'];
    $PRYds = $Row['PRYds'] + $PRow['PRYds'];
    $PRTds = $Row['PRTds'] + $PRow['PRTds'];
    $Fumbles = $Row['Fumbles'] + $PRow['Fumbles'];
    $FumblesLost = $Row['FumblesLost'] + $PRow['FumblesLost'];
    $KickPts = $Row['KickPts'] + $PRow['KickPts'];

    $insertQuery = "UPDATE roster SET 
    PassYds='$PassYds', PassTds='$PassTds', Ints='$Ints',
    RushYds='$RushYds', RushTds='$RushTds', 
    RecYds='$RecYds', RecTds='$RecTds', 
    KORYds='$KORYds', KORTds='$KORTds', 
    PRYds='$PRYds', PRTds='$PRTds', 
    Fumbles='$Fumbles', FumblesLost='$FumblesLost', 
    KickPts='$KickPts' 
    WHERE PlayerId='$PId'";
    ExecuteSqlQuery($insertQuery);

    echo "$PId updated<br>";
    $Count++;

}

$Week++;
$insertQuery = "UPDATE fantweek SET CurrentWeek=$Week";
ExecuteSqlQuery($insertQuery);
echo "Finished";

die;

