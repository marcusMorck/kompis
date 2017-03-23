<?php
require "config.php";

$startTime = $_GET['starttime'];
$endTime = $_GET['endtime'];
// hämtar start- och sluttid från boka barnvakt
$sql = "SELECT `name`, `startTime`, `endTime` FROM `users` LEFT JOIN `bookingtutor` ON `users`.`name` = `bookingtutor`.`tutor` WHERE `startTime` != '" . $startTime . "' AND `endTime` != '" . $endTime . "' GROUP BY `name`";
// visar alla barnvakter som inte är upptagna vald tid
$stm = $pdo->prepare($sql);
$stm->execute([]);

foreach($stm as $row) {
	echo $row['name'] . "\n";
}
?>