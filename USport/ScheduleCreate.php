<?php
date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LId = $_POST['LeagueId'];

//$row =  ReadScalar(ExecuteSqlQuery("SELECT Week1Opp FROM fantschedule WHERE LeagueId = '$LId'"));
//if(isset($row['Week1Opp'])){die;}

$Count =  ReadScalar(ExecuteSqlQuery("SELECT count(*) FROM fantteams WHERE LeagueId = '$LId'"));

$teamsId = [];
    
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM fantteams WHERE LeagueId = '$LId'")) as $Id)
{
    array_push($teamsId,$Id['TeamId']);
}

if($Count == 2)
{
    shuffle($teamsId);
    $Team1 = $teamsId[0]; 
    $Team2 = $teamsId[1]; 
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?, Week3Opp=?, Week4Opp=?, Week5Opp=?, Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team2,$Team2,$Team2,$Team2,$Team2,$Team2,$Team1);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?, Week3Opp=?, Week4Opp=?, Week5Opp=?, Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team1,$Team1,$Team1,$Team1,$Team1,$Team1,$Team2);
}
else if($Count == 3)
{
    shuffle($teamsId);
    $Team1 = $teamsId[0];
    $Team2 = $teamsId[1];
    $Team3 = $teamsId[2];
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team2,$Team3,"bye",$Team3,$Team2,"bye",$Team1);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?,Week2Opp=?, Week3Opp=?, Week4Opp=?, Week5Opp=?, Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team1,"bye",$Team3,"bye",$Team1,$Team3,$Team2);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?,Week2Opp=?, Week3Opp=?, Week4Opp=?, Week5Opp=?, Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, "bye",$Team1,$Team2,$Team1,$Team2,"bye",$Team3);
}
else if($Count == 4)
{
    shuffle($teamsId);
    $Team1 = $teamsId[0];
    $Team2 = $teamsId[1];
    $Team3 = $teamsId[2];
    $Team4 = $teamsId[3];
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team2,$Team3,$Team4,$Team2,$Team3,$Team4,$Team1);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?,Week2Opp=?, Week3Opp=?, Week4Opp=?, Week5Opp=?, Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team1,$Team4,$Team3,$Team1,$Team4,$Team3,$Team2);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?,Week2Opp=?, Week3Opp=?, Week4Opp=?, Week5Opp=?, Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team4,$Team1,$Team2,$Team4,$Team1,$Team2,$Team3);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?,Week2Opp=?, Week3Opp=?, Week4Opp=?, Week5Opp=?, Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team3,$Team2,$Team1,$Team1,$Team2,$Team1,$Team4);
}
else if($Count == 5)
{
    shuffle($teamsId);
    $Team1 = $teamsId[0];
    $Team2 = $teamsId[1];
    $Team3 = $teamsId[2];
    $Team4 = $teamsId[3];
    $Team5 = $teamsId[4];
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team4,$Team3,$Team2,"bye",$Team5,$Team4,$Team1);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?,Week2Opp=?, Week3Opp=?, Week4Opp=?, Week5Opp=?, Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team2,"bye",$Team1,$Team5,$Team4,$Team3,$Team2);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?,Week2Opp=?, Week3Opp=?, Week4Opp=?, Week5Opp=?, Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team3,$Team1,$Team5,$Team4,"bye",$Team2,$Team3);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?,Week2Opp=?, Week3Opp=?, Week4Opp=?, Week5Opp=?, Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team1,$Team5,"bye",$Team3,$Team2,$Team1,$Team4);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?,Week2Opp=?, Week3Opp=?, Week4Opp=?, Week5Opp=?, Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, "bye",$Team4,$Team3,$Team2,$Team1,"bye",$Team5);
}
else if($Count == 6)
{
    shuffle($teamsId);
    $Team1 = $teamsId[0];
    $Team2 = $teamsId[1];
    $Team3 = $teamsId[2];
    $Team4 = $teamsId[3];
    $Team5 = $teamsId[4];
    $Team6 = $teamsId[5];
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team2,$Team6,$Team5,$Team4,$Team3,$Team2,$Team1);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team1,$Team5,$Team3,$Team6,$Team4,$Team1,$Team2);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team6,$Team4,$Team2,$Team5,$Team1,$Team6,$Team3);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team5,$Team3,$Team6,$Team1,$Team2,$Team5,$Team4);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team4,$Team2,$Team1,$Team3,$Team6,$Team4,$Team5);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team3,$Team1,$Team4,$Team2,$Team5,$Team3,$Team6);
}
else if($Count == 7)
{
    shuffle($teamsId);
    $Team1 = $teamsId[0];
    $Team2 = $teamsId[1];
    $Team3 = $teamsId[2];
    $Team4 = $teamsId[3];
    $Team5 = $teamsId[4];
    $Team6 = $teamsId[5];
    $Team7 = $teamsId[6];
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team6,$Team5,"bye",$Team7,$Team3,$Team2,$Team1);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team5,$Team4,$Team7,$Team6,"bye",$Team1,$Team2);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team4,"bye",$Team6,$Team5,$Team1,$Team7,$Team3);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team3,$Team2,$Team5,"bye",$Team7,$Team6,$Team4);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team2,$Team1,$Team4,$Team3,$Team6,"bye",$Team5);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team1,$Team7,$Team3,$Team2,$Team5,$Team4,$Team6);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, "bye",$Team6,$Team2,$Team1,$Team4,$Team3,$Team7);
}
else if($Count == 8)
{
    shuffle($teamsId);
    $Team1 = $teamsId[0];
    $Team2 = $teamsId[1];
    $Team3 = $teamsId[2];
    $Team4 = $teamsId[3];
    $Team5 = $teamsId[4];
    $Team6 = $teamsId[5];
    $Team7 = $teamsId[6];
    $Team8 = $teamsId[7];
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team2,$Team7,$Team4,$Team6,$Team3,$Team8,$Team1);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team1,$Team5,$Team6,$Team3,$Team4,$Team7,$Team2);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team8,$Team4,$Team5,$Team2,$Team1,$Team6,$Team3);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team7,$Team3,$Team1,$Team8,$Team2,$Team5,$Team4);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team6,$Team2,$Team3,$Team7,$Team8,$Team4,$Team5);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team5,$Team8,$Team2,$Team1,$Team7,$Team3,$Team6);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team4,$Team1,$Team8,$Team5,$Team6,$Team2,$Team7);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team3,$Team6,$Team7,$Team4,$Team5,$Team1,$Team8);
}
else if($Count == 9)
{
    shuffle($teamsId);
    $Team1 = $teamsId[0];
    $Team2 = $teamsId[1];
    $Team3 = $teamsId[2];
    $Team4 = $teamsId[3];
    $Team5 = $teamsId[4];
    $Team6 = $teamsId[5];
    $Team7 = $teamsId[6];
    $Team8 = $teamsId[7];
    $Team9 = $teamsId[8];
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team8,$Team7,"bye",$Team9,$Team3,$Team2,$Team1);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team7,$Team6,$Team9,$Team8,"bye",$Team1,$Team2);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team6,$Team5,$Team8,$Team7,$Team1,$Team9,$Team3);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team5,"bye",$Team7,$Team6,$Team9,$Team8,$Team4);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team4,$Team3,$Team6,"bye",$Team7,$Team7,$Team5);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team3,$Team2,$Team5,$Team4,$Team7,"bye",$Team6);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=4, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team2,$Team1,$Team4,$Team3,$Team6,$Team5,$Team7);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team1,$Team9,$Team3,$Team2,$Team5,$Team4,$Team8);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, "bye",$Team8,$Team2,$Team1,$Team4,$Team3,$Team9);
}
else if($Count == 10)
{
    shuffle($teamsId);
    $Team1 = $teamsId[0];
    $Team2 = $teamsId[1];
    $Team3 = $teamsId[2];
    $Team4 = $teamsId[3];
    $Team5 = $teamsId[4];
    $Team6 = $teamsId[5];
    $Team7 = $teamsId[6];
    $Team8 = $teamsId[7];
    $Team9 = $teamsId[8];
    $Team10 = $teamsId[9];
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team2,$Team7,$Team3,$Team8,$Team4,$Team9,$Team1);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team1,$Team3,$Team4,$Team5,$Team6,$Team7,$Team2);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team10,$Team2,$Team1,$Team4,$Team5,$Team6,$Team3);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team9,$Team10,$Team2,$Team3,$Team1,$Team5,$Team4);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team8,$Team9,$Team10,$Team2,$Team3,$Team4,$Team5);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team7,$Team8,$Team9,$Team10,$Team2,$Team3,$Team6);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team6,$Team1,$Team8,$Team9,$Team10,$Team2,$Team7);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team5,$Team6,$Team7,$Team1,$Team9,$Team10,$Team8);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team4,$Team5,$Team6,$Team7,$Team8,$Team1,$Team9);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team3,$Team4,$Team5,$Team6,$Team7,$Team8,$Team10);
}
else if($Count == 11)
{
    shuffle($teamsId);
    $Team1 = $teamsId[0];
    $Team2 = $teamsId[1];
    $Team3 = $teamsId[2];
    $Team4 = $teamsId[3];
    $Team5 = $teamsId[4];
    $Team6 = $teamsId[5];
    $Team7 = $teamsId[6];
    $Team8 = $teamsId[7];
    $Team9 = $teamsId[8];
    $Team10 = $teamsId[9];
    $Team11 = $teamsId[10];
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team10,$Team9,"bye",$Team11,$Team3,$Team2,$Team1);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team9,$Team8,$Team11,$Team10,"bye",$Team1,$Team2);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team8,$Team7,$Team10,$Team9,$Team1,$Team11,$Team3);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team7,$Team6,$Team9,$Team8,$Team11,$Team10,$Team4);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team6,"bye",$Team8,$Team7,$Team10,$Team9,$Team5);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team5,$Team4,$Team7,"bye",$Team9,$Team8,$Team6);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team4,$Team3,$Team6,$Team5,$Team8,"bye",$Team7);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team3,$Team2,$Team5,$Team4,$Team7,$Team6,$Team8);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team2,$Team1,$Team4,$Team3,$Team6,$Team5,$Team9);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team1,$Team11,$Team3,$Team2,$Team5,$Team4,$Team10);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, "bye",$Team10,$Team2,$Team1,$Team4,$Team3,$Team11);
}
else if($Count == 12)
{
    shuffle($teamsId);
    $Team1 = $teamsId[0];
    $Team2 = $teamsId[1];
    $Team3 = $teamsId[2];
    $Team4 = $teamsId[3];
    $Team5 = $teamsId[4];
    $Team6 = $teamsId[5];
    $Team7 = $teamsId[6];
    $Team8 = $teamsId[7];
    $Team9 = $teamsId[8];
    $Team10 = $teamsId[9];
    $Team11 = $teamsId[10];
    $Team12 = $teamsId[11];
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team2,$Team7,$Team12,$Team5,$Team10,$Team3,$Team1);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team1,$Team12,$Team11,$Team8,$Team7,$Team4,$Team2);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team12,$Team3,$Team10,$Team7,$Team6,$Team1,$Team3);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team11,$Team10,$Team9,$Team6,$Team5,$Team2,$Team4);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team10,$Team9,$Team8,$Team1,$Team4,$Team12,$Team5);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team9,$Team8,$Team7,$Team4,$Team3,$Team11,$Team6);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team8,$Team1,$Team6,$Team3,$Team2,$Team10,$Team7);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team7,$Team6,$Team5,$Team2,$Team12,$Team9,$Team8);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team6,$Team5,$Team4,$Team12,$Team11,$Team8,$Team9);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team5,$Team4,$Team3,$Team11,$Team1,$Team7,$Team10);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team4,$Team3,$Team2,$Team10,$Team9,$Team6,$Team11);
    $insertQuery = "UPDATE fantschedule SET Week1Opp=?, Week2Opp=?,Week3Opp=?, Week4Opp=?, Week5Opp=?,Week6Opp=? WHERE TeamId=?";
    ExecuteSqlQuery($insertQuery, $Team3,$Team2,$Team11,$Team9,$Team8,$Team5,$Team12);
}
