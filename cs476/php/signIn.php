<?php
	$emailError="";
	$passwordError = "";
	$signInGood = true;
	$invalidEmailPasswordError = "";
	$signInError = "";
	$row;

	if(isset($_POST["submitted"]) && $_POST["submitted"]){
		//fetch user input from form
		$email = trim($_POST["user_email"]);
		$password = trim($_POST["user_password"]);

		//create a new database connection
		$db = new mysqli("localhost", "root", "", "projecta");
		if($db->connect_error){
			die("Connection Failed: " . $db->connect_error);
		}

		//query the database and get row data
		$q1 = "SELECT * FROM lawyers WHERE lawyer_email = '$email' AND lawyer_password = '$password'";
		$r1 = $db->query($q1);
		$row = $r1->fetch_assoc();

		//check if email and password match whats in the database
		if($email != $row["lawyer_email"] && $password != $row["lawyer_password"]){
			$signInGood = false;
			$invalidEmailPasswordError = "Invalid Email or Password.";
		}
		else{
			if($email == "" || $email == NULL){
				$signInGood = false;
				$emailError = "Please enter an email.";
			}
			if($password == "" || $password == NULL){
				$signInGood = false;
				$passwordError = "Please enter a password.";
			}
		}

		if($signInGood == true){
			session_start();
			$_SESSION["email"] = $row["lawyer_email"];
			$_SESSION["lawyer_id"] = $row["lawyer_id"];

			//check if user is admin or lawyer and direct to correct page
			if($_SESSION["lawyer_id"] == 0){
				header("Location: /cs476/admin.html");
				$db->close();
				exit();
			}
			else{
				header("Location: /cs476/php/user.php");
				$db->close();
				exit();
			}

		}
		else{
			$signInError = "Sign In Failed.";
			$db->close();
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Regina Pro-bono Law</title>
	<img src="pro-bono.png" alt="pro-bono">
	<meta charset="utf-8">
	<meta name="keywords" content="Regina Pro-bono, Regina Law, Pro-bono Lawyer Regina">
	<meta name="description" content="Home of Regina Pro-Bono Law">
	<link rel="stylesheet" href="style.css">

</head>
<body>
	<header>
		<h1>Regina Pro-Bono Law</h1>
	</header>

	<section>
		<form method="POST" id="login" action="signIn.php">
			<fieldset>
				<h2>Sign In</h2>
				<input type="hidden" name="submitted" value="1"/>
				<p>
					<label>email</label>
					<input type="text" name="user_email" id="user_email">

				</p>
				<p class="err_msg" id="email_msg"><?php echo $emailError ?></p>
				<p>
					<label>password</label>
					<input type="password" name="user_password" id="user_password">
				</p>
				<p class="err_msg" id="password_msg"><?php echo $passwordError ?><?php echo $invalidEmailPasswordError ?></p>

				<button type="submit" value="LogIn">Log In</button>
				<button onclick="window.location.href='register.html'">Register</button>


			</fieldset>
		</form>
	</section>


	<footer>
		<article class="copyright">
			<p>&copy 2020 - Michael Loseth and Mark Romanov</p>
		</article>
		<article class="contactUs">
			<a href="mailto:regina.probono.law@example.ca" class="contactUs-email">regina.probono.law@exmaple.ca</a>
			<a href="tel:+"13065555555>(306) 555-5555</a>
		</article>
	</footer>
</body>
</html>
