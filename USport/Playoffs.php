<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");
require __DIR__. '/vendor/autoload.php';

$UserId = $_SESSION['UserId'];
//$LeagueId = $_SESSION['LeagueId'];
$Week = ReadScalar(ExecuteSqlQuery("SELECT CurrentWeek FROM fantweek"));

If($UserId != 2){die;}
If($Week != 7){die;}

//update scores for each team
foreach(MysqlFetchData(ExecuteSqlQuery("SELECT DISTINCT LeagueId FROM fantteams")) as $LeagueId)
{
    foreach(MysqlFetchData(ExecuteSqlQuery("SELECT count(*) FROM fantteams WHERE LeagueId = '$LeagueId'")) as $count)
    {
        $ranking = array();
        foreach(MysqlFetchData(ExecuteSqlQuery("SELECT TeamId FROM fantteams WHERE LeagueId = '$LeagueId' ORDER BY Wins DESC, Ties DESC, PointsFor DESC")) as $row)
        {
            array_push($ranking, $row);
        }
        print_r($ranking);
        if($count == 2)
        {
            $Team1 = $ranking[0];
            $Team2 = $ranking[1];
            $insertQuery = "UPDATE fantschedule SET PlayoffWk1Opp=? WHERE TeamId=?";
            ExecuteSqlQuery($insertQuery, $Team2,$Team1);
            $insertQuery = "UPDATE fantschedule SET PlayoffWk1Opp=? WHERE TeamId=?";
            ExecuteSqlQuery($insertQuery, $Team1,$Team2);        
        }
    
        if($count == 3)
        {
            $Team1 = $ranking[0];
            $Team2 = $ranking[1];
            $insertQuery = "UPDATE fantschedule SET PlayoffWk1Opp=? WHERE TeamId=?";
            ExecuteSqlQuery($insertQuery, $Team2,$Team1);
            $insertQuery = "UPDATE fantschedule SET PlayoffWk1Opp=? WHERE TeamId=?";
            ExecuteSqlQuery($insertQuery, $Team1,$Team2);        
        }
        if($count > 3)
        {
            $Team1 = $ranking[0];
            $Team2 = $ranking[1];
            $Team3 = $ranking[2];
            $Team4 = $ranking[3];
            $insertQuery = "UPDATE fantschedule SET PlayoffWk1Opp=? WHERE TeamId=?";
            ExecuteSqlQuery($insertQuery, $Team4,$Team1);
            $insertQuery = "UPDATE fantschedule SET PlayoffWk1Opp=? WHERE TeamId=?";
            ExecuteSqlQuery($insertQuery, $Team3,$Team2);
            $insertQuery = "UPDATE fantschedule SET PlayoffWk1Opp=? WHERE TeamId=?";
            ExecuteSqlQuery($insertQuery, $Team2,$Team3);
            $insertQuery = "UPDATE fantschedule SET PlayoffWk1Opp=? WHERE TeamId=?";
            ExecuteSqlQuery($insertQuery, $Team1,$Team4);
        }
    }
}
