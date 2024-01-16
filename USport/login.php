<?php

	
	date_default_timezone_set('America/Edmonton');
	require_once("Sql.php");
	require_once("functions.php");
	
	
	if (logged_in())
	{
		header("location:profile.php");
		exit();
	}
	
	
	$error = ""; 

	if(isset($_POST['submit']))
	{
		$Name = $_POST['fname'];
		$Email = $_POST['Email'];
		$Password = $_POST['password'];
		$PasswordConfirm = $_POST['passwordconfirm'];
		
		
		if(strlen($Name) < 1)
		{
			$error = "Name is too short";
		}
/*
		else if(!filter_var($Email, FILTER_VALIDATE_EMAIL))
		{
			$error = "Please enter valid Email address";
		}
*/
		else if(Email_Exists($Email))
		{
			$error = "Someone is already registered with this user name";
		}
		
		else if (strlen($Password) < 4 )
		{
			$error = "Password must be longer than 4 characters";
		}
		
		else if ($Password !== $PasswordConfirm)
		{
			$error = "Password does not match";
		}
		else
		{
			
			$Password = md5($Password);
		
		
			$insertQuery = "INSERT INTO fantasyusers(Name,Email,Password) VALUES (?,?,?)";
			if(ExecuteSqlQuery($insertQuery, $Name,$Email,$Password))
			{
			$error = "Nice work";
			}
			else
			{
				$error = "Please Try Agian";
			}
		}
	}		


	?>


<!doctype.html>


<html>


		<head>
			
			<title>Registration Page</title>
			<link rel="stylesheet" href="css/styles.css" />
			
		</head>
		
		<body>
		
			<div id="error" style=" <?php if($error !="") { ?> display:block; <?php } ?> "><?php echo $error ?></div>
		
			
				
				<div id="menu">
					<a href="login.php">Sign Up</a>
					<a href="index.php">Login</a>
				</div>
			<div id="wrapper">
				<div id="formDiv">
			
					<form method="POST" action="login.php" enctype="multipart/form=data">
					
					<label>Name:</label><br/>
					<input type="text" id="fname" name="fname" style="width:150px;" value="<?php echo isset($_POST['fname'])?$_POST['fname']:''; ?>" class="inputFields" required/><br/>
					
					
					<label>UserName:</label><br/>
					<input type="text" name="Email" style="width:150px;" value="<?php echo isset($_POST['Email'])?$_POST['Email']:''; ?>" class="inputFields" required/><br/>
					
					<label>Password:</label><br/>
					<input type="password" name="password" style="width:150px;" class="inputFields" required/><br/>
					
					<label>Re-enter Password:</label><br/>
					<input type="password" name="passwordconfirm" style="width:150px;" class="inputFields" required/><br/>
					
					<br/>
					
					<input type="submit" class="theButtons" name="submit" />
				
					</form>
				
				</div>
			
			</div>
			
			
		</body>
		
<html>