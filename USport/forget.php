<?php

	
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

		if(Email_Exists($Email))
		{
			$code=md5($Email);
			$Password = md5($code);
			$insertQuery = "UPDATE 9users SET Password=? WHERE Email=?";
			ExecuteSqlQuery($insertQuery, $Password,$Email);
			
			$headers = "From: mike_schwieder@hotmail.com" . "\r\n";
			$to = $Email;
			$subject = "Password Reset - Social 7 Game";
			$body = "This is an automated email. Please DO NOT reply to this email.
			
			Your new password is $code . Please enter that as your new password in the login screen.";

			mail($to, $subject, $body, $headers);
			
			$error = "New password has been sent to your email.";
		}
		else 
		{
			$error = "Email does not exsist.";
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
					<a href="login.php">Teacher Sign Up</a>
					<a href="index.php">Login</a>
				</div>

				<div id="formDiv">

					<form method="POST" action="forget.php">


					<label>Email:</label><br/>
					<input type="text" name="email" value="<?php echo isset($_POST['email'])?$_POST['email']:''; ?>" /><br/>
					<br/>
					<input type="submit" name="submit" /><br/><br/>
