<?php

require('functions.php');
// Checks if the user is logged in
initSession();
checkSession('login.php', false);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styleCare.css">
  <title>Sentinel Homepage</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
    <div class="search_position">
      <form class="search" action="action_page.php">
        <input type="text" placeholder="Search..." name="search">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>
    <div class="h3">
      <h3>Deceased awaiting transfer</h3>
    </div>
    <div class="grid-container">
      <div class="grid-item1">
        <p>Deceased Name: [Placeholder]</p>
        <p>Age: [Placeholder]</p>
        <p>Date of Death: [Placeholder]</p>
        <p>Current Location: [Placeholder]</p>
        <p>Transfer Location: [Placeholder]</p>
        <p>Unique ID:</p>
        <button onclick="document.location='DeceasedDetails.php'">Open...</button>
      </div>
      <div class="grid-item2">
        <p>Deceased Name: [Placeholder]</p>
        <p>Age: [Placeholder]</p>
        <p>Date of Death: [Placeholder]</p>
        <p>Current Location: [Placeholder]</p>
        <p>Transfer Location: [Placeholder]</p>
        <p>Unique ID: [Placeholder]</p>
        <button type="button">Open...</button>
      </div>
      <div class="grid-item3">
        <p>Deceased Name: [Placeholder]</p>
        <p>Age: [Placeholder]</p>
        <p>Date of Death: [Placeholder]</p>
        <p>Current Location: [Placeholder]</p>
        <p>Transfer Location: [Placeholder]</p>
        <p>Unique ID: [Placeholder]</p>
        <button type="button">Open...</button>
      </div>
    </div>
    <div class="h">
      <h3>Deceased in Branch Awaiting Care and Preparation</h3>
    </div>
    <div class="grid-container2">
      <div class="grid-item4">
        <p>Deceased Name: [Placeholder]</p>
        <p>Age: [Placeholder]</p>
        <p>Date of Death: [Placeholder]</p>
        <p>Date of Funeral: [Placeholder]</p>
        <p>Current Location: [Placeholder]</p>
        <p>Unique ID: [Placeholder]</p>
        <button type="button">Open...</button>
      </div>
      <div class="grid-item5">
        <p>Deceased Name: [Placeholder]</p>
        <p>Age: [Placeholder]</p>
        <p>Date of Death: [Placeholder]</p>
        <p>Date of Funeral: [Placeholder]</p>
        <p>Current Location: [Placeholder]</p>
        <p>Unique ID: [Placeholder]</p>
        <button type="button">Open...</button>
      </div>
      <div class="grid-item6">
        <p>Deceased Name: [Placeholder]</p>
        <p>Age: [Placeholder]</p>
        <p>Date of Death: [Placeholder]</p>
        <p>Date of Funeral: [Placeholder]</p>
        <p>Current Location: [Placeholder]</p>
        <p>Unique ID: [Placeholder]</p>
        <button type="button">Open...</button>
      </div>
    </div>
    <div class="h">
      <h3>Coffins Awaiting Creation</h3>
    </div>
    <div class="grid-container2">
      <div class="grid-item7">
        <p>Deceased Name: [Placeholder]</p>
        <p>Age: [Placeholder]</p>
        <p>Date of Death: [Placeholder]</p>
        <p>Current Location: [Placeholder]</p>
        <p>Coffin in Stock: [Placeholder]</p>
        <p>Unique ID: [Placeholder]</p>
        <button type="button">Open...</button>
      </div>
      <div class="grid-item8">
        <p>Deceased Name: [Placeholder]</p>
        <p>Age: [Placeholder]</p>
        <p>Date of Death: [Placeholder]</p>
        <p>Current Location: [Placeholder]</p>
        <p>Coffin in Stock: [Placeholder]</p>
        <p>Unique ID: [Placeholder]</p>
        <button type="button">Open...</button>
      </div>
      <div class="grid-item9">
        <p>Deceased Name: [Placeholder]</p>
        <p>Age: [Placeholder]</p>
        <p>Date of Death: [Placeholder]</p>
        <p>Current Location: [Placeholder]</p>
        <p>Coffin in Stock: [Placeholder]</p>
        <p>Unique ID: [Placeholder]</p>
        <button type="button">Open...</button>
      </div>
    </div>
  </main>
</body>



<?php
