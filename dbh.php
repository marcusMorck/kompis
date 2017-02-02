<?php
$conn = mysqli_connect("localhost", "oophp", "Sweden123", "my_database");

if(!$conn) {
	die("Connection Failed: ".mysqli_connet_error());
}
