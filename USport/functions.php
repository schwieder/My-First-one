<?php

require_once("Sql.php");


function Email_Exists($Email)
{
	$result =  ReadScalar(ExecuteSqlQuery("SELECT Id FROM fantasyusers WHERE email = '$Email'"));
		
	if($result !=null)
	{
		return true;
	}
	Else
	{
		$error = "- no email... check function";
		return false;		
	}
	
}
	
function logged_in()
{
if (isset($_SESSION['Email'])   || isset($_COOKIE['Email']) )
		{
			return true;
			
		}
		else
		{
			return false;
		}
}

function League_Exists($LeagueName)
{
	$UserId = $_SESSION['UserId'];
	$result =  ReadScalar(ExecuteSqlQuery("SELECT count(*) FROM fantleagues WHERE (CommishId = '$UserId') AND (LeagueName = '$LeagueName');"));
	if($result == "0")
	{
		return false;		
	}
	else
	{
		return true;
	}

}


?>