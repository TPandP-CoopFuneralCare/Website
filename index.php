<?php

require('functions.php');
// Checks if the user is logged in
initSession();
checkSession('login.php', false);


?>

<!doctype html>
<html>

<head>
  <title>Sentinel</title>
  <!-- <base href="http://coop-intranet.epizy.com/" target="_blank"> -->
  <link rel="stylesheet" href="Stocks/style.css" />
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

  ?>
  <main>
    <h1>Welcome to Sentinel</h1>
    <p>This is a new system for Coop funeral. Select a section to begin.</p>

  </main>
</body>

</html>