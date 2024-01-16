<?php

require_once('MUtils.php');
require_once('MDatabaseConfig.php');

$QueryLogger = [];

//Exits out of php, printing an error
if(!function_exists('SQLError'))
{
	function SQLError($Str, $Query) { print "SQL Error encountered, please contact the administrators with the following information: $Str\n\nTechnical Data:\n$Query"; exit; }
}

global $cgConnectionInfo;

function ConnOpen($Server=NULL, $Username=NULL, $Password=NULL, $Database=NULL)
{
	global $cgConnectionInfo, $link;
	$FieldNames=Array('Server', 'Username', 'Password', 'Database');

	// if not set then set it to an empty array
	if(!isset($cgConnectionInfo))
		$cgConnectionInfo = Array();

	if(is_null($Server) && isset($cgConnectionInfo['Server']))
		$Server = $cgConnectionInfo['Server'];
	if(is_null($Username) && isset($cgConnectionInfo['Username']))
		$Username = $cgConnectionInfo['Username'];
	if(is_null($Password) && isset($cgConnectionInfo['Password']))
		$Password = $cgConnectionInfo['Password'];
	if(is_null($Database) && isset($cgConnectionInfo['Database']))
		$Database = $cgConnectionInfo['Database'];

	//Only open SQL if not already opened
	if(!isset($cgConnectionInfo['OpenCounter']) || $cgConnectionInfo['OpenCounter']==0)
	{
		if(!($cgConnectionInfo['link']=$link=mysqli_connect($Server, $Username, $Password, $Database)))
			die('Connect failed: '.mysqli_connect_error());

		$cgConnectionInfo['OpenCounter']=0;

		//Make sure connection is set as UTF8
		mysqli_query($cgConnectionInfo['link'], "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
		mysqli_query($cgConnectionInfo['link'], "SET CHARACTER SET 'utf8'");
	}

	$cgConnectionInfo['OpenCounter']++; //Keep track of number of opened instances
}

function MysqlClose($ForceClose=false)
{
	global $cgConnectionInfo;
	$cgConnectionInfo['OpenCounter']=($cgConnectionInfo['OpenCounter']-1);

	if($cgConnectionInfo['OpenCounter'])
		return;

	//Close SQL
	mysqli_close($cgConnectionInfo['link']);
	unset($cgConnectionInfo['link']);
}

function ExecuteSqlQuery($Query)
{
	global $cgConnectionInfo, $QueryLogger;

	if(!isset($cgConnection) || !isset($cgConnection['Reference']))
		ConnOpen();

	$Params=array_flatten(array_slice(func_get_args(), 1)); // flatten the array of parameters

	if(isset($cgConnectionInfo['DebugMode']))
	{
			$myfile = fopen("C:\inetpub\wwwroot\logs.txt", "a") or die("Unable to open file!");
			fwrite($myfile, $Query.PHP_EOL);

			fclose($myfile);
	}

	if(!count($Params)) // no additional params. Run the statement
	{
		$result=mysqli_query($cgConnectionInfo['link'], $Query);

		if($result===FALSE)
		{
			SQLError(mysqli_error($cgConnectionInfo['link']), $Query);
		}
	}
	else //Otherwise run a prepared query
	{
		$result=mysqli_prepare($cgConnectionInfo['link'], $Query);
		$DataTypes=GetDataTypes($Params);

		// Prepare an array of all input variables
		array_unshift($Params, $result, $DataTypes);

		call_user_func_array('mysqli_stmt_bind_param', RefValues($Params));

		// Execute the statement
		if(!mysqli_stmt_execute($result) || !mysqli_stmt_store_result($result))
		{
			SQLError(mysqli_error($cgConnectionInfo['link']), $Query);
		}
	}

	return $result;
}

function GetSomeShit($stmt)
{
	return ReadScalar(ExecuteSqlQuery($stmt));
}

function ReadScalar($stmt) {
	if($stmt instanceof mysqli_stmt) //Is a statement
	{
		$ReturnArray = null;
		//Prepare to receive fields
		$Fs=mysqli_stmt_result_metadata($stmt);
		$D=Array();
		$DList=Array($stmt);
		$CopyArray=Array();
		$i=0;

		//Get the fields and pointers to an array containing the fields for the statement to bind to
		while($field=mysqli_fetch_field($Fs))
			$DList[++$i]=&$D[$field->name];
		$NumFields=count($D);
		call_user_func_array('mysqli_stmt_bind_result', $DList);
		if(mysqli_stmt_fetch($stmt)===TRUE) {
			if($NumFields==1)
				$ReturnArray=current($D);
			else
			{
				foreach($D as $K => $V) //We need to duplicate the array to remove the fact that each member is referenced
					$CopyArray[$K]=$V;
				$ReturnArray=$CopyArray;
			}
		}
		mysqli_stmt_close($stmt);
		return $ReturnArray;
	}
	else
	{
		if($stmt===FALSE) //If no result set, return FALSE
			return FALSE;
		else if(($D=mysqli_fetch_assoc($stmt))===NULL) //If we don't have any information, return an empty array
			return null;

		$NumFields=count($D);
		$result=($NumFields==1 ? current($D) : $D);
		mysqli_free_result($stmt);
		return $result;
	}
	return null;
}

function MysqlFetchData($R, $RowNum='')
{
	$ReturnArray=Array();
	if($R instanceof mysqli_stmt) //Is a statement
	{
		//Prepare to receive fields
		$Fs=mysqli_stmt_result_metadata($R);
		$D=Array();
		$DList=Array($R);
		$CopyArray=Array();
		$i=0;

		//Get the fields and pointers to an array containing the fields for the statement to bind to
		while($field=mysqli_fetch_field($Fs))
			$DList[++$i]=&$D[$field->name];
		$NumFields=count($D);
		call_user_func_array('mysqli_stmt_bind_result', $DList);
		while(mysqli_stmt_fetch($R)===TRUE)
			if($NumFields==1)
				$ReturnArray[]=current($D);
			else
			{
				foreach($D as $K => $V) //We need to duplicate the array to remove the fact that each member is referenced
					$CopyArray[$K]=$V;
				$ReturnArray[]=$CopyArray;
			}
		mysqli_stmt_close($R);
	}
	else //Is a result
	{
		if($R===FALSE) //If no result set, return FALSE
			return FALSE;
		else if(($D=mysqli_fetch_assoc($R))===NULL) //If we don't have any information, return an empty array
			return Array();
		$NumFields=count($D);
		do
			$ReturnArray[]=($NumFields==1 ? current($D) : $D);
		while(($D=mysqli_fetch_assoc($R))!==NULL);
		mysqli_free_result($R);
	}
	return $RowNum!=='' ? (array_key_exists($RowNum, $ReturnArray) ? $ReturnArray[$RowNum] : FALSE) : $ReturnArray;
}


/********************************** HELPER FUNCTIONS - NOT TO BE USED PUBLICLY ***********************************/

// Returns a string of MySQL datatypes from array $Data
function GetDataTypes(&$Data)
{
	$DataTypes='';
	foreach($Data as $K => $D)
		if(is_int($D))
			$DataTypes.='i';
		else if(is_double($D))
			$DataTypes.='d';
		else
			$DataTypes.='s';
	return $DataTypes;
}

?>