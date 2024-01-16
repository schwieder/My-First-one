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



		$Email = $_POST['email'];
		$Password = $_POST['password'];
		$CheckBox = isset($_POST['keep']);

		if(Email_Exists($Email))
		{
			$result1 = ReadScalar(ExecuteSqlQuery("SELECT Password, Id FROM fantasyusers WHERE Email ='$Email'"));


			if(md5($Password) != $result1['Password'])
			{
				$error = "Password is incorrect";
			}
			else
			{				
				$_SESSION['Email'] = $Email;
				$_SESSION['UserId'] = $result1['Id'];
				header("location: profile.php");

			}

		}
		else
		{
			$error = "Email does not exist";
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

				<div id="menu">
					<a href="login.php">Sign Up</a>
					<a href="index.php">Login</a>
				</div>

				<div id="formDiv">

					<form method="POST" action="index.php">


					<label>User Name:</label><br/>
					<input type="text" name="email" value="<?php echo isset($_POST['email'])?$_POST['email']:''; ?>" /><br/>

					<label>Password:</label><br/>
					<input type="password" name="password" /><br/>


					<input type="submit" name="submit" value="Login" />

					</form>
					
					<br/>

				Log in, create a league. Invite friends. Max of 6 in a league bc this year we only have Canada West teams.
				<br><br>
				When you draft, there is a glitch where it doesn't recognize that it's your turn. Just click "Menu" and re-enter/continue the draft.
				<br><br>
				Rosters have to be set by Friday at 3pm mst, players can't be added or dropped during this time either. 
				<br><br>
				Good luck... go Dino's


				</div>

			</div>


		</body>

<html>