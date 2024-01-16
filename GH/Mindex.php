<?php

		// this is Maths login

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



		$Email = $_POST['email'];
		$Password = $_POST['password'];
		$CheckBox = isset($_POST['keep']);

		if(Email_Exists($Email))
		{
			$result1 = ReadScalar(ExecuteSqlQuery("SELECT Password, TeacherStudent FROM musers WHERE Email ='$Email'"));


			if(md5($Password) != $result1['Password'])
			{
				$error = "Password is incorrect";
			}
			else
			{				
				$_SESSION['Email'] = $Email;
		//		$_SESSION['ClassId'] = $result1['ClassId'];
				$_SESSION['TS'] = $result1['TeacherStudent'];
				header("location: Mprofile.php");

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
					<a href="Mlogin.php">Teacher Sign Up</a>
					<a href="Mindex.php">Login</a>
				</div>

				<div id="formDiv">

					<form method="POST" action="Mindex.php">


					<label>Email:</label><br/>
					<input type="text" name="email" value="<?php echo isset($_POST['email'])?$_POST['email']:''; ?>" /><br/>

					<label>Password:</label><br/>
					<input type="password" name="password" /><br/>


					<input type="submit" name="submit" value="Login" />

					</form>
					
					<br/>

					<form method="POST" action="Mforget.php">
					Forget your password?
					<input type="submit" name="forget" value="Forgotten Password" />
					</form>

				</div>

			</div>


		</body>

<html>