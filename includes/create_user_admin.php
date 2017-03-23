<?php
if(isset($_SESSION['admin'])){
session_start();
require '../includes/config.php';


$name = $_POST['name'];
$email = $_POST['email'];
$roll = $_POST['role'];
$password = $_POST['password'];
$adress = $_POST['adress'];
$postnr = $_POST['zipCode'];
$city = $_POST['city'];
$tel = $_POST['phonenr'];

$hashed = password_hash($password, PASSWORD_BCRYPT);

$sql = "INSERT INTO `users` (`name`, `email`, `role`, `hashedPw`, `adress`, `zipCode`, 
`city`, `phoneNumber`) VALUES ('$name', '$email', '$roll', '$hashed', '$adress', '$postnr', '$city', '$tel')";
$stmt = $pdo->prepare($sql);
$stmt->execute();

header("Location: ../includes/admin.php");
}
}
else{
    echo "Du har ingen behörighet till denna sidan!";
    header("Refresh:5 ../index.html");
}
?>
