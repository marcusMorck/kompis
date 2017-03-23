<?php
session_start();
if (isset($_SESSION['session_id'])){

?>
<!DOCTYPE html> 
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Mina Sidor</title>
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>	
		<meta name="description" content="Mina Sidor">
		<link href="../css/bootstrap.css" rel="stylesheet">
		<script src="../js/bootstrap.js"></script>
	</head>
	<body>
		<div style="display:none" id="hideChild">
			<div id="template">
		</div>
			<button id="change" class="btn">Ändra Uppgifter</button>
			<div id="mina_bokningar">
			</div>
			<script>
				$(function(){
					$('#template').load('template.html');
					$('#mina_bokningar').load('../includes/read_booking.php');
				});
			</script>
		</div>
	</body>
</html>
<?php
}
else{
    echo "Du måste logga in för att få behörighet till denna sidan!";
    header("Refresh:5 ../html/login.html");
}
?>