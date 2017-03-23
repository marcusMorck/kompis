<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>registrera användare</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<?php
require "config.php";


if (isset($_POST['submitReg'])) {

	// tar bort ev blanksteg
	foreach ($_POST as $key => $val) {
		$_POST[$key] = trim($val);
	}

	// letar efter tomma fält
	if (empty($_POST['name']) || empty($_POST['epost']) || empty($_POST['password']) || empty($_POST['adress']) || empty($_POST['zipCode']) || empty($_POST['city']) || empty($_POST['phoneNumber'])) {
		$reg_error[] = 0;
	}

	// kollar om lösenordet är för kort
	if (strlen($_POST['password']) < 8) {
		$reg_error[] = 1;
	}

	$name = $_POST['name'];
	$epost = $_POST['epost'];
	$adress = $_POST['adress'];
	$zipcode = $_POST['zipCode'];
	$city = $_POST['city'];
	$phonenumber = $_POST['phoneNumber'];
	$role = $_POST['role'];

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
			VALUES ('$name', '$epost', '$role', '$hashed', '$adress', '$zipcode', '$city', '$phonenumber')");

		try {
			$stm->execute();
		}
		catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}

		$_SESSION['userid'] = $pdo->lastInsertId();
		}

		$_SESSION['userobj'] = $_POST;

		echo "<script type='text/javascript'>
	   	document.location.href = 'usersummary.php';
		</script>";
	    exit;
}

else {
 
	// Sätt variabler för tomt formulär
	for ($i = 0; $i < 6; $i++) {
	    $back[$i] = "";
	} 
}

$error_list[0] = "Alla obligatoriska fält är inte ifyllda.";
$error_list[1] = "Lösenordet måste vara minst 8 tecken.";
$error_list[2] = "Lösenorden stämmer inte överens.";
$error_list[3] = "Lösenordet måste innehålla minst en versal.";
$error_list[4] = "E-postadressen betraktas inte som giltig.";	

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
  
		$back[0] = stripslashes($_POST['name']);
	  	$back[1] = stripslashes($_POST['epost']);
	  	$back[2] = stripslashes($_POST['adress']);
	  	$back[3] = stripslashes($_POST['zipCode']);
	  	$back[4] = stripslashes($_POST['city']);
	  	$back[5] = stripslashes($_POST['phoneNumber']);

	}

	?>

	<form action = "registeruser.php" method = "post" role = "form"> 
		<div class = 'row'>
			<div class="form-group col-xs-12 col-md-6">
				<label for = 'name' class = 'req'>Namn: </label>
				<input type = "text" class="form-control" name = "name" value = "<?php echo $back[0]; ?>">
			</div>
		</div>
		<div class = 'row'>
			<div class="form-group col-xs-12 col-md-6">	
				<label for = 'epost' class = 'req'>E-post: </label>
				<input type = "text" class="form-control" name = "epost" value = "<?php echo $back[1]; ?>">
			</div>
		</div>
		<div class = 'row'>
			<div class="form-group col-xs-12 col-md-6">	
				<label for = 'password' class = 'req'>Lösenord: </label>
				<input type = "password" class="form-control" name = "password" value = "" >
				<span class="help-block">Minst 8 tecken varav minst 1 versal.</span>
			</div>
		</div>
		<div class = 'row'>
			<div class="form-group col-xs-12 col-md-6"> 
				<label for = 'password2' class = 'req'>Repetera lösenord: </label>
				<input type = "password" class="form-control" name = "password2" value = "">
			</div>
		</div>
		<div class = 'row'>
			<div class="form-group col-xs-12 col-md-6">	
				<label for = 'adress' class = 'req'>Adress: </label>
				<input type = "text" class="form-control" name = "adress" value = "<?php echo $back[2]; ?>">
			</div>
		</div>
		<div class = 'row'>
			<div class="form-group col-xs-12 col-md-6">	
				<label for = 'zipCode' class = 'req'>Postnummer: </label>
				<input type = "text" class="form-control" name = "zipCode" value = "<?php echo $back[3]; ?>">
			</div>
		</div>
		<div class = 'row'>
			<div class="form-group col-xs-12 col-md-6">	
				<label for = 'city' class = 'req'>Ort: </label>
				<input type = "text" class="form-control" name = "city" value = "<?php echo $back[4]; ?>">
			</div>
		</div>
		<div class = 'row'>
			<div class="form-group col-xs-12 col-md-6">	
				<label for = 'phoneNumber' class = 'req'>Telefonnummer: </label>
				<input type = "text" class="form-control" name = "phoneNumber" value = "<?php echo $back[5]; ?>">
			</div>
		</div>
		<div class = 'row'>
			<div class="form-group col-xs-12 col-md-6">
				<label>Barnvakt: <input type="radio" name="role" id="babysitter" value="Barnvakt"></label>
				<span class="help-block">Kryssa i om du vill anmäla dig som barnvakt</span>
			</div>
		</div>
		<div class = 'row'>
			<div class="form-group col-xs-12 col-md-6">
				<label>Läxhjälp: <input type="radio" name="role" id="tutor" value="Läxhjälp"></label>
				<span class="help-block">Kryssa i om du vill anmäla dig som läxhjälpare</span>
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


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>
