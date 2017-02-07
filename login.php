<?php

session_start();
require "config.php";

if(!isset($_SESSION['role']){
	
	$email = $_POST['email'];
	$password = $_POST['password'];

	$sqlquery = "SELECT * FROM users WHERE email='$email' AND hashedPw='$password'";

	$stm = $pdo->prepare($sqlquery);
	$row = $stm->fetch();
	$pwd = hash("sha512", $password . $row['salt'] );
	$password = $pwd;

	if ($stm->fetchColumn() > 0)
	{
		if ($row['role'] === ""){
			//Inloggad som användare
			$_SESSION['role'] = $row['role'];
			header("Location: index.php");
		}
		else if ($_SESSION['role'] === "barnvakt"){
			//Inloggad som barnvakt
			$_SESSION['role'] = $row['role'];
			header("Location: index.php");
		}
		else if ($_SESSION['role'] === "läxhjälp"){
			//Inloggad som läxhjälp
			$_SESSION['role'] = $row['role'];
			header("Location: index.php");
		}
	}
	else
	{
		echo "Fel användarnamn eller lösenord, var vänlig försök igen! <br>
		klicka <a href='loggin.php'>Här</a> för att göra ett nytt försök!";
	}	

}
else{
		echo "Du är inte inloggad, var vänlig logga in!<br>
		klicka <a href='login.php'>Här</a> för att göra ett nytt försök!";
}
?>
