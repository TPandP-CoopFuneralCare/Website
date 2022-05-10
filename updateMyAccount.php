<?php
require('./functions.php');
// Checks if the user is logged in
initSession();
checkSession('./login.php', false);

try {
  $dbConn = getConnection();

  if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['jobtitle']) && isset($_POST['password']) && $_POST['password'] !== '') {

    $passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $query = 'UPDATE members SET firstname = :firstname, lastname = :lastname, jobTitle = :jobtitle, passwordHash = :passwordhash WHERE user_id = :userid';
    $stmt = $dbConn->prepare($query);
    $stmt->execute(array(':userid' => $_SESSION['id'], ':firstname' => $_POST['firstname'], ':lastname' => $_POST['lastname'], ':jobtitle' => $_POST['jobtitle'], ':passwordhash' => $passwordHash));
  } elseif (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['jobtitle']) && isset($_POST['password']) && $_POST['password'] === '') {

    $query = 'UPDATE members SET firstname = :firstname, lastname = :lastname, jobTitle = :jobtitle WHERE user_id = :userid';
    $stmt = $dbConn->prepare($query);
    $stmt->execute(array(':userid' => $_SESSION['id'], ':firstname' => $_POST['firstname'], ':lastname' => $_POST['lastname'], ':jobtitle' => $_POST['jobtitle']));
  }
} catch (Exception $e) {
  echo $e->getMessage();
}

header('Location: account.php');
