<?php

require('../functions.php');
initSession();

// Deletes all the information related to a member.

try {
  $dbConn = getConnection();
  $query = "DELETE FROM members WHERE user_id = :userid;
  INSERT INTO actions VALUES (null, 11, :actor, NOW(), :userid);";
  $stmt = $dbConn->prepare($query);
  $stmt->execute(array(':userid' => $_POST['userid'], ':actor' => $_SESSION['id']));
} catch (Exception $e) {
  echo "<li>$e->getMessage()</li>/n";
}
