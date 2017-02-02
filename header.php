<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login system</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>

<header>
	<nav>
		<ul>
			<li><a href="index.php">HOME </a> </li>
			<?php
				if(isset($_SESSION['id'])) {
					echo "<form action='includes/logout.inc.php'>
						<button>LOG OUT</button> </form>";
	}	else {
		echo "<form action= 'includes/login.inc.php' method= 'post'>
	<input type= 'text' name='uid' placeholder='userid'> 
	<input type= 'password' name='pwd' placeholder='password'>
	<button type= 'submit'> Login </button>
	</form>";
	}
	?>
			<li><a href="signup.php">SIGNUP </a> </li>
		</ul>
	</nav>
</header>
