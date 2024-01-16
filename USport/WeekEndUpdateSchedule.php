<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");
require __DIR__. '/vendor/autoload.php';

//////////////////have to change Week every week ////////////////////////
$UserId = $_SESSION['UserId']; 

If($UserId != 3){die;}
$Week = ReadScalar(ExecuteSqlQuery("SELECT CurrentWeek FROM fantweek"));
echo "Week is $Week<br>";

///////////////////////////////////2nd//////////////////////////////

foreach(MysqlFetchData(ExecuteSqlQuery("SELECT LeagueId FROM fantleagues")) as $LeagueId)
{
    $WO= "Week".$Week."Opp";
    echo "WO is $WO<br>";
    foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM fantteamsstarters WHERE LeagueId = '$LeagueId'")) as $TInfo)
    {
        $Team = $TInfo['TeamId'];
        $Qb = $TInfo['Qb'];
        $Rb = $TInfo['Rb'];
        $Wr1 = $TInfo['Wr1'];
        $Wr2 = $TInfo['Wr2'];
        $K = $TInfo['K'];
        $Flex = $TInfo['Flex'];
        $Stats1 =  ReadScalar(ExecuteSqlQuery("SELECT * FROM stats WHERE Week=$Week && PlayerId = $Qb"));
        $Stats2 =  ReadScalar(ExecuteSqlQuery("SELECT * FROM stats WHERE Week=$Week && PlayerId = $Rb"));
        $Stats3 =  ReadScalar(ExecuteSqlQuery("SELECT * FROM stats WHERE Week=$Week && PlayerId = $Wr1"));
        $Stats4 =  ReadScalar(ExecuteSqlQuery("SELECT * FROM stats WHERE Week=$Week && PlayerId = $Wr2"));
        $Stats5 =  ReadScalar(ExecuteSqlQuery("SELECT * FROM stats WHERE Week=$Week && PlayerId = $K"));
        $Stats6 =  ReadScalar(ExecuteSqlQuery("SELECT * FROM stats WHERE Week=$Week && PlayerId = $Flex"));

        $Points = ReadScalar(ExecuteSqlQuery("SELECT * FROM fantleagues WHERE LeagueId = '$LeagueId'"));
        $sql1 = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE PlayerId='$Qb' && Week='$Week'"));
        if($sql1 != 0){
            $TotalPoints1 = 
            (($Points['PassYds'] * ($Stats1['PassYds'])/25))+
            (($Points['PassTds']  * $Stats1['PassTds']))+
            (($Points['PassInts'] * $Stats1['Ints']))+
            (($Points['RushYds']  * ($Stats1['RushYds'])/10))+
            (($Points['RushTds']  * $Stats1['RushTds']))+
            (($Points['RecYds']   * ($Stats1['RecYds']/10)))+
            (($Points['RecTds']   * $Stats1['RecTds']))+
            (($Points['KORYds']   * ($Stats1['KORYds']/10)))+
            (($Points['KORTds']   * $Stats1['KORTds']))+
            (($Points['PRYds']    * ($Stats1['PRYds']/10)))+
            (($Points['PRTds']    * $Stats1['PRTds']))+
            (($Points['Fum']      * $Stats1['Fumbles']))+
            (($Points['FumLost']  * $Stats1['FumblesLost']))+
            ($Stats1['KickPts']);
        }
        else{$TotalPoints1 = '0';}

        $sql2 = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE PlayerId='$Rb' && Week='$Week'"));
        if($sql2 != 0){
            $TotalPoints2 = 
            (($Points['PassYds'] * ($Stats2['PassYds'])/25))+
            (($Points['PassTds']  * $Stats2['PassTds']))+
            (($Points['PassInts'] * $Stats2['Ints']))+
            (($Points['RushYds']  * ($Stats2['RushYds'])/10))+
            (($Points['RushTds']  * $Stats2['RushTds']))+
            (($Points['RecYds']   * ($Stats2['RecYds']/10)))+
            (($Points['RecTds']   * $Stats2['RecTds']))+
            (($Points['KORYds']   * ($Stats2['KORYds']/10)))+
            (($Points['KORTds']   * $Stats2['KORTds']))+
            (($Points['PRYds']    * ($Stats2['PRYds']/10)))+
            (($Points['PRTds']    * $Stats2['PRTds']))+
            (($Points['Fum']      * $Stats2['Fumbles']))+
            (($Points['FumLost']  * $Stats2['FumblesLost']))+
            ($Stats2['KickPts']);
        }
        else{$TotalPoints2 = '0';}

        $sql3 = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE PlayerId='$Wr1' && Week='$Week'"));
        if($sql3 != 0){

            $TotalPoints3 = 
            (($Points['PassYds'] * ($Stats3['PassYds'])/25))+
            (($Points['PassTds']  * $Stats3['PassTds']))+
            (($Points['PassInts'] * $Stats3['Ints']))+
            (($Points['RushYds']  * ($Stats3['RushYds'])/10))+
            (($Points['RushTds']  * $Stats3['RushTds']))+
            (($Points['RecYds']   * ($Stats3['RecYds']/10)))+
            (($Points['RecTds']   * $Stats3['RecTds']))+
            (($Points['KORYds']   * ($Stats3['KORYds']/10)))+
            (($Points['KORTds']   * $Stats3['KORTds']))+
            (($Points['PRYds']    * ($Stats3['PRYds']/10)))+
            (($Points['PRTds']    * $Stats3['PRTds']))+
            (($Points['Fum']      * $Stats3['Fumbles']))+
            (($Points['FumLost']  * $Stats3['FumblesLost']))+
            ($Stats3['KickPts']);
        }
        else{$TotalPoints3 = '0';}

        $sql4 = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE PlayerId='$Wr2' && Week='$Week'"));
        if($sql4 != 0){
            $TotalPoints4 = 
            (($Points['PassYds'] * ($Stats4['PassYds'])/25))+
            (($Points['PassTds']  * $Stats4['PassTds']))+
            (($Points['PassInts'] * $Stats4['Ints']))+
            (($Points['RushYds']  * ($Stats4['RushYds'])/10))+
            (($Points['RushTds']  * $Stats4['RushTds']))+
            (($Points['RecYds']   * ($Stats4['RecYds']/10)))+
            (($Points['RecTds']   * $Stats4['RecTds']))+
            (($Points['KORYds']   * ($Stats4['KORYds']/10)))+
            (($Points['KORTds']   * $Stats4['KORTds']))+
            (($Points['PRYds']    * ($Stats4['PRYds']/10)))+
            (($Points['PRTds']    * $Stats4['PRTds']))+
            (($Points['Fum']      * $Stats4['Fumbles']))+
            (($Points['FumLost']  * $Stats4['FumblesLost']))+
            ($Stats4['KickPts']);
        }
        else{$TotalPoints4 = '0';}

        $sql5 = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE PlayerId='$K' && Week='$Week'"));
        if($sql5 != 0){
            $TotalPoints5 = 
            (($Points['PassYds'] * ($Stats5['PassYds'])/25))+
            (($Points['PassTds']  * $Stats5['PassTds']))+
            (($Points['PassInts'] * $Stats5['Ints']))+
            (($Points['RushYds']  * ($Stats5['RushYds'])/10))+
            (($Points['RushTds']  * $Stats5['RushTds']))+
            (($Points['RecYds']   * ($Stats5['RecYds']/10)))+
            (($Points['RecTds']   * $Stats5['RecTds']))+
            (($Points['KORYds']   * ($Stats5['KORYds']/10)))+
            (($Points['KORTds']   * $Stats5['KORTds']))+
            (($Points['PRYds']    * ($Stats5['PRYds']/10)))+
            (($Points['PRTds']    * $Stats5['PRTds']))+
            (($Points['Fum']      * $Stats5['Fumbles']))+
            (($Points['FumLost']  * $Stats5['FumblesLost']))+
            ($Stats5['KickPts']);
        }
        else{$TotalPoints5 = '0';}

        $sql6 = ReadScalar(ExecuteSqlQuery("SELECT COUNT(*) FROM stats WHERE PlayerId='$Flex' && Week='$Week'"));
        if($sql6 != 0){
            $TotalPoints6 = 
            (($Points['PassYds'] * ($Stats6['PassYds'])/25))+
            (($Points['PassTds']  * $Stats6['PassTds']))+
            (($Points['PassInts'] * $Stats6['Ints']))+
            (($Points['RushYds']  * ($Stats6['RushYds'])/10))+
            (($Points['RushTds']  * $Stats6['RushTds']))+
            (($Points['RecYds']   * ($Stats6['RecYds']/10)))+
            (($Points['RecTds']   * $Stats6['RecTds']))+
            (($Points['KORYds']   * ($Stats6['KORYds']/10)))+
            (($Points['KORTds']   * $Stats6['KORTds']))+
            (($Points['PRYds']    * ($Stats6['PRYds']/10)))+
            (($Points['PRTds']    * $Stats6['PRTds']))+
            (($Points['Fum']      * $Stats6['Fumbles']))+
            (($Points['FumLost']  * $Stats6['FumblesLost']))+
            ($Stats6['KickPts']);
        }
        else{$TotalPoints6 = '0';}

        $Score = $TotalPoints1 + $TotalPoints2 + $TotalPoints3 + $TotalPoints4 + $TotalPoints5 + $TotalPoints6;

        $insertQuery = "UPDATE fantresult SET Score='$Score' WHERE Team='$Team' && Week='$Week'";
        ExecuteSqlQuery($insertQuery);
    }

}


foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM fantschedule")) as $Opp)
{
    $Team = $Opp['TeamId'];
    $Op = $Opp[$WO];
    $TeamScore =  ReadScalar(ExecuteSqlQuery("SELECT Score FROM fantresult WHERE Team = '$Team' && Week='$Week'"));
    $OpScore =  ReadScalar(ExecuteSqlQuery("SELECT Score FROM fantresult WHERE Team = '$Op' && Week='$Week'"));
    $All =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantteams WHERE TeamId = '$Team'"));
    $Name =$All['TeamName'];
    $Wins = $All['Wins'];
    $Losses = $All['Losses'];
    $Ties = $All['Ties'];
    $PtsFor = $All['PointsFor'];
    $PtsAgainst = $All['PointsAgainst'];

    echo "Team Score = $TeamScore... vs OP Score is $OpScore";
    if($TeamScore > $OpScore)
    {$Wins++; echo"$Name Wins They have $Wins wins";}
    else if($TeamScore<$OpScore){$Losses++; echo"$Name Loses they have $Losses losses";}
    else {$Ties++; echo"$Name Ties";}

    $WinPer = $Wins / ($Wins+$Losses+$Ties);
    $PtsFor = $PtsFor+$TeamScore;
    $PtsAgainst = $PtsAgainst+$OpScore;

    $insertQuery = "UPDATE fantteams SET Wins='$Wins',Losses=$Losses,Ties=$Ties,WinPercent=$WinPer,PointsFor=$PtsFor,PointsAgainst=$PtsAgainst WHERE TeamId='$Team'";
    ExecuteSqlQuery($insertQuery);
    echo'<br>';

}
$Week++;
$insertQuery = "UPDATE fantweek SET CurrentWeek = $Week";
ExecuteSqlQuery($insertQuery);

if($Week = 7){
    foreach(MysqlFetchData(ExecuteSqlQuery("SELECT LeagueId FROM fantleagues")) as $LeagueId)
    {
        
    }

}
echo "All Done";