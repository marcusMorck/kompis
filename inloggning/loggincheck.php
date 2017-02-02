<?php
//Variabler för serverns standardvärden
$servername = "localhost";
$username = "root";
$password = "root";
$database = "kompis";

// skapar en connection till databasen
$conn = mysqli_connect($servername, $username, $password, $database);

// Checkar så att connectionen funkar
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";

	$email = $_POST['email'];
	$password = $_POST['password'];


	$sqlquery = "SELECT * FROM users WHERE email='$email' AND password='$password'";

	$result = mysqli_query($conn, $sqlquery);

	if (mysqli_num_rows($result) == 1)
	{
		
		header("Location: loggout.php");
	}
	else
	{
		echo "Fel användarnamn eller lösenord, var vänlig försök igen! <br>
		klicka <a href='loggain.php'>Här</a> för att göra ett nytt försök!";
	}	



?>