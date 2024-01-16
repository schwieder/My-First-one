<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LeagueId = $_POST['LeagueId'];
$TeamId = $_POST['TeamId'];
$i = $_POST['i'];
if($i==0){
    $insertQuery = "UPDATE fantdraftstatus SET Ready='Y' WHERE TeamId=$TeamId";
    ExecuteSqlQuery($insertQuery);    
    Echo "You're Back";
    $insertQuery = "UPDATE fantdraft SET LastChecked=CURRENT_TIMESTAMP WHERE LeagueId=$LeagueId";
    ExecuteSqlQuery($insertQuery);
}
else if($i==30){
    $insertQuery = "UPDATE fantdraftstatus SET Ready='A' WHERE TeamId=$TeamId";
    ExecuteSqlQuery($insertQuery);    
    Echo "Sleeping";
    
    $insertQuery = "UPDATE fantdraft SET LastChecked=CURRENT_TIMESTAMP WHERE LeagueId=$LeagueId";
    ExecuteSqlQuery($insertQuery);
}
else if(i==12000){
    $insertQuery = "UPDATE fantdraftstatus SET Ready='N' WHERE TeamId=$TeamId";
    ExecuteSqlQuery($insertQuery);    
    Echo "You have been marked as away - Please refresh the screen and join again.";
    
    $insertQuery = "UPDATE fantdraft SET LastChecked=CURRENT_TIMESTAMP WHERE LeagueId=$LeagueId";
    ExecuteSqlQuery($insertQuery);
}



