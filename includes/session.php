<?php
	session_start();
	if(isset($_SESSION['session_id'])){
		echo "true";
	}
?>