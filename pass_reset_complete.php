<?php

require "../dbh.php";

$newpass = $_POST['newpass'];
$newpass1 = $_POST['newpass1'];
$post_username = $_POST['username'];
$code = $_GET['code'];

if($newpass == $newpass1)
{
	$enc_pass = md5($newpass);
	
	mysql_query("UPDATE users2 SET pwd='$enc_pass' WHERE username='$post_username'");
	mysql_query("UPDATE users2 SET passreset='0' WHERE username='$post_username'");
	
	echo "Your password has been updated<p><a href='http://www.project'>Click here to login</a> </p>";
	
}
else
{
	echo "Password must match. <a href='forgetpass.php?code=$code&username=$post_username'> </a> Click here to go back";
}

?>