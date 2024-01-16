<?php

date_default_timezone_set('America/Edmonton');
require_once("Sql.php");
require_once("functions.php");

$UserId = $_SESSION['UserId']; 
$LeagueId = $_POST['LeagueId'];

$Curr = ReadScalar(ExecuteSqlQuery("SELECT Team1 FROM fantdraft WHERE LeagueId =$LeagueId"));

$insertQuery = "UPDATE fantdraft SET Round='1', Current=$Curr, LastChecked=CURRENT_TIMESTAMP WHERE LeagueId=$LeagueId";
ExecuteSqlQuery($insertQuery);

