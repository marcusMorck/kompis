<?php
session_start();
if (isset($_SESSION['session_id'])){

?>

<!DOCTYPE html> 
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Bokning">
		<title>Boka Barnvakt</title>
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	</head>
	<body>
		<div style="display:none" id="hideChild">
			<div id="template">
			</div>
			<div id="container">
				<form action="../includes/book_babysitter.php" method="post">
					<input id="namn_bokning" type="text" name="name" placeholder="Namn" required="required"/>
					<select id="barn" name="children" placeholder="namn" required="required"> 
						<option value="">Antal Barn</option>
						<option value="1">1</option> 
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">>4</option>
					</select>
					<select id="vakt" name="babysitter"> 
						<option value="">Välj Barnvakt</option>
					</select> 
					<p id="bokaBarn">Boka Barnvakt<p/>
					<p id="starttid">Starttid:</p>
					<p id="sluttid">Sluttid:</p>
					<input id="start" type="datetime-local" name="starttime" onchange="babysitter_received();" required="required">
					<input id="end" type="datetime-local" name="endtime" onchange="babysitter_received();" required="required">
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