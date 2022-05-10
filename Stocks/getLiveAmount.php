<?php

require('../functions.php');
// Checks if the user is logged in
initSession();
checkSession('../login.php', false);

$dbConn = getConnection();
$query = "SELECT amount FROM livestocks WHERE productID = :productid ";
$stmt = $dbConn->prepare($query);
$stmt->execute(array(':productid' => $_POST['productID']));


if ($item = $stmt->fetchObject()) {
  echo $item->amount;
}
