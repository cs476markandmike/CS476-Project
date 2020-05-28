<?php
	session_start();
	$queryError = "";

	if(!isset($_SESSION["lawyer_id"]) || $_SESSION["lawyer_id"] != 0){
		header("Location: /cs476/php/signIn.php");
	}
	else{
		//create new database conncetion
		$db = new mysqli("localhost", "root", "", "projecta");
		if($db->connect_error){
			die("Connection Failed: " . $db->connect_error);
		}
		else{
			if(isset($_POST["submitted"]) && $_POST["submitted"]){
				$q1 = "SELECT clients.client_id, lawyers.lawyer_id
				FROM clients, lawyers
				WHERE clients.client_caseType = lawyers.lawyer_specialty";

				$result = $db->query($q1);


				if($result == true){
					$queryError = "1";
					$allRows[] = array();


					while($row = $result->fetch_assoc()){
						$client_id = $row["client_id"];
						$lawyer_id = $row["lawyer_id"];
						$clinic_id = rand(1,12);

						$q2 = "INSERT INTO clientassignment(clientAssignment_id, client_id, lawyer_id, clinic_id)
						VALUES(DEFAULT, '$client_id', '$lawyer_id', '$clinic_id')";
						$result2 = $db->query($q2);

					}

					$queryError = "Clients and Lawyers Successfully Matched.";

				}
				else{
					header("Location: /cs476/php/addClient.php");
					$queryError = "Client match unsuccessful.";
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

	<h2> Match Clients </h2>

	<form method="POST" action="matchClients.php">
		<input type="hidden" name="submitted" value="1">
		<button type="submit">Match Clients</button>
	</form>
	<?php echo $queryError ?>




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
