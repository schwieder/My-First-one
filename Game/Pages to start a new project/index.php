<?php

		// this is Maths login

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

		$User = $_POST['User'];
		$Password = $_POST['password'];

		if(Email_Exists($User))
		{
			$result1 = ReadScalar(ExecuteSqlQuery("SELECT * FROM stockusers WHERE Username ='$User'"));

			if($Password != $result1['Password'])
			{
				$error = "Password is incorrect";
			}
			else
			{				
				$_SESSION['User'] = $User;
				$_SESSION['UserId'] = $result1['Id'];
				$_SESSION['Role'] = $result1['Role'];
				$_SESSION['First'] = $result1['First'];
				$_SESSION['Last'] = $result1['Last'];
				$_SESSION['Money'] = $result1['Money'];
				$_SESSION['Grade'] = $result1['Grade'];
				header("location: profile.php");

			}

		}
		else
		{
			$error = "Username does not exist";
		}


	}		


	?>


<!doctype.html>


<html>


		<head>

			<title>Login Page</title>
			<link rel="stylesheet" href="css/styles.css" />

		</head>

		<body>

			<div id="error" style=" <?php if($error !="") { ?> display:block; <?php } ?> "><?php echo $error ?></div>

			<div id="wrapper">
				Colin is the best!

				<div id="formDiv">

					<form method="POST" action="index.php">


					<label>User Name:</label><br/>
					<input type="text" name="User" value="<?php echo isset($_POST['User'])?$_POST['User']:''; ?>" /><br/>

					<label>Password:</label><br/>
					<input type="password" name="password" /><br/>


					<input type="submit" name="submit" value="Login" />

					</form>
					
					<br/>

					<form method="POST" action="forget.php">
					Forget your password?
					Ask your teacher
					<?php
					//<input type="submit" name="forget" value="Forgotten Password" />
					?>
					</form>
					
				</div>

			</div>


		</body>

<html>