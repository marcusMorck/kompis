<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>registrera användare</title>
</head>
<body>

<?php
require "config.php";


// Ladda nödvändiga klasser via autoload
spl_autoload_register(function ($class) {
    include 'class/' . $class . '.php';
});


if (isset($_POST['submitReg'])) {

	// tar bort ev blanksteg
	foreach ($_POST as $key => $val) {
		$_POST[$key] = trim($val);
	}

	// letar efter tomma fält
	if (empty($_POST['firstName']) || empty($_POST['lastName']) || empty($_POST['epost']) || empty($_POST['password']) || empty($_POST['adress']) || empty($_POST['zipCode']) || empty($_POST['city']) || empty($_POST['phoneNumber'])) {
		$reg_error[] = 0;
	}

	// kollar om lösenordet är för kort
	if (strlen($_POST['password']) < 8) {
		$reg_error[] = 1;
	}

	$firstname = $_POST['firstName'];
	$lastname = $_POST['lastName'];
	$epost = $_POST['epost'];
	$adress = $_POST['adress'];
	$zipcode = $_POST['zipCode'];
	$city = $_POST['city'];
	$phonenumber = $_POST['phoneNumber'];

	// kollar om lösenorden stämmer överens
	if ($_POST['password'] != $_POST['password2']) {
		$reg_error[] = 2;
	} 
	else {
		$password = $_POST['password'];
	}
	
	// kolla att lösenordet innehåller minst en versal
	if (!preg_match('/[A-Z]/', $_POST['password'])) {
		$reg_error[] = 3;	
	}

	function isValidEmail($email) {
	    return filter_var($email, FILTER_VALIDATE_EMAIL) 
        && preg_match('/@.+\./', $email);
	}

	if (!isValidEmail($_POST['epost']))
  		$reg_error[] = 4;

  	// Inga fel? Spara och logga in samt skicka till välkomstsida
	if (!isset($reg_error)) {

		// En funktion för att skapa ett bra salt.
		function mt_rand_str ($l, $c = 'abcdefghiJKkLmnopQRStuVwxyz1234567890') {
		    for ($s = '', $cl = strlen($c)-1, $i = 0; $i < $l; $s .= $c[mt_rand(0, $cl)], ++$i);
		    return $s;
		}

		$password = $_POST['password'];
		$salt = mt_rand_str(31); // Ger en 31 tkn lång slumpsträng.
		$hashed = hash("sha512", $password . $salt ); // Ger 128 tkn.

		$stm = $pdo->prepare("INSERT INTO `users` (`firstName`, `lastName`, `email`, `hashedPw`, `salt`, `adress`, `zipCode`, `city`, `phoneNumber`)
			VALUES ('$firstname', '$lastname', '$epost', '$hashed', '$salt', '$adress', '$zipcode', '$city', '$phonenumber')");

		try {
			$stm->execute();
		}
		catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
    
	    $_SESSION['sess_id'] = $pdo->lastInsertId() . date("z");
	    $_SESSION['sess_user'] = $_POST['firstName'];
		$_SESSION['userid'] = $pdo->lastInsertId();

		echo "<script type='text/javascript'>
	   	document.location.href = 'usersummary.php';
		</script>";
	    exit;
	}
}

else {
 
	// Sätt variabler för tomt formulär
	for ($i = 0; $i < 7; $i++) {
	    $back[$i] = "";
	} 
}

$error_list[0] = "Alla obligatoriska fält är inte ifyllda.";
$error_list[1] = "Lösenordet måste vara minst 8 tecken.";
$error_list[2] = "Lösenorden stämmer inte överens.";
$error_list[3] = "Lösenordet måste innehålla minst en versal.";
$error_list[4] = "E-postadressen betraktas inte som giltig.";	

// <br /><b>Notice</b>:  Undefined offset: 3 in <b>C:\MAMP\htdocs\kompisprojekt\registeruser.php</b> on line <b>175</b><br />



?>

<div class = "container">
	<div class = 'page-header'>        
		<h1>Registrera dig</h1>
	</div>

	<div class = "col-xs-12 col-md-6">
	<?php
	if (isset($reg_error)){
 
		echo "<p>Något blev fel:<br>\n";
		echo "<ul>\n";
  		for ($i = 0; $i < sizeof($reg_error); $i++) {
    		echo "<li>{$error_list[$reg_error[$i]]}</li>\n";
  		}
  		echo "</ul>\n";
  
		$back[0] = stripslashes($_POST['firstName']);
	  	$back[1] = stripslashes($_POST['lastName']);
	  	$back[2] = stripslashes($_POST['epost']);
	  	$back[3] = stripslashes($_POST['adress']);
	  	$back[4] = stripslashes($_POST['zipCode']);
	  	$back[5] = stripslashes($_POST['city']);
	  	$back[6] = stripslashes($_POST['phoneNumber']);

	}

	?>

	<form action = "registeruser.php" method = "post" role = "form"> 
		<div class = 'row'>
			<div class="form-group col-xs-12 col-md-6">
				<label for = 'firstName' class = 'req'>Förnamn: </label>
				<input type = "text" name = "firstName" value = "<?php echo $back[0]; ?>">
			</div>
		</div>
		<div class = 'row'>
			<div class="form-group col-xs-12 col-md-6">
				<label for = 'lastName' class = 'req'>Efternamn: </label>
				<input type = "text" name = "lastName" value = "<?php echo $back[1]; ?>">
			</div>
		</div>
		<div class = 'row'>
			<div class="form-group col-xs-12 col-md-6">	
				<label for = 'epost' class = 'req'>E-post: </label>
				<input type = "text" name = "epost" value = "<?php echo $back[2]; ?>">
			</div>
		</div>
		<div class = 'row'>
			<div class="form-group col-xs-12 col-md-6">	
				<label for = 'password' class = 'req'>Lösenord: </label>
				<input type = "password" name = "password" value = "" >
				<span class="help-block">Minst 8 tecken varav minst 1 versal.</span>
			</div>
		</div>
		<div class = 'row'>
			<div class="form-group col-xs-12 col-md-6"> 
				<label for = 'password2' class = 'req'>Repetera lösenord: </label>
				<input type = "password" name = "password2" value = "">
			</div>
		</div>
		<div class = 'row'>
			<div class="form-group col-xs-12 col-md-6">	
				<label for = 'adress' class = 'req'>Adress: </label>
				<input type = "text" name = "adress" value = "<?php echo $back[3]; ?>">
			</div>
		</div>
		<div class = 'row'>
			<div class="form-group col-xs-12 col-md-6">	
				<label for = 'zipCode' class = 'req'>Postnummer: </label>
				<input type = "text" name = "zipCode" value = "<?php echo $back[4]; ?>">
			</div>
		</div>
		<div class = 'row'>
			<div class="form-group col-xs-12 col-md-6">	
				<label for = 'city' class = 'req'>Ort: </label>
				<input type = "text" name = "city" value = "<?php echo $back[5]; ?>">
			</div>
		</div>
		<div class = 'row'>
			<div class="form-group col-xs-12 col-md-6">	
				<label for = 'phoneNumber' class = 'req'>Telefonnummer: </label>
				<input type = "text" name = "phoneNumber" value = "<?php echo $back[6]; ?>">
			</div>
		</div>
		<div class = 'row'>
			<div class="form-group col-xs-12 col-md-6">	
				<button type="submit" class="btn btn-default" name = 'submitReg'>Spara dina uppgifter</button>
			</div>
		</div>
	</form>
 
</div>
</div>


</body>
</html>

