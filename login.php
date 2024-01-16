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
		$FName = $_POST['Fname'];
		$LName = $_POST['Lname'];
		$Email = $_POST['user'];
		$Password = $_POST['password'];
		$PasswordConfirm = $_POST['passwordconfirm'];
		
		
		if(Email_Exists($Email))
		{
			$error = "Someone is already registered with this UserName";
		}
		
		else if (strlen($Password) < 0 )
		{
			$error = "Password must be longer than no characters";
		}
		
		else if ($Password !== $PasswordConfirm)
		{
			$error = "Password does not match";
		}

		else
		{
		
			$insertQuery = "INSERT INTO users(First, Last, Username,Password) VALUES (?,?,?,?)";
			if(ExecuteSqlQuery($insertQuery, $FName, $LName, $Email, $Password))
			{
			$error = "Nice work";
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
					<a href="login.php">Teacher Sign Up</a>
					<a href="index.php">Login</a>
				</div>
			<div id="wrapper">
				Colin is the best! 

				
				<div id="formDiv">
			
					<form method="POST" action="login.php" enctype="multipart/form=data">
					
					<label>First Name:</label><br/>
					<input type="text" id="Fname" name="Fname" value="<?php echo isset($_POST['Fname'])?$_POST['Fname']:''; ?>" class="inputFields" required/><br/>
					<label>Last Name:</label><br/>
					<input type="text" id="Lname" name="Lname" value="<?php echo isset($_POST['Lname'])?$_POST['Lname']:''; ?>" class="inputFields" required/><br/>
					
					
					<label>UserName:</label><br/>
					<input type="text" name="user" value="<?php echo isset($_POST['user'])?$_POST['user']:''; ?>" class="inputFields" required/><br/>
					
					<label>Password:</label><br/>
					<input type="password" name="password" class="inputFields" required/><br/>
					
					<label>Re-enter Password:</label><br/>
					<input type="password" name="passwordconfirm" class="inputFields" required/><br/>
					
					<br/>
					<input type="submit" class="theButtons" name="submit" />
				
					</form>
				
				</div>
			
			</div>
			
			
		</body>
		
<html>