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

		
	if (isset($_POST['idbabysitter'])) {
		$sqlDelete = "DELETE FROM `bookingbabysitter` WHERE `id` = :idbabysitter";
		$stmDelete = $pdo->prepare($sqlDelete);
		$stmDelete->execute(['idbabysitter' => $_POST['idbabysitter']]);
		echo "<p>Du tog bort din bokning!</p>";
	}elseif (isset($_POST['idtutor'])) {
		$sqlDelete = "DELETE FROM `bookingtutor` WHERE `id` = :idtutor";
		$stmDelete = $pdo->prepare($sqlDelete);
		$stmDelete->execute(['idtutor' => $_POST['idtutor']]);
		echo "<p>Du tog bort din bokning!</p>";
	}

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
				<td>$userName</td> <td>$subject</td> <td>$tutor</td> <td>$startTime</td> <td>$endTime</td>";
				?>
				<td>
				<form action="readbooking.php" method="post">
				<input type="hidden" name="idtutor" value="<?php echo $row['id'];?>" />
				<button type="submit">Ta bort</button>
				</form>
				</td>
				<?php
			echo "</tr>";
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
		$id = $row['id'];
		$userName = $row['userName'];
		$antalBarn = $row['children'];
		$babysitter = $row['babysitter'];
		$startTime = $row['startTime'];
		$endTime = $row['endTime'];

		echo "<tr>
			<td>$userName</td> <td>$antalBarn</td> <td>$babysitter</td> <td>$startTime</td> <td>$endTime</td>";
			?>
			<td>
			<form action="readbooking.php" method="post">
			<input type="hidden" name="idbabysitter" value="<?php echo $row['id'];?>" />
			<button type="submit">Ta bort</button>
			</form>
			</td>
			<?php
		echo "</tr>";
	}
		echo "</table>";


?>

</body>
</html>
