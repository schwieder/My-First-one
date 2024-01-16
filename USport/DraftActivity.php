<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LeagueId = $_POST['LeagueId'];
$TeamId = $_POST['TeamId'];

echo "Refresh to see if Status' have changed";
echo "<br><br>";

foreach(MysqlFetchData(ExecuteSqlQuery("SELECT * FROM fantteams WHERE LeagueId = '$LeagueId'")) as $row)
{
    $TeamName = $row['TeamName'];
    $Ready = ReadScalar(ExecuteSqlQuery("SELECT Ready FROM fantdraftstatus WHERE TeamId =".$row['TeamId'].""));
    if($Ready == 'Y'){$Status = "Ready";}
    else if ($Ready == 'N'){$Status = "Not Online";}
    else if ($Ready == 'A'){$Status = "Away";}
    echo "$TeamName are $Status &nbsp";
    echo "<br>";
}

