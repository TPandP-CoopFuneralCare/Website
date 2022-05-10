<?php

require('../functions.php');
initSession();

if (isset($_POST['name'])) {
  $category = $_POST['category'] === 'None' ? null : $_POST['category'];
  $ChatroomName = str_replace(' ', '', $_POST['name']) . 'Chatroom';
  $HistoryName = str_replace(' ', '', $_POST['name']) . 'History';



  try {
    $dbConn = getConnection();
    $query = "SELECT DISTINCT COUNT(name) as count FROM productsDescription WHERE name = :name";
    $stmt = $dbConn->prepare($query);
    $stmt->execute(array(':name' => $_POST['name']));
  } catch (Exception $e) {
    echo $e->getMessage();
  }



  if ($result = $stmt->fetchObject()->count == 0) {

    // adds the product to the productsDescription, livestocks, 
    // and creates a new chatroom, a new history for the product.
    // Also adds the first record to the history.

    try {
      $dbConn = getConnection();
      $query = "INSERT INTO productsDescription VALUES (null, :name, :category, 1);
    INSERT INTO actions SELECT null, 1, :userid, NOW(), productID FROM productsDescription WHERE name = :name AND isActive = 1;
    INSERT INTO livestocks SELECT productsDescription.productID, productsDescription.productID, NOW(), :amount, :userid, actions.id FROM productsDescription JOIN actions ON actions.performedOn = productsDescription.ProductID WHERE name = :name AND isActive = 1;
    CREATE TABLE $ChatroomName (message_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, productID INT NOT NULL, sender INT NOT NULL, sentAt DATETIME, message TEXT, actionID INT);
    CREATE TABLE $HistoryName (id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, productID INT NOT NULL, updatedAt DATETIME, amount INT, updatedBy INT NOT NULL, actionID INT);
    INSERT INTO $HistoryName SELECT null, productsDescription.productID, NOW(), :amount, :userid, actions.id FROM productsDescription JOIN actions ON actions.performedOn = productsDescription.ProductID WHERE name = :name AND isActive = 1;";
      $stmt = $dbConn->prepare($query);
      $stmt->execute(array(':name' => $_POST['name'], ':category' => $category, ':amount' => $_POST['amount'], 'userid' => $_SESSION['id']));
      header('Location: alerts.php');
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
}
?>
<h2>This name is already used by an existing product.</h2>
<form method="post" action="confirm.php">
  <input type="text" name="name" value=<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>>
  <input type="text" name="category" value=<?php echo isset($_POST['category']) ? $_POST['category'] : 'Error! No category was found.' ?> readonly>
  <input type="number" min="0" name="amount" value=<?php echo isset($_POST['amount']) ? $_POST['amount'] : 'Error! No amount was found.' ?> readonly>
  <button>Create Product</button>
</form>
<a href="alerts.php"><button>Cancel</button></a>