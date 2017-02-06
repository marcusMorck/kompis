<?php
session_start();
require "../dbh.php";

if($_GET['code'])
{
	$get_username= $_GET['username'];
	$get_code= $_GET['code'];
	
	$query= mysql_query("SELECT * FROM users2 WHERE username='$get_username'");
	
	while($row= mysql_fetch_assoc($query))
	{
		$db_code= $row['passreset'];
		$db_username= $row['username'];
	}
	if($get_username == $db_username && $get_code == $db_code)
	{
		echo "
		<form action='pass_reset_complete.php?code=$get_code' method='POST'>
			Enter a new password<br><input type='password' name='newpass'><br>
			Re-enter your password<br><input type='password' name='newpass1'><p>
			<input type='hidden' name='username' value='$db_username'>
			<input type='submit' value='UPDATE Password!'>
			</form>
			";
	}
			
}
if(!$_GET['code'])
{
// Forget password form
echo "
<form action='forgetpass.php' method='POST'>
	Enter your username: <input type='text' name='username'>
	Enter your email <input type='text' name='email'>
	<input type='submit' name='submit' value='Submit'>
</form>";

if(isset($_POST['submit']))
{
	$username = $_POST['username'];
	$email = $_POST['email'];
	
	$query = mysql_query("SELECT * FROM users2 WHERE username='$username'");
	$numrow = mysql_num_rows($query);
	
	if($numrow!=0)
	{
		while($row = mysql_fetch_assoc($query))
		{
			$db_email = $row['email'];
		}
		if($email == $db_email)
		{
			$code = rand(10000,1000000);
			
			$to = $db_email;
			$subject = "Password Reset";
			$body = "
			
			This is an automated email. Please do not reply to this email.
			Click the link below or paste it into your brower to reset your password.
			http//:project//forgetpas.php?code=$code&username=$username
			
			";
			
			mysql_query("UPDATE users2 SET passreset='$code' WHERE username='$username'");
			
			mail($to,$subject,$body);
			
			echo "Check your email";
		}
		else
		{
			echo "Email is incorrect";
		}
	}
	else
	{
		echo "That username doesnot exist";
	}

}
}
?>