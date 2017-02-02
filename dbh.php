<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "kompis";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn) {
	die("Connection Failed: ".mysqli_connet_error());
}
?>
