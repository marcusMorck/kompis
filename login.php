<?php

session_start();
require "config.php";


echo "Connected successfully <br>";

	$email = $_POST['email'];
	$password = $_POST['password'];

	$sqlquery = "SELECT * FROM users WHERE email='$email' AND hashedPw='$password'";

	$stm = $pdo->prepare($sqlquery);
	$row = $stm->fetch();
	$pwd = hash("sha512", $password . $row['salt'] );
	$password = $pwd;

	if ($stm->fetchColumn() > 0)
	{
		$_SESSION['id'] = $row['id'];
		header("Location: index.php");
	}
	else
	{
		echo "Fel användarnamn eller lösenord, var vänlig försök igen! <br>
		klicka <a href='loggin.php'>Här</a> för att göra ett nytt försök!";
	}	



?>