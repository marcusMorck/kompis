<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Summering av användaruppgifter</title>
</head>
<body>

<?php
require "config.php";

?>

<div style="border:1px solid black;">

<?php


$x=$_SESSION['userobj']['name'];
echo "<p>Namn: $x</p>";
$x=$_SESSION['userobj']['epost'];
echo "<p>E-post: $x</p>";
if (isset($_SESSION['userobj']['role'])) {
	$x=$_SESSION['userobj']['role'];
	echo "<p>Roll: $x</p>";
}
$x=$_SESSION['userobj']['adress'];
echo "<p>Adress: $x</p>";
$x=$_SESSION['userobj']['zipCode'];
echo "<p>Postnummer: $x</p>";
$x=$_SESSION['userobj']['city'];
echo "<p>Ort: $x</p>";
$x=$_SESSION['userobj']['phoneNumber'];
echo "<p>Telefonnummer: $x</p>";

?>	

</div>


</body>
</html>
