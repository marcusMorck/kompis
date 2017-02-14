<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Boka läxhjälp</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php
require 'config.php';

if (isset($_POST['book'])) {
		
	foreach ($_POST as $key => $val) {
		$_POST[$key] = trim($val);
	}

	$userName = $_POST['name'];
	$subject = $_POST['subject'];
	$tutor = $_POST['tutor'];
	$startTime = $_POST['starttime'];
	$endTime = $_POST['endtime'];

	if (!isset($reg_error)) {
		
		$stm = $pdo->prepare("INSERT INTO `bookingtutor`(`userName`, `subject`, `tutor`, `startTime`, `endTime`) VALUES ('$userName', '$subject', '$tutor', '$startTime', '$endTime')");

		try {
			$stm->execute();
		}
		catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}

		$_SESSION['userid'] = $pdo->lastInsertId();

		$_SESSION['bookobj'] = $_POST;

		echo "<script type='text/javascript'>
	   	document.location.href = '../html/my_page.html';
		</script>";
	    exit;
	}
}
?>

<h1>Boka Läxhjälp</h1>


	<form action='booktutor.php' method='post'>
		<p>Namn:</p>
		<input type='text' name='name' value=''>
		<p>Ämne:</p>
		<input type='text' name='subject' value=''> 
		<p>Starttid:</p>
		<input type='datetime-local' name='starttime'>
		<p>Sluttid:</p>
		<input type='datetime-local' name='endtime'>
		<p>Läxhjälp:</p>
		<select name ='tutor' id="tutor">
			<option></option>
			<?php
				$stm = $pdo->prepare("SELECT `name` FROM `users` WHERE `role` = :roll");
				$stm->execute(['roll' => 'Läxhjälp']);
					foreach ($stm as $row) {
						$name = $row['name'];
						echo "<option>$name</option>";
						}

			?>
		</select>
		<br><br>
		<button type='submit' name='book'>Boka</button>
	</form>


</body>
</html>
