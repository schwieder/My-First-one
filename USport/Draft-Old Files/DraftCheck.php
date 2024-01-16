<?php
date_default_timezone_set('America/Edmonton');
include('Sql.php');


$LeagueId = $_REQUEST['LeagueId'];
$TeamId = $_REQUEST['TeamId'];
$LastChanged = $_REQUEST['LastChanged'];


if(!isset($_REQUEST['LeagueId']))
	die(json_encode(['error_msg'=>'LeagueId not provided']));
if(!isset($_REQUEST['TeamId']))
	die(json_encode(['error_msg'=>'TeamId not provided']));
if(!isset($_REQUEST['LastChanged']))
	die(json_encode(['error_msg'=>'LastChanged not provided']));





$result = ['success'=>true, 'changed_cells'=>[], 'LastChanged'=>$_REQUEST['LastChanged']];
$Curr =  ReadScalar(ExecuteSqlQuery("SELECT LastChecked FROM fantdraft WHERE LeagueId = '$LeagueId'"));
$result['LastChanged'] = $Curr;
  
echo json_encode($result);
  
  


///////////////////////////////////////////////////////

?>