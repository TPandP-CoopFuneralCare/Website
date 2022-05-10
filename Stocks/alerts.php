<?php

require('../functions.php');
// Checks if the user is logged in
initSession();
checkSession('../login.php', false);

?>

<!DOCTYPE html>
<html>

<head>
  <title>Admin</title>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <link rel="stylesheet" href="style.css" />
  <script src="alerts.js"></script>
</head>

<body>
  <?php

  echo buildNav();

  ?>
  <main>
    <h1>ALERTS</h1>
    <?php

    if (!isset($_GET['id'])) {
      $category = isset($_POST['category']) ? $_POST['category'] : null;
      $self = $_SERVER['PHP_SELF'];

      echo "<form id=\"chatCategories\" method=\"post\" action=\"$self\">
          <select name=\"category\" onchange='this.form.submit()'>
            <option value=\"All\">All</option>";
      echo getCategories($category);
      echo '
          </select>
        </form>';
    }


    if (getStocksRights()) {
      echo buildGridAllProducts(isset($_POST['category']) ? $_POST['category'] : null);
      echo '<h3>Product creation</h3>
    <form method="post" action="confirm.php" class="CreateProduct">
      <input type="text" placeholder="Name" name="name" required>
      <select name="category" id="" required>
        <option value="None">None</option>
        ' .
        getCategories($category)
        . '
      </select>
      <input type="number" placeholder="Amount" min="0" name="amount" required>
      <button>Create Product</button>
    </form>';
    }

    if (getAccountsRights()) {
      echo '<h3>People Management</h3>'
        . buildGridMembers() .
        '<h3>People Creation</h3>
      <form method="post" action="createMember.php" class="CreateProduct">
      <input type="text" placeholder="Username" name="username" required>
      <input type="password" placeholder="Password" name="password" required>
      <input type="text" placeholder="Firstname" name="firstname" required>
      <input type="text" placeholder="Lastname" name="lastname" required>
      <input type="text" placeholder="Job Title" name="jobtitle" required>
      <input type="checkbox" name="accounts"><label for="accounts">Access to Accounts</label>
      <input type="checkbox" name="stocks"><label for="stocks">Access to Stock Management</label>
      <button>Create Member</button>
    </form>
';
    }
    ?>

  </main>
</body>

</html>