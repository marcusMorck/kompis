<?php
session_start();
if (isset($_SESSION['session_id'])){

?>
<!DOCTYPE html> 
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Bokning">
		<title>Boka Läxhjälp</title>
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	</head>
	<body>
		<div style="display:none" id="hideChild">
			<div id="template">
			</div>
			<div id="container">
				<form action="../includes/book_tutor.php" method="post">
					<input id="namn_bokning" type="text" name="name" placeholder="Namn" required="required"/>
					<input id="ämne" type="text" name="subject" placeholder="Ämne" required="required">
					<select id="vakt" name="tutor"> 
						<option value="">Välj Läxhjälp</option>
					</select> 
					<p id="bokaLäx">Boka Läxhjälp<p/>
					<p id="starttid">Starttid:</p>
					<p id="sluttid">Sluttid:</p>
					<input id="start" type="datetime-local" name="starttime" onchange="tutor_received();" required="required">
					<input id="end" type="datetime-local" name="endtime" onchange="tutor_received();" required="required">
					<button id="boka_hjälp" type="submit" name="book" class="knapp">Boka</button>
				</form>
			</div>
			<script>
				$(function(){
					$('#template').load('template.html');
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