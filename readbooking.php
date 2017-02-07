<!DOCTYPE html>
<html>
<head>
	<title>Mina bokningar</title>
</head>
<body>
<?php
require 'config.php';
?>
<h1>Mina Bokningar</h1>

<?php

	$sql = "SELECT * FROM `bookingtutor`";
	$stm = $pdo->prepare($sql);
	$stm->execute([]);

		echo "<h2>Läxhjälpsbokningar</h2>
			<table>
			<tr><th>Name</th> <th>Ämne</th> <th>Tutor</th> <th>Starttid</th> <th>Sluttid</th>
			</tr>";

	foreach ($stm as $row) {
		$userName = $row['userName'];
		$subject = $row['subject'];
		$tutor = $row['tutor'];
		$startTime = $row['startTime'];
		$endTime = $row['endTime'];
			echo "<tr>
				<td>$userName</td> <td>$subject</td> <td>$tutor</td> <td>$startTime</td> <td>$endTime</td>
				</tr>";
		} 
		echo "</table>";


	$sql = "SELECT * FROM `bookingbabysitter`";
	$stm = $pdo->prepare($sql);
	$stm->execute([]);

		echo "<h2>Barnvaktsbokningar</h2>
			<table>
			<tr><th>Name</th> <th>Antal barn</th> <th>Barnvakt</th> <th>Starttid</th> <th>Sluttid</th>
			</tr>";

	foreach ($stm as $row) {
		$userName = $row['userName'];
		$antalBarn = $row['children'];
		$babysitter = $row['babysitter'];
		$startTime = $row['startTime'];
		$endTime = $row['endTime'];

		echo "<tr>
			<td>$userName</td> <td>$antalBarn</td> <td>$babysitter</td> <td>$startTime</td> <td>$endTime</td>
			</tr>";
	}
		echo "</table>";

?>

</body>
</html>