<?php
session_start(); // Needed to access the session variables
unset($_SESSION['session_id']); // making sure that the session gets destroyed
session_destroy(); // Destroys the data of the session
header('Location: ../html/index.html'); //redirect back to login page
?>
