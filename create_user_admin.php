<?php
session_start();
require '../includes/config.php';


$name = $_POST['name'];
$email = $_POST['email'];
$roll = $_POST['role'];
$password = $_POST['password'];
$adress = $_POST['adress'];
$postnr = $_POST['zipcode'];
$city = $_POST['city'];
$tel = $_POST['phonenr'];

$hashed = password_hash($password, PASSWORD_BCRYPT);

$sql = "INSERT INTO `users` (`name`, `email`, `role`, `hashedPw`, `adress`, `zipcode`, 
`city`, `phoneNumber`) VALUES ('$name', '$email', '$roll', '$hashed', '$adress', '$postnr', '$city', '$tel')";
$stmt = $pdo->prepare($sql);
$stmt->execute();

header("Location: ../includes/admin.php");

?>
