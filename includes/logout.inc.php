<?php
	session_start();
	unset($_SESSION['session_id']);
	unset($_SESSION['admin']);
	session_destroy();
	header("Location: ../index.html");
?>