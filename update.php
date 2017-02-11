<?php

require 'config.php';

$form = $_POST;

$id = $form['id'];
$name = $form['name'];
$email = $form['email'];
$role = $form['role'];
$adress = $form['adress'];
$zipCode = $form['zipCode'];
$city = $form['city'];
$phoneNumber = $form['phoneNumber'];

$sql = "UPDATE users SET id = :id, name = :name, email = :email, role = :role, adress = :adress, zipCode = :zipCode, city = :city, phoneNumber = :phoneNumber
 WHERE id = :id";

$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
$stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
$stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
$stmt->bindParam(':role', $_POST['role'], PDO::PARAM_STR);
$stmt->bindParam(':adress', $_POST['adress'], PDO::PARAM_STR);
$stmt->bindParam(':zipCode', $_POST['zipCode'], PDO::PARAM_STR);
$stmt->bindParam(':city', $_POST['city'], PDO::PARAM_STR);
$stmt->bindParam(':phoneNumber', $_POST['phoneNumber'], PDO::PARAM_STR);


$stmt->execute();

header("Location: edit.php?id=".$id."");


?>