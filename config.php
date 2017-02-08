<?php 

	$host = '127.0.0.1'; // localhost, den här datorn
	$db = 'kompis';
	$user = 'root';
	$password = 'root';
	$charset = 'utf8';
	$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
	$options = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES   => false  ];
	try { //Try to connect to database
	$pdo = new PDO($dsn, $user, $password, $options);
	} catch (PDOException $e){ //if not connected succesfully, give me an error message
		echo $e->getMessage();
	}
 ?>
