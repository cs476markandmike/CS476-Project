<?php
	$formGood = true;

	$firstNameError = "";
	$lastNameError = "";
	$emailError = "";
	$workPhoneError = "";
	$cellPhoneError = "";
	$addressError = "";
	$firmError = "";
	$barNumberError = "";
	$pwError = "";
	$confirmpwError = "";

	if(isset($_POST["submitted"]) && $_POST["submitted"]){
		//define variables and assign form data to them
		$firstName = trim($_POST["user_firstname"]);
		$lastName = trim($_POST["user_lastname"]);
		$email = trim($_POST["user_email"]);
		$workPhone = trim($_POST["user_workphone"]);
		$cellphone = trim($_POST["user_cellphone"]);
		$address = trim($_POST["user_address"]);
		$firm = trim($_POST["user_firm"]);
		$barNumber = trim($_POST["user_bar"]);
		$password = trim($_POST["user_password"]);
		$pwConfirm = trim($_POST["user_pwConfirm"]);



		//create new database connection
		$db = new mysqli("localhost", "root", "", "projecta");
		if($db->connect_error){
			die("Connection Failed: " . $db->connect_error);
		}

		//first check that the lawyer is not already registered by checking if
		//the bar number already exists in the lawyer table.
		$q1 = "SELECT * FROM lawyers WHERE 'lawyer_barNumber' = '$barNumber'";
		$r1 = $db->query($q1);


		if($r1->num_rows > 0){
			$barNumberError = "Bar number already registered.";
			$formGood = false;
		}
		else{
			if($firstName == null || $firstName == ""){
				$formGood = false;
				$firstNameError = "First Name Cannot Be Blank";
			}

			if($lastName == null || $lastName == ""){
				$formGood = false;
				$lastNameError = "Last Name Cannot Be Blank";
			}

			if($email == null || $email == ""){
				$formGood = false;
				$emailError = "Email Cannot Be Blank";
			}

			if($workPhone == null || $workPhone == ""){
				$formGood = false;
				$workPhoneError = "Work Phone Cannot Be Blank";
			}

			if($cellphone == null || $cellphone == ""){
				$formGood = false;
				$cellPhoneError = "Cellphone Number Cannot Be Blank";
			}

			if($firm == null || $firm == ""){
				$formGood = false;
				$firmError = "Firm Cannot Be Blank";
			}

			if($barNumber == null || $barNumber == ""){
				$formGood = false;
				$barNumberError = "BAR Number Cannot Be Blank";
			}

			if($password == null || $password == ""){
				$formGood = false;
				$passwordError = "Password Cannot Be Blank";
			}

			if($pwConfirm == null || $pwConfirm == ""){
				$formGood = false;
				$confirmpwError = "Confirm password cannot be balnk.";
			}

			if($pwConfirm != $password){
				$formGood = false;
				$pwConfirmError = "Password and Confirm password do not match.";
			}
		}

		//check if formGood is true or false
		if($formGood == true){
			//createa  new query to insert all of the lawyer information into the database
			$q2 = "INSERT INTO lawyers(lawyer_id, lawyer_firstName, lawyer_lastName, lawyer_email, lawyer_workPhone, lawyer_cellPhone, lawyer_address, lawyer_firm, lawyer_password, lawyer_barNumber, clinic_id) VALUES (DEFAULT, '$firstName','$lastName','$email','$workPhone','$cellphone','$address','$firm','$password','$barNumber', 0)";
			$r2 = $db->query($q2);

			if($r2 == true){
				header("Location: ..index.html");
				$db->close();
				exit();
			}
			else{
				$db->close();
			}

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
		<form method="POST" name="register" id="register" action="register.php">
			<fieldset>
				<h2>Register</h2>
				<input type="hidden" name="submitted" value="1"/>
				<p>
					<label>First Name</label>
					<input type="text" name="user_firstname">
				</p>
				<p class="err_msg" id="user_firstname_msg"><?php echo $firstNameError ?></p>
				<p>
					<label>Last Name</label>
					<input type="text" name="user_lastname">
				</p>
				<p class="err_msg" id="user_lastname_msg"><?php echo $lastNameError ?></p>
				<p>
					<label>email</label>
					<input type="email" name="user_email">
				</p>
				<p class="err_msg" id="user_email_msg"><?php echo $emailError ?></p>
				<p>
					<label>Work Phone Number</label>
					<input type="text" name="user_workphone">
				</p>
				<p class="err_msg" id="user_workphone_msg"><?php echo $workPhoneError ?></p>
				<p>
					<label>Cell Phone Number</label>
					<input type="text" name="user_cellphone">
				</p>
				<p class="err_msg" id="user_cellphone_msg"><?php echo $cellPhoneError ?></p>
				<p>
					<label>Work Address</label>
					<input type="text" name="user_address">
				</p>
				<p class="err_msg" id="user_address_msg"><?php echo $addressError ?></p>
				<p>
					<label>Firm</label>
					<input type="text" name="user_firm">
				</p>
				<p class="err_msg" id="user_firm_msg"><?php echo $firmError ?></p>
				<p>
					<label>BAR Number</label>
					<input type="text" name="user_bar">
				</p>
				<p class="err_msg" id="user_bar_msg"><?php echo $barNumberError ?></p>

				<p>
					<label>Password</label>
					<input type="text" name="user_password">
				</p>
				<p class="err_msg" id="user_pw_msg"><?php echo $pwError ?></p>

				<p>
					<label>Confirm Password</label>
					<input type="text" name="user_pwConfirm">
				</p>
				<p class="err_msg" id="user_pwConfirm_msg"><?php echo $confirmpwError ?></p>

				<p>
					<label>Specialty</label>
					<select id="specialty" name="specialty">
						<option value="1">Criminal</option>
						<option value="2">Civil</option>
						<option value="3">Administrative</option>
						<option value="4">Constitutional</option>
					</select>
				</p>


				<button type="submit">Register</button>
				<button type="button">Reset</button>


			</fieldset>
		</form>

	</section>

	<footer>
		<article class="copyright">
			<p>&copy 2020 - Michael Loseth and Mark Romanow</p>
		</article>
		<article class="contactUs">
			<a href="mailto:regina.probono.law@example.ca" class="contactUs-email">regina.probono.law@exmaple.ca</a>
			<a href="tel:+"13065555555>(306) 555-5555</a>
		</article>
	</footer>

<p>


</p>
</body>
</html>
