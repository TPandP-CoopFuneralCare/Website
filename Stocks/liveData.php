<?php

require('../functions.php');
// Checks if the user is logged in
initSession();
checkSession('../login.php', false);

$labels = array();
$amounts = array();
$dbConn = getConnection();
if (isset($_POST['category']) && $_POST['category'] !== 'All') {
  $query = 'SELECT amount, name FROM productsDescription JOIN livestocks ON livestocks.productID = productsDescription.ProductID WHERE isActive=true AND category=:category';
  $stmt = $dbConn->prepare($query);
  $stmt->execute(array(':category' => $_POST['category']));
} else {
  $query = 'SELECT amount, name FROM productsDescription JOIN livestocks ON livestocks.productID = productsDescription.ProductID WHERE isActive=true';
  $stmt = $dbConn->prepare($query);
  $stmt->execute();
}

while ($item = $stmt->fetchObject()) {
  $labels[] = $item->name;
  $amounts[] = $item->amount;
}

echo json_encode(array("labels" => $labels, "amounts" => $amounts));
