<!DOCTYPE html>
<html>
<head>
	<title>Barnvakter</title>
	<style>
		table, td {
			border: 1px solid black;
			padding: 1px;
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

$sql = "SELECT `id`, `name`, `email`, `adress`, `zipCode`, `city`, `phoneNumber` FROM `babysitter`";
$stmBaby = $pdo->prepare($sql);
$stmBaby->execute([]);

echo "<div class=\"babysitter\"><h1>Barnvakter</h1>
		<table>
		<tr>
			<th>Info</th> <th>Namn</th> <th>E-post</th> <th>Adress</th> <th>Postnr</th> <th>Stad</th> <th>Telefonnummer</th>
		</tr>";

	foreach ($stmBaby as $row) {
		$id = $row['id'];
		$name = $row['name'];
		$epost = $row['email'];
		$adress = $row['adress'];
		$zipcode = $row['zipCode'];
		$city = $row['city'];
		$phoneNumber = $row['phoneNumber'];

echo "<tr>"; ?>
	<td>
	<form action="read.php" method="post">
	<input type="hidden" name="idBaby" value="<?php echo $row['id'];?>" />
	<button type="button" id="infoBaby" onclick="window.open('userinfo.php')">Info</button>
	</form>
	</td>
	<?php 
	echo "<td>$name</td> <td>$epost</td> <td>$adress</td> <td>$zipcode</td> <td>$city</td> <td>$phoneNumber</td>
		</tr>";
	}

echo "</table></div>";
echo "<br>\n";


$sql = "SELECT `id`, `name`, `email`, `adress`, `zipCode`, `city`, `phoneNumber` FROM `tutor`";
$stmTutor = $pdo->prepare($sql);
$stmTutor->execute([]);

echo "<div class=\"tutor\"> <h1>Läxhjälp</h1>
		<table>
		<tr>
			<th>Info</th> <th>Namn</th> <th>E-post</th> <th>Adress</th> <th>Postnr</th> <th>Stad</th> <th>Telefonnummer</th>
		</tr>";

	foreach ($stmTutor as $row) {
		$name = $row['name'];
		$epost = $row['email'];
		$adress = $row['adress'];
		$zipcode = $row['zipCode'];
		$city = $row['city'];
		$phoneNumber = $row['phoneNumber'];

echo "<tr>"; ?>
	<td>
	<form action="read.php" method="post">
	<input type="hidden" name="idTutor" value="<?php echo $row['id'];?>" />
	<button type="button" id="infoTutor" onclick="window.open('userinfo.php')">Info</button>
	</form>
	</td>
	<?php
	echo "<td>$name</td> <td>$epost</td> <td>$adress</td> <td>$zipcode</td> <td>$city</td> <td>$phoneNumber</td>
	</tr>";
	}

echo "</table></div>";
echo "<br>\n";








?>


</body>
</html>