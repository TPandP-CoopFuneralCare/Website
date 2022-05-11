<?php

require('./functions.php');
// Checks if the user is logged in
initSession();
checkSession('./login.php', false);

?>

<!DOCTYPE html>
<html>

<head>
  <title>Account</title>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <link rel="stylesheet" href="Stocks/style.css" />
  <!-- <script src="alerts.js"></script> -->
</head>

<body>
  <?php

  if (getStocksRights() || getAccountsRights()) {
    echo '<nav>
<img src="./coop-logo.png" alt="Coop logo" id="logo" />
<ul>
  <li id="">
    <a href="">
      <img src="./Icons/funeral_arrangements.svg" alt="Funeral icon" />
      <label>Funeral Arrangements</label>
    </a>
  </li>
  <li id="">
    <a href="./care.php">
      <img src="./Icons/care_and_prep.svg" alt="Care and prep icon" />
      <label>Care and Preparation</label>
    </a>
  </li>
  <li id="">
    <a href="">
      <img src="./Icons/timetable.svg" alt="Timetable icon" />
      <label>Timetable</label>
    </a>
  </li>
  <li id="">
    <a href="./fleet.php">
      <img src="./Icons/fleet.svg" alt="Fleet icon" />
      <label>Fleet</label>
    </a>
  </li>
  
    <li id="">
      <a href="./Stocks/index.php">
        <img src="./Icons/box.png" alt="Stocks icon" />
        <label>Stocks</label>
      </a>

      <ul id="stocks">
        <a href="./Stocks/conversation.php"><li>Conversations</li></a>
        <a href="./Stocks/alerts.php"><li>Admin</li></a>
        <a href="./Stocks/basket.php"><li>Basket</li></a>
      </ul>
    </li>
</ul>
<a href="./account.php" id="account">
  <img src="./Icons/account_circle_FILL0_wght400_GRAD0_opsz48.svg" alt="Account icon" />
  <label>Account</label>
</a>
</nav>';
  } else {
    echo '<nav>
<img src="./coop-logo.png" alt="Coop logo" id="logo" />
<ul>
  <li id="">
    <a href="">
      <img src="./Icons/funeral_arrangements.svg" alt="Funeral icon" />
      <label>Funeral Arrangements</label>
    </a>
  </li>
  <li id="">
    <a href="./care.php">
      <img src="./Icons/care_and_prep.svg" alt="Care and prep icon" />
      <label>Care and Preparation</label>
    </a>
  </li>
  <li id="">
    <a href="">
      <img src="./Icons/timetable.svg" alt="Timetable icon" />
      <label>Timetable</label>
    </a>
  </li>
  <li id="">
    <a href="./fleet.php">
      <img src="./Icons/fleet.svg" alt="Fleet icon" />
      <label>Fleet</label>
    </a>
  </li>    
  <li id="">
    <a href="./Stocks/index.php">
      <img src="./Icons/box.png" alt="Stocks icon" />
      <label>Stocks</label>
    </a>

    <ul id="stocks">
      <a href="./Stocks/conversation.php"><li>Conversations</li></a>
    </ul>
  </li>
</ul>
<a href="./account.php" id="account">
  <img src="./Icons/account_circle_FILL0_wght400_GRAD0_opsz48.svg" alt="Account icon" />
  <label>Account</label>
</a>
</nav>';
  }


  function getInfo($item, $key)
  {
    return isset($item) ? $item->$key : null;
  }

  $result = '';
  try {
    $dbConn = getConnection();
    $query = 'SELECT username, firstname, lastname, jobTitle FROM members WHERE user_id = :userid';
    $stmt = $dbConn->prepare($query);
    $stmt->execute(array(':userid' => $_SESSION['id']));
    $item = $stmt->fetchObject();
  } catch (Exception $e) {
    echo $e->getMessage();
  }

  ?>
  <main>
    <h1>Account</h1>
    <form action="updateMyAccount.php" method="post" id="accountForm">
      <label for="_username">Username</label>
      <input type="text" value=<?php echo getInfo($item, 'username') ?> id="_username" readonly>
      <label for="_firstname">Firstname</label>
      <input type="text" value=<?php echo getInfo($item, 'firstname') ?> name="firstname" id="_firstname">
      <label for="_lastname">Lastname</label>
      <input type="text" value=<?php echo getInfo($item, 'lastname') ?> name="lastname" id="_lastname">
      <label for="_jobtitle">Job Title</label>
      <input type="text" value=<?php echo getInfo($item, 'jobTitle') ?> name="jobtitle" id="_jobtitle">
      <label for="_password">Password</label>
      <input type="password" name="password" id="_password">
      <button>Update</button>
    </form>
    <a href="logout.php" id="logoutButton">
      <button>Log out</button>
    </a>
  </main>
</body>

</html>