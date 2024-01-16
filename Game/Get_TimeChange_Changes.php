<?php

if(!isset($_REQUEST['LowId']))
	die(json_encode(['error_msg'=>'LowId not provided']));
if(!isset($_REQUEST['HighId']))
	die(json_encode(['error_msg'=>'HighId not provided']));
if(!isset($_REQUEST['Timestamp']))
	die(json_encode(['error_msg'=>'Timestamp not provided']));

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'init.php');


$LowId = $_REQUEST['LowId'];
$HighId = $_REQUEST['HighId'];
$TimeSent = $_REQUEST['Timestamp'];
$ActualLastUpdate = "Game" . $LowId . "vs" . $HighId. 'Update';

if($TimeSent != $$ActualLastUpdate)
{
    $result = ['success'=>true];
}

echo json_encode($result);

?>
