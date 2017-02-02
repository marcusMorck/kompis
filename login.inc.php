<?php
session_start();
include '../dbh.php';

$uid= $_POST['uid'];
$pwd= $_POST['pwd'];

$sql = "SELECT * FROM users2 WHERE uid= '$uid' AND pwd= '$pwd'";
$result = $conn->query($sql);

if(!$row= $result->fetch_assoc()) {
	echo "Your username and password is not correct";
} else {
	$_SESSION['id'] = $row['id'];
}
header("Location: ../index.php");
?>