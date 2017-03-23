<?php
session_start();
?>

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
// kollar om användaren är inloggad
if (isset($_SESSION['session_id'])) {
	
		// tar bort bokningen när man trycker på knappen ta bort
	if (isset($_POST['idbabysitter'])) {
		$sqlDelete = "DELETE FROM `bookingbabysitter` WHERE `id` = :idbabysitter";
		$stmDelete = $pdo->prepare($sqlDelete);
		$stmDelete->execute(['idbabysitter' => $_POST['idbabysitter']]);

		echo "<script type='text/javascript'>
	   	document.location.href = '../html/my_page.php';
		</script>";
	    exit;
	}
		// tar bort bokningen när man trycker på knappen ta bort
	if (isset($_POST['idtutor'])) {
		$sqlDelete = "DELETE FROM `bookingtutor` WHERE `id` = :idtutor";
		$stmDelete = $pdo->prepare($sqlDelete);
		$stmDelete->execute(['idtutor' => $_POST['idtutor']]);

		echo "<script type='text/javascript'>
	   	document.location.href = '../html/my_page.php';
		</script>";
	    exit;
	}
		$now = date("Y-m-d H:i:s"); // dagens datum och tid på servern
		$sql = "SELECT * FROM `bookingtutor` WHERE `userId` = :userid";
		$stm = $pdo->prepare($sql);
		$stm->execute(['userid' => $_SESSION['session_id']]); 
		// kollar att userid stämmer överens och visar bara den inloggades bokningar
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
				if ($startTime > $now) { 
					// jämför starttid för bokning med dagens datum och visar bara kommande bokningar
					echo "<tr>
					<td>$userName</td> <td>$subject</td> <td>$tutor</td> <td>$startTime</td> <td>$endTime</td>";
					?>
					<td>
					<form action="../includes/readbooking.php" method="post">
					<input type="hidden" name="idtutor" value="<?php echo $row['id'];?>" />
					<button type="submit">Ta bort</button>
					</form>
					</td>
					<?php
					echo "</tr>";
				}
				} 
				echo "</table>";

		$sql = "SELECT * FROM `bookingbabysitter` WHERE `userId` = :userid";
		$stm = $pdo->prepare($sql);
		$stm->execute(['userid' => $_SESSION['session_id']]);
		// kollar att userid stämmer överens och visar bara den inloggades bokningar
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
				if ($startTime > $now) {
					// jämför starttid för bokning med dagens datum och visar bara kommande bokningar
					echo "<tr>
					<td>$userName</td> <td>$antalBarn</td> <td>$babysitter</td> <td>$startTime</td> <td>$endTime</td>";
					?>
					<td>
					<form action="../includes/readbooking.php" method="post">
					<input type="hidden" name="idbabysitter" value="<?php echo $row['id'];?>" />
					<button type="submit">Ta bort</button>
					</form>
					</td>
					<?php
					echo "</tr>";
				}
				}
		echo "</table>";

}

?>

</body>
</html>