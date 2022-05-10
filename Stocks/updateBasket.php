<?php

require('../functions.php');
initSession();

// Deletes product from the basket
if (isset($_POST['remove'])) {
  try {
    $dbConn = getConnection();
    $query = 'DELETE FROM basket WHERE ProductID = :productid; INSERT INTO actions VALUES (null, 6, :userid, NOW(), :productid);';
    $stmt = $dbConn->prepare($query);
    $stmt->execute(array(':productid' => $_POST['remove'], ':userid' => $_SESSION['id']));
  } catch (Exception $e) {
    echo "<li>$e->getMessage()</li>/n";
  }
} elseif (isset($_POST['create'])) {
  try {
    $dbConn = getConnection();
    $query = 'INSERT INTO basket VALUES (:productid, :productid, 0, 0); INSERT INTO actions SELECT null, 4, :userid, NOW(), basket.id FROM basket WHERE ProductID = :productid; UPDATE basket INNER JOIN actions ON actions.performedOn = basket.id SET actionID = actions.id WHERE basket.ProductID = :productid';
    $stmt = $dbConn->prepare($query);
    $stmt->execute(array(':productid' => $_POST['create'], ':userid' => $_SESSION['id']));
  } catch (Exception $e) {
    echo "<li>$e->getMessage()</li>/n";
  }
} elseif (isset($_POST['update']) && isset($_POST['amount'])) {
  // Updates the number of elements in the basket
  try {
    $dbConn = getConnection();
    $query = 'UPDATE basket SET amount = :newAmount WHERE ProductID = :productid; INSERT INTO actions VALUES (null, 5, :userid, NOW(), :productid);';
    $stmt = $dbConn->prepare($query);
    $stmt->execute(array(':productid' => $_POST['update'], ':newAmount' => $_POST['amount'], ':userid' => $_SESSION['id']));
  } catch (Exception $e) {
    echo "<li>$e->getMessage()</li>/n";
  }
}
