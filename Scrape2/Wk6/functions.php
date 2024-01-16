<?php

require_once("Sql.php");


function Email_Exists($User)
{
	$result =  ReadScalar(ExecuteSqlQuery("SELECT Id FROM users WHERE Username = '$User'"));
		
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

function League_Exists($LeagueName)
{
	$UserId = $_SESSION['UserId'];
	$result =  ReadScalar(ExecuteSqlQuery("SELECT leagueId FROM hkyleagues WHERE LeagueName = '$LeagueName' && commishId = '$UserId'"));

	if($result !=null)
	{
		return true;
	}
	Else
	{
		echo "You already have a league by this name, please choose another name or delete the other one";
		return false;		
	}
	
}

function Stock_Exists($StockId)
{
	$result =  ReadScalar(ExecuteSqlQuery("SELECT Amount FROM trades WHERE CompanyId = '$StockId'"));

	if($result !=null)
	{
		return true;
	}
	Else
	{
		return false;		
	}
	
}

	
	
function logged_in()
{
if (isset($_SESSION['User'])   || isset($_COOKIE['User']) )
		{
			return true;
			
		}
		else
		{
			return false;
		}
}



?>