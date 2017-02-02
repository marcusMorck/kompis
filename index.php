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

</body>
</html>