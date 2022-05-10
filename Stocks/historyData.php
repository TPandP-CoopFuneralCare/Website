<?php

require('../functions.php');
// Checks if the user is logged in
initSession();
checkSession('../login.php', false);

$tableName = $_POST['name'] . 'History';

$labels = array();
$amounts = array();
$dbConn = getConnection();
$query = "SELECT CAST(updatedAt AS DATE) AS updatedAt, MAX(amount) AS amount FROM $tableName GROUP BY CAST(updatedAt AS DATE) ORDER BY updatedAt";
$stmt = $dbConn->prepare($query);
$stmt->execute();


while ($item = $stmt->fetchObject()) {
  $labels[] = $item->updatedAt;
  $amounts[] = $item->amount;
}

echo json_encode(array("labels" => $labels, "amounts" => $amounts));
