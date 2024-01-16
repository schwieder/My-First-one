<?php

require_once("Sql.php");


function Email_Exists($Email)
{
	$result =  ReadScalar(ExecuteSqlQuery("SELECT Id FROM Musers WHERE Email = '$Email'"));
		
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



?>