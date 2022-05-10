<?php

require('../functions.php');
initSession();

$accounts = $_POST['accounts'] === 'true' ? 1 : 0;
$stocks = $_POST['stocks'] == 'true' ? 1 : 0;

// Updates the information of a specific member.
try {
  $dbConn = getConnection();
  $query = 'UPDATE members SET firstname = :firstname, lastname = :lastname, jobTitle = :jobtitle, canManageStocks = :stocks, canCreateAccounts = :accounts WHERE user_id = :userid;
  INSERT INTO actions VALUES (null, 10, :actor, NOW(), null);';
  $stmt = $dbConn->prepare($query);
  $stmt->execute(array(
    ':firstname' => $_POST['firstname'],
    ':lastname' => $_POST['lastname'],
    ':jobtitle' => $_POST['jobtitle'],
    ':stocks' => $stocks,
    ':accounts' => $accounts,
    ':userid' => $_POST['userid'],
    ':actor' => $_SESSION['id'],
  ));
} catch (Exception $e) {
  echo "<li>$e->getMessage()</li>/n";
}
