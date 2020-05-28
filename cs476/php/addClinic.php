<?php
	session_start();
	$formGood = true;
	$dateError = "";
	$dateRegex = '/(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d/';

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

		$date = $_POST["date"];



		//check if clinic date already exists or not.
		$q1 = "SELECT * FROM clinics WHERE 'clinic_date' = '$date'";
		$r1 = $db->query($q1);

		if($r1->num_rows > 0){
			$dateError = "Clinic with the date: " . $date . " already exists.";
			$formGood = false;
		}

		if($date == NULL || $date == "" || !preg_match($dateRegex, $date)){
			$formGood = false;
			$dateError = "Date cannot be blank and must be in the form of (mm/dd/yyyy)";
		}

		if($formGood == true){
			$q2 = "INSERT INTO clinics(clinic_id, clinic_date) VALUES (DEFAULT, '$date')";
			$r2 = $db->query($q2);

			if($r2 == true){
				header("Location: /cs476/php/addClinic.php");
				eixt();
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
	<link rel="stylesheet" href="style.css">
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
		<form method="POST" name="addClinic" id="addClinic" action="addClinic.php">
			<fieldset>
				<h2>Add Clinic</h2>
				<input type="hidden" name="submitted" value="1"/>
				<p>
					<label>Clinic Date(mm/dd/yyyy)</label>
					<input type="text" name="date">
				</p>
				<p class="err_msg" id="date_msg"><?php echo $dateError ?></p>

				<p>
				<button type="submit">Add Client</button>
				<button type="reset">Reset</button>
				</p>
			</fieldset>
		</form>
		<script type="text/javascript" src="js/addClinic-r.js"></script>
	</section>


	<footer>
		<article class="copyright">
			<p>&copy 2020 - Michael Loseth and Mark Romanov</p>
		</article>
		<article class="contactUs">
			<a href="mailto:regina.probono.law@example.ca" class="contactUs-email">regina.probono.law@exmaple.ca</a>
		</article>
	</footer>
</body>
</html>
