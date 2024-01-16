<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LeagueId = $_POST['LeagueId'];
$TeamId = $_POST['TeamId'];

$insertQuery = "UPDATE fantdraftstatus SET Ready='N' WHERE TeamId=$TeamId";
ExecuteSqlQuery($insertQuery);    



