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
			flex-direction: row;
			justify-content: space-around;
		}

		#babysitter {
			flex: auto;
		}
		#tutor {
			flex: auto;
		}


	</style>
</head>
<body>
<?php
require 'config.php';

		$sqlbaby = "SELECT * FROM `users` WHERE `role` = :roll";
		$stmbaby = $pdo->prepare($sqlbaby);
		$stmbaby->execute(['roll' => 'Barnvakt']);
		echo "<div class=\"babysitter\"><h2>Barnvakter</h2>";

		foreach ($stmbaby as $row) {
			$id = $row['id'];
			$name = $row['name'];
			$epost = $row['email'];
			$role = $row['role'];
			$adress = $row['adress'];
			$zipCode = $row['zipCode'];
			$city = $row['city'];
			$phoneNumber = $row['phoneNumber'];
			$reference = $row['reference'];
			
		echo "<ul><li><b>Roll:</b> $role</li>
				<li><b>Namn:</b> $name</li>
				<li><b>E-post:</b> $epost</li>
				<li><b>Adress:</b> $adress</li>
				<li><b>Postnr:</b> $zipCode</li>
				<li><b>Ort:</b> $city</li>
				<li><b>Telefonnr:</b> $phoneNumber</li>
				<li><b>Referens:</b> $reference</li></ul>";
		}

		echo "</div>";

		$sqltutor = "SELECT * FROM `users` WHERE `role` = :roll";
		$stmtutor = $pdo->prepare($sqltutor);
		$stmtutor->execute(['roll' => 'Läxhjälp']);
		echo "<div class=\"tutor\"><h2>Läxhjälp</h2>";

		foreach ($stmtutor as $row) {
			$id = $row['id'];
			$name = $row['name'];
			$epost = $row['email'];
			$role = $row['role'];
			$adress = $row['adress'];
			$zipCode = $row['zipCode'];
			$city = $row['city'];
			$phoneNumber = $row['phoneNumber'];
			$reference = $row['reference'];
			
		echo "<ul><li><b>Roll:</b> $role</li>
				<li><b>Namn:</b> $name</li>
				<li><b>E-post:</b> $epost</li>
				<li><b>Adress:</b> $adress</li>
				<li><b>Postnr:</b> $zipCode</li>
				<li><b>Ort:</b> $city</li>
				<li><b>Telefonnr:</b> $phoneNumber</li>
				<li><b>Referens:</b> $reference</li></ul>";
		}

		echo "</div>";


?>


</body>
</html>
