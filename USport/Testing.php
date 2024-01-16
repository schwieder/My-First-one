<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId'];
$LId = 8;
$DraftYear = 2022;
$TeamId = 13;

$DraftOrder = [];
$row =  ReadScalar(ExecuteSqlQuery("SELECT * FROM fantdraft WHERE LeagueId = '$LId' AND Yr = '$DraftYear'"));
$DraftOrder=[$row['Team1'],$row['Team2'],$row['Team3'],$row['Team4'],$row['Team5'],$row['Team6'],$row['Team7'],$row['Team8'],$row['Team9'],$row['Team10'],$row['Team11'],$row['Team12']];

$NextDraftPlace = array_search(NULL, $DraftOrder); // $key = 2;

if($NextDraftPlace>11)
{
    echo "there are too many teams in your league";
    die;
}
else
{
    $Slot = "Team$NextDraftPlace";

}

$insertQuery = "UPDATE fantdraft SET $Slot=? WHERE LeagueId=$LId AND Yr=$DraftYear";
ExecuteSqlQuery($insertQuery, $TeamId);
