<?php

require('../functions.php');
initSession();

$ChatroomName = $_POST['name'] . 'Chatroom';
$HistoryName = $_POST['name'] . 'History';

// Deletes all the information related to a product.

try {
  $dbConn = getConnection();
  $query = "DELETE FROM productsDescription WHERE ProductID = :productid;
  DELETE FROM livestocks WHERE id = :productid;
  DROP TABLE $ChatroomName;
  DROP TABLE $HistoryName;
  INSERT INTO actions VALUES (null, 3, :userid, NOW(), :productid);";
  $stmt = $dbConn->prepare($query);
  $stmt->execute(array(':productid' => $_POST['productID'], ':userid' => $_SESSION['id']));
} catch (Exception $e) {
  echo "<li>$e->getMessage()</li>/n";
}
