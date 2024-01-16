<?php

/***************************** Array functions ****************************************/
function array_flatten($Arr)
{
	$ReturnArray=Array();
	foreach($Arr as $Val)
		if(is_array($Val))
			$ReturnArray=array_merge($ReturnArray,array_flatten($Val));
		else
			$ReturnArray[]=$Val;
	return $ReturnArray;
}

// Turns values in an array to references
function RefValues($Data)
{
	if(strnatcmp(phpversion(),'5.3')>=0) // only supported in newer versions of php
		foreach($Data as $Key => $Value)
			$Data[$Key] = &$Data[$Key];
	return $Data;
}

function isInteger($input){
	return is_int($input) || ctype_digit($input) || filter_var($input, FILTER_VALIDATE_INT);
}

function HasPermission($permission) { return strContains($_SESSION['Permissions'], $permission); }

function strContains($haystack, $needle) {
	if (strpos($haystack, $needle) !== FALSE)
		return true;
	else
		return false;
}

function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}
function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}

?>