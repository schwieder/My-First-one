<?php

if(!isset($_REQUEST['LowId']))
	die(json_encode(['error_msg'=>'LowId not provided']));
if(!isset($_REQUEST['HighId']))
	die(json_encode(['error_msg'=>'HighId not provided']));

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'init.php');


$LowId = $_REQUEST['LowId'];
$HighId = $_REQUEST['HighId'];
$LowIdReady = "Game" . $LowId . "vs" . $HighId. $LowId. 'Ready';
$HighIdReady = "Game" . $LowId . "vs" . $HighId. $HighId. 'Ready';
$LowReady = $$LowIdReady;
$HighReady = $$HighIdReady;


if($LowReady == "Ready" && $HighReady == "Ready")
{
    $result = ['success'=>true];
}

echo json_encode($result);

?>
