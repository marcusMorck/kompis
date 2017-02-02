<?php
include 'header.php';
?>

<?php
	if(isset($_SESSION['id'])) {
		echo $_SESSION['id'];
	}	else {
		echo "You are not logged in";
	}

?>
<br><br><br>
<?php
	if(isset($_SESSION['id'])) {
		echo "You are already logged in!";
	}	else {
		echo "<form action= 'includes/signup.inc.php' method= 'post'>
	<input type= 'text' name='first' placeholder='firstname'> <br>
	<input type= 'text' name='last' placeholder'lastname'> <br>
	<input type= 'text' name='uid' placeholder='userid'> <br>
	<input type= 'password' name='pwd' placeholder='password'> <br>
	<button type= 'submit'> Sign Up </button>
	</form>";
	}

?>	



</body>
</html>