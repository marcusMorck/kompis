<?php
session_start();

require "config.php";

if (isset($_POST['submitReg'])) {

	// tar bort ev blanksteg
	foreach ($_POST as $key => $val) {
		$_POST[$key] = trim($val);
	}
	
	$name = $_POST['name'];
	$epost = $_POST['epost'];
	$adress = $_POST['adress'];
	$zipcode = $_POST['zipCode'];
	$city = $_POST['city'];
	$phonenumber = $_POST['phoneNumber'];
	//$role = $_POST['role'];

	
  	// Inga fel? Spara och logga in samt skicka till välkomstsida
	if (!isset($reg_error)) {
		// En funktion för att skapa ett bra salt.
		/*function mt_rand_str ($l, $c = 'abcdefghiJKkLmnopQRStuVwxyz1234567890') {
		    for ($s = '', $cl = strlen($c)-1, $i = 0; $i < $l; $s .= $c[mt_rand(0, $cl)], ++$i);
		    return $s;
		}
*/
		$password = $_POST['password'];
		//$salt = mt_rand_str(31); // Ger en 31 tkn lång slumpsträng.
		$hashed = password_hash($password, PASSWORD_BCRYPT); //Alla gamla lösenord som är gjorda innan denna raden funkar ej med inloggningen
		//$salt behövs ej då password_hash() fixar ett eget salt som inte behövs sparas i databasen
		$stm = $pdo->prepare("INSERT INTO `users` (`name`, `email`, `role`, `hashedPw`, `adress`, `zipCode`, `city`, `phoneNumber`)
			VALUES ('$name', '$epost', :role, '$hashed', '$adress', '$zipcode', '$city', '$phonenumber')");
		try {
			$stm->execute(['role' => $_POST['role']]);
		}
		catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		$_SESSION['userid'] = $pdo->lastInsertId();
		
		$_SESSION['userobj'] = $_POST;
		// sparar registerinfon i sessionen userobj, används senare i usersummary
		echo "<script type='text/javascript'>
	   	document.location.href = '../html/login.html';
		</script>";
	    exit;
	}
}
else {
 
	// Sätt variabler för tomt formulär
	for ($i = 0; $i < 6; $i++) {
	    $back[$i] = "";
	} 
}
  
		$back[0] = stripslashes($_POST['name']);
	  	$back[1] = stripslashes($_POST['epost']);
	  	$back[2] = stripslashes($_POST['adress']);
	  	$back[3] = stripslashes($_POST['zipCode']);
	  	$back[4] = stripslashes($_POST['city']);
	  	$back[5] = stripslashes($_POST['phoneNumber']);
	  	// ifall det blir något fel så lagras de ifyllda värdena så man slipper fylla i dem igen
?>
