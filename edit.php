<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Page</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php

require 'config.php';

$result = $db->prepare("SELECT * FROM users WHERE id='".$_GET['id']."'");
$result->execute();

while($row = $result->fetch(PDO::FETCH_ASSOC)) {
$id = $row['id'];
$name = $row['name'];
$email = $row['email'];
$role = $row['role'];
$adress = $row['adress'];
$zipCode = $row['zipCode'];
$city = $row['city'];
$phoneNumber = $row['phoneNumber'];

echo "

<h2>Records for $name</h2>
<h3>Update Information</h3>

<form name='updateForm' method='post' action='update.php?id=".$id."'>

<label for='id'>User ID: </label><input type='text' name='id' id='id' value='".$id."' hidden />
$id<br>
<label for='name'>Name: </label><input type='text' name='name' value='".$name."' maxlength='10' /> <br/>
<label for='email'>Email: </label><input type='text' name='email' value='".$email."' maxlength='25' /> <br/>
<label for='role'>Role: </label><input type='text' name='role' value='".$role."' maxlength='25' /> <br/>
<label for='adress'>Adress: </label><input type='text' name='adress' value='".$adress."' maxlength='25' /> <br/>
<label for='zipCode'>ZipCode: </label><input type='text' name='zipCode' value='".$zipCode."' maxlength='25' /> <br/>
<label for='city'>City: </label><input type='text' name='city' value='".$city."' maxlength='25' /> <br/>
<label for='phoneNumber'>Phone Number: </label><input type='text' name='phoneNumber' value='".$phoneNumber."' maxlength='25' /> <br/>
<br/><br/><br/>
<button type='submit' id='btnUpdate' name='btnUpdate'>Update the Records </button> <br/>

</form>
";
}

?>

</body>
</html>
