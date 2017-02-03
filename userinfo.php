<!DOCTYPE html>
<html>
<head>
	<title>Användarinfo</title>
	<style>
		ul {
			list-style-type: none;
			border: 1px solid black;
			padding: 5px;
		}
		body {
			display: flex;
			flex-wrap: wrap;
			justify-content: space-around;
		}
		#babysitter {
			flex: auto;
		}
		#tutor {
			flex: auto;
		}
		img {
			width: 250px;
			height: 200px;
		}


	</style>
</head>
<body>
<?php
require 'config.php';

		$sqlbaby = "SELECT * FROM `babysitter`";
		$stmbaby = $pdo->prepare($sqlbaby);
		$stmbaby->execute([]);
		echo "<div class=\"babysitter\"><h2>Barnvakter</h2>";

		foreach ($stmbaby as $row) {
			$id = $row['id'];
			$name = $row['name'];
			$epost = $row['email'];
			$adress = $row['adress'];
			$zipCode = $row['zipCode'];
			$city = $row['city'];
			$phoneNumber = $row['phoneNumber'];
			$age = $row['age'];
			$reference = $row['reference'];
			$profile = $row['profilePic'];
		
		echo "<ul><li><img src=\"$profile\" alt=\"bild\"></li>
				<li><b>Roll:</b> Barnvakt</li>
				<li><b>Namn:</b> $name</li>
				<li><b>E-post:</b> $epost</li>
				<li><b>Adress:</b> $adress</li>
				<li><b>Postnr:</b> $zipCode</li>
				<li><b>Ort:</b> $city</li>
				<li><b>Telefonnr:</b> $phoneNumber</li>
				<li><b>Ålder:</b> $age</li>
				<li><b>Referens:</b> $reference</li></ul>";
		}

		echo "</div>";


		$sqltutor = "SELECT * FROM `tutor`";
		$stmtutor = $pdo->prepare($sqltutor);
		$stmtutor->execute([]);
		echo "<div class=\"tutor\"><h2>Läxhjälpare</h2>";

		foreach ($stmtutor as $row) {
			$id = $row['id'];
			$name = $row['name'];
			$epost = $row['email'];
			$adress = $row['adress'];
			$zipCode = $row['zipCode'];
			$city = $row['city'];
			$phoneNumber = $row['phoneNumber'];
			$age = $row['age'];
			$reference = $row['reference'];
			$profile = $row['profilePic'];
			$subject1 = $row['subject1'];
			$subject2 = $row['subject2'];
		
		echo "<ul><li><img src=\"$profile\" alt=\"bild\"></li>
				<li><b>Roll:</b> Tutor</li>
				<li><b>Namn:</b> $name</li>
				<li><b>E-post:</b> $epost</li>
				<li><b>Adress:</b> $adress</li>
				<li><b>Postnr:</b> $zipCode</li>
				<li><b>Ort:</b> $city</li>
				<li><b>Telefonnr:</b> $phoneNumber</li>
				<li><b>Ålder:</b> $age</li>
				<li><b>Referens:</b> $reference</li>
				<li><b>Ämne:</b> $subject1 $subject2</li>
				</ul>";
		}

		echo "</div>";
?>


</body>
</html>