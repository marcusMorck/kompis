<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Boka barnvakt</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php
require 'config.php';

if (isset($_POST['book'])) {
		
	// tar bort ev blanksteg
	foreach ($_POST as $key => $val) {
		$_POST[$key] = trim($val);
	}

	// letar efter tomma fält
	if (empty($_POST['name']) || empty($_POST['starttime']) || empty($_POST['endtime'])) {
		$reg_error[] = 0;
	}

	$userName = $_POST['name'];
	$children = $_POST['children'];
	$babysitter = $_POST['babysitter'];
	$startTime = $_POST['starttime'];
	$endTime = $_POST['endtime'];

	if (!isset($reg_error)) {
		
		$stm = $pdo->prepare("INSERT INTO `bookingbabysitter` (`userName`, `children`, `babysitter`, `startTime`, `endTime`) VALUES ('$userName', '$children', '$babysitter', '$startTime', '$endTime')");

		try {
			$stm->execute();
		}
		catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}

		$_SESSION['userid'] = $pdo->lastInsertId();
		}

		$_SESSION['bookobj'] = $_POST;

		echo "<script type='text/javascript'>
	   	document.location.href = 'bookingsummary.php';
		</script>";
	    exit;
}

$error_list[0] = "Alla obligatoriska fält är inte ifyllda.";
$error_list[1] = "Namnet hittades inte i databasen";


?>

<h1>Boka Barnvakt</h1>

<?php
		
	if (isset($reg_error)){
 
		echo "<p>Något blev fel:<br>\n";
		echo "<ul>\n";
	  	for ($i = 0; $i < sizeof($reg_error); $i++) {
	    	echo "<li>{$error_list[$reg_error[$i]]}</li>\n";
	  	}
	 	echo "</ul>\n";
	 }
?>

	<form action="bookbabysitter.php" method="post">
	<p>Namn:</p>
		<input type="text" name="name" value="">
	<p>Antal Barn:</p>
		<select name="children">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
		</select>
	<p>Barnvakt:</p>
		<select name ="babysitter">
			<?php
				$stm = $pdo->prepare("SELECT `name` FROM `users` WHERE `role` = :roll");
				$stm->execute(['roll' => 'Barnvakt']);
					foreach ($stm as $row) {
						$name = $row['name'];
						echo "<option>$name</option>";
						}
			?>
		</select>
	<p>Starttid:</p>
		<input type="datetime-local" name="starttime">
	<p>Sluttid:</p>
		<input type="datetime-local" name="endtime">
		<br><br>
		<button type="submit" name="book">Boka</button>
	</form>

</body>
</html>
