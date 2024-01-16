<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$DraftYear = 2022;
$UserId = $_SESSION['UserId'];
$LeagueName = $_POST['LeagueName'];
if (!trim($LeagueName ?? '')) {
    echo "There was no League Name, please try again.";
    die;
}
$TeamName = $_POST['TeamName'];
if (!trim($TeamName ?? '')) {
    echo "There was no Team Name, please try again.";
    die;
}
$TeamNo = $_POST['TeamNo'];
if ($TeamNo < 2) {
    echo "You need more than 1 team to be in the league.";
    die;
}
if ($TeamNo > 6) {
    echo "You can only have 6 teams in the league.";
    die;
}
$PassYds= $_POST['PassYds'];
$PassTds= $_POST['PassTds'];
$PassInts= $_POST['PassInts'];
$RushYds= $_POST['RushYds'];
$RushTds= $_POST['RushTds'];
$RecYds= $_POST['RecYds'];
$RecTds= $_POST['RecTds'];
$KORYds= $_POST['KORYds'];
$KORTds= $_POST['KORTds'];
$PRYds= $_POST['PRYds'];
$PRTds= $_POST['PRTds'];
$Fum= $_POST['Fum'];
$FumLost= $_POST['FumLost'];

$start_date = "2022-08-27T00:00";
$end_date = "2022-08-31T00:00";
$min = strtotime($start_date);
$max = strtotime($end_date);
// Generate random number using above bounds
$val = rand($min, $max);
// Convert back to desired date format
$rand1 = date('Y-m-d', $val);
$rand2 = date('H:i:s', $val);
$DraftTime = $rand1.'T'.$rand2;

if(League_Exists($LeagueName))
{
    echo "You already have a league by this name, please choose another name or delete the other one";
}
else
{
    $insertQuery = "INSERT INTO fantleagues SET CommishId=?, LeagueName=?, PassYds=?,PassTds=?,PassInts=?,RushYds=?,RushTds=?,RecYds=?,RecTds=?,KORYds=?,KORTds=?,PRYds=?,PRTds=?,Fum=?,FumLost=?,DraftTime=?,MaxTeams=?";
    ExecuteSqlQuery($insertQuery, $UserId, $LeagueName, $PassYds, $PassTds, $PassInts, $RushYds, $RushTds, $RecYds, $RecTds, $KORYds, $KORTds, $PRYds, $PRTds, $Fum, $FumLost, $DraftTime,$TeamNo); 
    sleep(1);
    $LeagueId = ReadScalar(ExecuteSqlQuery("SELECT LeagueId FROM fantleagues WHERE LeagueName ='$LeagueName' && commishId = '$UserId'"));
    $insertQuery = "INSERT INTO fantteams SET LeagueId=?, TeamName=?, OwnerId=?";
    ExecuteSqlQuery($insertQuery, $LeagueId, $TeamName, $UserId);
    $insertQuery = "INSERT INTO rosterchosen SET LeagueId=?, TeamId=?, PlayerId=?";
    ExecuteSqlQuery($insertQuery, $LeagueId, '0', '0');
    sleep(1);
    $TeamId = ReadScalar(ExecuteSqlQuery("SELECT TeamId FROM fantteams WHERE LeagueId ='$LeagueId' && OwnerId = '$UserId'"));
    $insertQuery = "INSERT INTO fantteamsstarters SET LeagueId=?, TeamId=?, OwnerId=?";
    ExecuteSqlQuery($insertQuery, $LeagueId, $TeamId, $UserId);
    $insertQuery = "INSERT INTO fantschedule SET LeagueId=?, TeamId=?";
    ExecuteSqlQuery($insertQuery, $LeagueId, $TeamId);

    $insertQuery = "INSERT INTO fantdraftstatus SET TeamId=?";
    ExecuteSqlQuery($insertQuery, $TeamId);

    $i = 0;
    while($i<8)
    {
        $i++;
        $insertQuery = "INSERT INTO fantresult SET Week=?, Team=?";
        ExecuteSqlQuery($insertQuery, $i, $TeamId);
    }
    
    $insertQuery = "INSERT INTO fantdraft SET LeagueId=$LeagueId, Yr=$DraftYear, Team1=$TeamId";
    ExecuteSqlQuery($insertQuery);
    echo "You are now the proud Commish of the $LeagueName League, and will control $TeamName";

}

?>

<script type="text/javascript">
	$(document).ready(function(){
        $("#Refresh").show();
	});

</script>
