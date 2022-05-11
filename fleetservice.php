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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="styleFleet.css">
  <title>Fleet</title>
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
        <input type="text" id="search" placeholder="Search..." name="search">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>
    <br><br><br><br><br><br>
    <a href="fleet.php">
      <button id="booking" style="margin-left:40%;"> Booking View </button>
    </a>
    <div class="row">
      <div class="column">
        <img src="fleet/hearse-1.webp" alt="Snow" style="width:100%">
        <a>Number of available Standard Hearse:</a> <br>
        <a>Currently in service Standard Hearse:</a> <br>
        <a>Service needed within 14 days Standard Hearse:</a> <br>
      </div>
      <div class="column">
        <img src="fleet/limousine-1.webp" alt="Forest" style="width:100%">
        <a>Number of available limousine:</a> <br>
        <a>Currently in service limousine:</a> <br>
        <a>Service needed within 14 days limousine:</a> <br>
      </div>
      <div class="column">
        <img src="fleet/executive-car-1.webp" alt="Mountains" style="width:100%">
        <a>Number of available executive car:</a> <br>
        <a>Currently in service executive car:</a> <br>
        <a>Service needed within 14 days executive car:</a> <br>
      </div>
    </div>

    <div class="row">
      <div class="column">
        <img src="fleet/horse-drawn-glass-hearse-2.webp" alt="Snow" style="width:100%">
        <a>Number of available horse drawn glass hearse:</a> <br>
        <a>Currently in service horse drawn glass hearse:</a> <br>
        <a>Service needed within 14 days horse drawn glass hearse:</a> <br>
      </div>
      <div class="column">
        <img src="fleet/land-rover-hearse-2.webp" alt="Forest" style="width:100%">
        <a>Number of available land rover hearse:</a> <br>
        <a>Currently in service land rover hearse:</a> <br>
        <a>Service needed within 14 days land rover hearse:</a> <br>
      </div>
      <div class="column">
        <img src="fleet/butterfly-hearse.webp" alt="Mountains" style="width:100%">
        <a>Number of available butterfly hearse:</a> <br>
        <a>Currently in service butterfly hearse:</a> <br>
        <a>Service needed within 14 days butterfly hearse:</a> <br>
      </div>
    </div>

    <div class="row">
      <div class="column">
        <img src="fleet/contemporary-vehicle-wrap-1.webp" alt="Snow" style="width:100%">
        <a>Number of available vehicle wrap:</a> <br>
        <a>Currently in service vehicle wrap:</a> <br>
        <a>Service needed within 14 days vehicle wrap:</a> <br>
      </div>
      <div class="column">
        <img src="fleet/poppy-hearse-1.webp" alt="Forest" style="width:100%">
        <a>Number of available poppy hearse:</a> <br>
        <a>Currently in service poppy hearse:</a> <br>
        <a>Service needed within 14 days poppy hearse:</a> <br>
      </div>
      <div class="column">
        <img src="fleet/bicycle-hearse-1.webp" alt="Mountains" style="width:100%">
        <a>Number of available bicycle hearse:</a> <br>
        <a>Currently in service bicycle hearse:</a> <br>
        <a>Service needed within 14 days bicycle hearse:</a> <br>
      </div>
    </div>
  </main>
</body>