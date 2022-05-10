<?php

require('../functions.php');
initSession();

$category = $_POST['category'] === '' ? null : $_POST['category'];
$isActive = $_POST['isActive'] === 'true' ? 1 : 0;

// Updates the amount, category and activity of a specific product.
try {
  $dbConn = getConnection();
  $query = 'SELECT name FROM productsDescription WHERE ProductID = :productid;
  UPDATE livestocks SET amount = :newAmount WHERE productID = :productid;
  UPDATE productsDescription SET category = :category, isActive = :isactive WHERE productID = :productid;
  INSERT INTO actions VALUES (null, 2, :userid, NOW(), :productid);';
  $stmt = $dbConn->prepare($query);
  $stmt->execute(array(
    ':productid' => $_POST['productID'],
    ':newAmount' => $_POST['amount'],
    ':userid' => $_SESSION['id'],
    ':category' => $category,
    ':isactive' => $isActive
  ));
  if ($item = $stmt->fetchObject()) {
    $tableName = str_replace(' ', '', $item->name) . 'History';
    $query = "INSERT INTO $tableName VALUES (null, :productid, NOW(), :newAmount, :userid, null);";
    $stmt = $dbConn->prepare($query);
    $stmt->execute(array(
      ':productid' => $_POST['productID'],
      ':newAmount' => $_POST['amount'],
      ':userid' => $_SESSION['id']
    ));
  }
} catch (Exception $e) {
  echo "<li>$e->getMessage()</li>/n";
}
