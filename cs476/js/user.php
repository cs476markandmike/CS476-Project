<?php
	session_start();
	$emailError = "";
	$workPhoneError = "";
	$cellPhoneError = "";
	$addressError = "";
	$firmError = "";
	$pwError = "";
	$confirmpwError = "";
	$queryError = "1";

	//check to see if user is logged in, if not send them to login page.
	if(!isset($_SESSION["lawyer_id"])){
		header("Location: /cs476/php/signIn.php");

	}
	else{
		$db = new mysqli("localhost", "root", "", "projecta");
		if($db->connect_error){
			die("Connection Failed: " . $db->connect_error);
		}

		$lawyer_id = $_SESSION["lawyer_id"];

		$q1 = "SELECT * FROM lawyers WHERE lawyer_id='$lawyer_id'";
		$result = $db->query($q1);
		$row = $result->fetch_assoc();
		
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Regina Pro-bono Law</title>
	<meta charset="utf-8">
	<meta name="keywords" content="Regina Pro-bono, Regina Law, Pro-bono Lawyer Regina">
	<meta name="description" content="Home of Regina Pro-Bono Law">
</head>
<body>
	<header>
		<h1>Regina Pro-Bono Law</h1>
	</header>


	<section>
		<h2>User Info</h2>
		<table id="lawyer_info">
			<tr>
				<th>First Name</th>
				<td><?=$row["lawyer_firstName"]?></td>
			</tr>
			<tr>
				<th>Last Name</th>
				<td><?=$row["lawyer_lastName"]?></td>
			</tr>
			<tr>
				<th>Work Phone Number</th>
				<td><?=$row["lawyer_workphone"]?></td>
			</tr>
			<tr>
				<th>Cell Phone Number</th>
				<td><?=$row["lawyer_cellphone"]?></td>
			</tr>
			<tr>
				<th>Email</th>
				<td><?=$row["lawyer_email"]?></td>
			</tr>
			<tr>
				<th>Firm</th>
				<td><?=$row["lawyer_firm"]?></td>
			</tr>
			<tr>
				<th>Address</th>
				<td><?=$row["lawyer_address"]?></td>
			</tr>
		</table>
	</section>

	<section>
		<h2>Current Clients and Clinic Dates</h2>
		<table id="lawyer_client_info">
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Clinic Date</th>
			</tr>
			<?php
			$lawyer_id = $_SESSION["lawyer_id"];
			$q2 = "SELECT client_id, clinic_id  FROM clientassignment WHERE lawyer_id = '$lawyer_id' LIMIT 12";
			$result2 = $db->query($q2);

			if($result2 == true){
				$queryError = "3";
				while($row2 = $result2->fetch_assoc()){
					$client_id = $row2["client_id"];
					$clinic_id = $row2["clinic_id"];


					$q3 = "SELECT clinic_date from clinics where clinic_id = '$clinic_id'";
					$r3 = $db->query($q3);
					$row3 = $r3->fetch_assoc();
					$clinic_date = $row3["clinic_date"];


					$q4 = "SELECT client_firstName, client_lastName FROM clients WHERE client_id = '$client_id'";
					$r4 = $db->query($q4);
					$row4 = $r4->fetch_assoc();
					$client_firstName = $row4["client_firstName"];
					$client_lastName = $row4["client_lastName"];

					echo "<tr>";
					echo "<td>" . $client_firstName . "</td>";
					echo "<td>" . $client_lastName . "</td>";
					echo "<td>" . $clinic_date . "</td>";
				}
			}
		?>
			
		</table>
		
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