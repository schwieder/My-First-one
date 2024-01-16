<?php

	
	date_default_timezone_set('America/Edmonton');
	require_once("MSql.php");
	require_once("Mfunctions.php");
	
	
	if (logged_in())
	{
		header("location:Mprofile.php");
		exit();
	}
	
	
	$error = ""; 

	if(isset($_POST['submit']))
	{
		$Name = $_POST['fname'];
		$Email = $_POST['Email'];
		$Password = $_POST['password'];
		$PasswordConfirm = $_POST['passwordconfirm'];
		$TeacherStudent = $_POST['TS'];
		
		
		if(strlen($Name) < 2)
		{
			$error = "Name is too short";
		}
	
		
		else if(!filter_var($Email, FILTER_VALIDATE_EMAIL))
		{
			$error = "Please enter valid Email address";
		}
		
		else if(Email_Exists($Email))
		{
			$error = "Someone is already registered with this email";
		}
		
		else if (strlen($Password) < 4 )
		{
			$error = "Password must be longer than 4 characters";
		}
		
		else if ($Password !== $PasswordConfirm)
		{
			$error = "Password does not match";
		}

//		<input type="checkbox" name="conditions" required/>
//		<label>You must check this box</label><br/>
//		else if (!$conditions)
//		{
//			$error = "you must check the box";
//		}
		else
		{
			
			$Password = md5($Password);
		
		
			$insertQuery = "INSERT INTO musers(Name,Email,Password,TeacherStudent) VALUES (?,?,?,?)";
			if(ExecuteSqlQuery($insertQuery, $Name,$Email,$Password, $TeacherStudent))

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
					<a href="Mlogin.php">Teacher Sign Up</a>
					<a href="Mindex.php">Login</a>
				</div>
			<div id="wrapper">
				Colin is the best! 

				
				<div id="formDiv">
			
					<form method="POST" action="Mlogin.php" enctype="multipart/form=data">
					
					<label>Name:</label><br/>
					<input type="text" id="fname" name="fname" value="<?php echo isset($_POST['fname'])?$_POST['fname']:''; ?>" class="inputFields" required/><br/>
					
					
					<label>Email:</label><br/>
					<input type="text" name="Email" value="<?php echo isset($_POST['Email'])?$_POST['Email']:''; ?>" class="inputFields" required/><br/>
					
					<label>Password:</label><br/>
					<input type="password" name="password" class="inputFields" required/><br/>
					
					<label>Re-enter Password:</label><br/>
					<input type="password" name="passwordconfirm" class="inputFields" required/><br/>
					
					<label>Student or Teacher:</label><br/>
					<select name="TS">
					<option value="S">Student</option>
					<option value="T">Teacher</option>
					</select>					<br/>
					<br/>
					
					<input type="submit" class="theButtons" name="submit" />
				
					</form>
				
				</div>
			
			</div>
			
			
		</body>
		
<html>