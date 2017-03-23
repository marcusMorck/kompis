<?php
require "config.php";

$startTime = $_GET['starttime'];
$endTime = $_GET['endtime'];

$sql = "SELECT `name`, `startTime`, `endTime` FROM `users` LEFT JOIN `bookingbabysitter` ON `users`.`name` = `bookingbabysitter`.`babysitter` WHERE `startTime` != '" . $startTime . "' AND `endTime` != '" . $endTime . "' GROUP BY `name`";
$stm = $pdo->prepare($sql);
$stm->execute([]);

foreach($stm as $row) {
	echo $row['name'] . "\n";
}
?>