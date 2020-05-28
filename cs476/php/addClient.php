<?php
	session_start();
	$firstNameError = "";
	$lastNameError = "";
	$phoneError = "";
	$addressError = "";
	$clientError = "";
	$caseTypeError = "";
	$formGood = true;

	//first check if there is an active session or not and redirect to login page if no session
	if(!isset($_SESSION["lawyer_id"]) || $_SESSION["lawyer_id"] != 0){
		header("Location: /cs476/php/signIn.php");
	}
	else{
		if(isset($_POST["submitted"]) && $_POST["submitted"]){
		//create new database conncetion
		$db = new mysqli("localhost", "root", "", "projecta");
		if($db->connect_error){
			die("Connection Failed: " . $db->connect_error);
		}

		//define variables and assign form data to them
		$firstName = trim($_POST["first_name"]);
		$lastName = trim($_POST["last_name"]);
		$phoneNumber = trim($_POST["phone"]);
		$address = trim($_POST["address"]);
		$caseType = trim($_POST["caseType"]);

		//check if client is not already in database
		$q1 = "SELECT * FROM clients WHERE 'client_firstName' = '$firstName' AND 'client_lastName' = '$lastName'";
		$r1 = $db->query($q1);

		if($r1 == true){
			$clientError = "Failed to add client. Client already exists.";
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

			if($phoneNumber == null || $phoneNumber == ""){
				$formGood = false;
				$phoneError = "Phone number Cannot Be Blank";
			}

			if($address == null || $address == ""){
				$formGood = false;
				$addressError = "Addres Cannot Be Blank";
			}

			if($caseType == null || $caseType == ""){
				$formGood = false;
				$caseTypeError = "Case Type Cannot Be Blank";
			}
		}

		if($formGood == true){
			//create new query to insert client into database
			$q2 = "INSERT INTO clients(client_id, client_firstName, client_lastName, client_phone, client_address, client_caseType) VALUES (DEFAULT,'$firstName','$lastName','$phoneNumber','$address','$caseType')";
			$r2 = $db->query($q2);

			if($r2 == true){
				header("Location: /cs476/php/addClient.php");
				exit();
			}
			else{
				$db->close();
			}
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
	<script type="text/javascript" src="js/addClient.js"></script>
	<link rel="stylesheet" href="style.css">s
</head>
<body>
	<header>
		<h1>Regina Pro-Bono Law</h1>
	</header>

	<nav>
		<a href="/cs476/addClient.html">Add Client</a>
		<a href="/cs476/removeClient.html">Remove Cleint</a>
		<a href="/cs476/addNewClinic.html">Add a Clinic</a>
		<a href="/cs476/matchClients.html">Match Clients/Lawyer</a>
		<a href="/cs476/searchClients.html">Lookup Client</a>
		<a href="/cs476/searchLawyers.html">Look up Lawyer</a>
		<a href="index.html">Log Out</a>
	</nav>

	<section>
		<form method="POST" id="addClient" action="addClient.php">
			<fieldset>
				<h2>Add Client</h2>
				<input type="hidden" name="submitted" value="1"/>
				<p>
					<?php echo $clientError ?>
				</br>
					<label>First Name</label>
					<input type="text" name="first_name">
				</p>
				<p class="err_msg" id="first_name_msg"><?php echo $firstNameError ?></p>

				<p>
					<label>Last Name</label>
					<input type="text" name="last_name">
				</p>
				<p class="err_msg" id="last_name_msg"><?php echo $lastNameError ?></p>

				<p>
					<label>Phone Number</label>
					<input type="text" name="phone">
				</p>
				<p class="err_msg" id="phone_msg"><?php echo $phoneError ?></p>

				<p>
					<label>Home Address</label>
					<input type="text" name="address">
				</p>
				<p class="err_msg" id="address_msg"><?php echo $addressError ?></p>

				<p>

					<label>Case Type</label>
					<select id="caseType" name="caseType">
						<option value="1">Criminal</option>
						<option value="2">Civil</option>
						<option value="3">Administrative</option>
						<option value="4">Constitutional</option>
					</select>

				</p>
				<p class="err_msg" id="clientType_msg"><?php echo $caseTypeError ?></p>

				<button type="submit">Add Client</button>
				<button type="reset">Reset</button>


			</fieldset>
		</form>
		<script type="text/javascript" src="js/addClient-r.js"></script>

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
