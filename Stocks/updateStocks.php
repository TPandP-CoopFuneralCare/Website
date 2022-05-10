<?php

require('../functions.php');
initSession();


// Updates the number of elements for the specific product.
try {
  $dbConn = getConnection();
  $query = 'SELECT name FROM productsDescription WHERE ProductID = :productid;
  UPDATE livestocks SET amount = :newAmount WHERE productID = :productid;
  INSERT INTO actions VALUES (null, 2, :userid, NOW(), :productid);';
  $stmt = $dbConn->prepare($query);
  $stmt->execute(array(':productid' => $_POST['productID'], ':newAmount' => $_POST['amount'], ':userid' => $_SESSION['id']));
  if ($item = $stmt->fetchObject()) {
    $tableName = $item->name . 'History';
    $query = "INSERT INTO $tableName VALUES (null, :productid, NOW(), :newAmount, :userid, null);";
    $stmt = $dbConn->prepare($query);
    $stmt->execute(array(':productid' => $_POST['productID'], ':newAmount' => $_POST['amount'], ':userid' => $_SESSION['id']));
  }
} catch (Exception $e) {
  echo "<li>$e->getMessage()</li>/n";
}
