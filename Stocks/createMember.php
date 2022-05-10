<?php

require('../functions.php');
initSession();

if (isset($_POST['username'])) {

  $accounts = isset($_POST['accounts']) ? 1 : 0;
  $stocks = isset($_POST['stocks']) ? 1 : 0;
  $passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);

  try {
    $dbConn = getConnection();
    $query = "SELECT DISTINCT COUNT(username) as count FROM members WHERE username = :username";
    $stmt = $dbConn->prepare($query);
    $stmt->execute(array(':username' => $_POST['username']));
  } catch (Exception $e) {
    echo $e->getMessage();
  }



  if ($result = $stmt->fetchObject()->count == 0) {

    // adds the product to the productsDescription, livestocks, 
    // and creates a new chatroom, a new history for the product.
    // Also adds the first record to the history.

    try {
      $dbConn = getConnection();
      $query = "INSERT INTO members VALUES (null, :username, :firstname, :lastname, :jobTitle, :passwordHash, :canCreateAccounts, :canManageStocks);
    INSERT INTO actions VALUES (null, 9, :userid, NOW(), null)";
      $stmt = $dbConn->prepare($query);
      $stmt->execute(array(':username' => $_POST['username'], ':firstname' => $_POST['firstname'], ':lastname' => $_POST['lastname'], ':passwordHash' => $passwordHash, ':canCreateAccounts' => $accounts, ':canManageStocks' => $stocks, ':jobTitle' => $_POST['jobtitle'], 'userid' => $_SESSION['id']));
      header('Location: alerts.php');
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
}
?>
<h2>This username is already used by a member.</h2>
<form method="post" action="createMember.php" class="CreateProduct">
  <input type="text" placeholder="Username" name="username" value=<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?> required>
  <input type="password" placeholder="Password" name="password" value=<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?> required>
  <input type="text" placeholder="Firstname" name="firstname" value=<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : '' ?> required>
  <input type="text" placeholder="Lastname" name="lastname" value=<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : '' ?> required>
  <input type="text" placeholder="Job Title" name="jobtitle" value=<?php echo isset($_POST['jobtitle']) ? $_POST['jobtitle'] : '' ?> required>
  <input type="checkbox" name="accounts" <?php echo isset($_POST['accounts']) ? 'checked' : '' ?>><label for="accounts">Access to Accounts</label>
  <input type="checkbox" name="stocks" <?php echo isset($_POST['stocks']) ? 'checked' : '' ?>><label for="stocks">Access to Stock Management</label>
  <button>Create Member</button>
</form>
<a href="alerts.php"><button>Cancel</button></a>