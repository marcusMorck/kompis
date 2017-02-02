<?php
session_start();
include '../dbh.php';

	$email = $_POST['email'];
	$password= $_POST['password'];

	$sqlquery = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = $conn->query($sql);

if(!$row= $result->fetch_assoc()) {
	echo "Your username and password is not correct";
} else {
	$_SESSION['id'] = $row['id'];
}
header("Location: ../index.php");
?>
