<?php
date_default_timezone_set('America/Edmonton');


$LId = $_REQUEST['LId'];
$LD = $_REQUEST['LastDrafted'];
$DY = $_REQUEST['DraftYear'];


if(!isset($_REQUEST['LId']))
	die(json_encode(['error_msg'=>'LId not provided']));
if(!isset($_REQUEST['DraftYear']))
	die(json_encode(['error_msg'=>'DraftYear not provided']));
if(!isset($_REQUEST['LastDrafted']))
	die(json_encode(['error_msg'=>'LastDrafted not provided']));



include('Sql.php');
  $result = ['success'=>true, 'changed_cells'=>[], 'LastDrafted'=>$_REQUEST['LastDrafted']];
  $Curr =  ReadScalar(ExecuteSqlQuery("SELECT Current FROM fantdraft WHERE LeagueId = '$LId' AND Yr = '$DY'"));
	$result['LastDrafted'] = $Curr;

echo json_encode($result);

?>
