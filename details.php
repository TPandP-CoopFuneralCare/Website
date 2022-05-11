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
    <title>Details</title>


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
            <form class="search" action="">
                <input type="text" placeholder="Search..." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <div class="details">
            <h1>Deceased Name: [Placeholder]</h1>
            <p>Unique ID: [Placeholder]</p>
            <p>Deceased Location: [Placeholder]</p>

        </div>
        <button type="button" class="collapsible">First Offices</button>
        <div class="content">
            <input type="checkbox" id="First Offices Completed" name="First Offices Completed" value="First Offices Completed">
            <label for="First Offices Completed"> First Offices Completed</label><br>
            <script>
                var coll = document.getElementsByClassName("collapsible");
                var i;

                for (i = 0; i < coll.length; i++) {
                    coll[i].addEventListener("click", function() {
                        this.classList.toggle("active");
                        var content = this.nextElementSibling;
                        if (content.style.display === "block") {
                            content.style.display = "none";
                        } else {
                            content.style.display = "block";
                        }
                    });
                }
            </script>
        </div>

        <button type="button" class="collapsible2">Coffin Preparation</button>
        <div class="content">
            <p>Name Plate</p>
            <p>Religion: [Placeholder]</p>
            <p>First Line: [Placeholder]</p>
            <p>Second Line: [Placeholder]</p>
            <p>Third Line: [Placeholder]</p>
            <p>Coffin Type: [Placeholder]</p>
            <p>Coffin Size: [Placeholder]</p>
            <p>Coffin Lining Type: [Placeholder]</p>
            <p>Coffin Lining Colour: [Placeholder]</p>
            <input type="checkbox" id="Coffin Completed" name="Coffin Completed" value="Coffin Completed">
            <label for="Coffin Completed">Coffin Completed</label><br>

            <script>
                var coll = document.getElementsByClassName("collapsible2");
                var i;

                for (i = 0; i < coll.length; i++) {
                    coll[i].addEventListener("click", function() {
                        this.classList.toggle("active");
                        var content = this.nextElementSibling;
                        if (content.style.display === "block") {
                            content.style.display = "none";
                        } else {
                            content.style.display = "block";
                        }
                    });
                }
            </script>
        </div>

        <button type="button" class="collapsible3">Care and Preparation</button>
        <div class="content">
            <input type="checkbox" id="First Offices Completed" name="First Offices Completed" value="First Offices Completed">
            <label for="First Offices Completed">First Offices Completed</label><br>
            <input type="checkbox" id="Embalming Completed" name="Embalming Completed" value="Embalming Completed">
            <label for="Embalming Completed ">Embalming Completed</label><br>
            <script>
                var coll = document.getElementsByClassName("collapsible3");
                var i;

                for (i = 0; i < coll.length; i++) {
                    coll[i].addEventListener("click", function() {
                        this.classList.toggle("active");
                        var content = this.nextElementSibling;
                        if (content.style.display === "block") {
                            content.style.display = "none";
                        } else {
                            content.style.display = "block";
                        }
                    });
                }
            </script>
        </div>

        <button type="button" class="collapsible4">Encoffining</button>
        <div class="content">
            <input type="checkbox" id="Deceased Dressed" name="Deceased Dressed" value="Deceased Dressed">
            <label for="Deceased Dressed">Deceased Dressed</label><br>
            <input type="checkbox" id="Deceased Placed in Chapel" name="Deceased Placed in Chapel" value="Deceased Placed in Chapel">
            <label for="Deceased Placed in Chapel">Deceased Placed in Chapel</label><br>
            <label for="locations">Choose a location:</label>
            <select name="locations" id="locations">
                <option value="chapel 1">Chapel 1</option>
                <option value="chapel 2">Chapel 2</option>
                <option value="chapel 3">Chapel 3</option>
                <option value="chapel 4">Chapel 4</option>
            </select>
            <script>
                var coll = document.getElementsByClassName("collapsible4");
                var i;

                for (i = 0; i < coll.length; i++) {
                    coll[i].addEventListener("click", function() {
                        this.classList.toggle("active");
                        var content = this.nextElementSibling;
                        if (content.style.display === "block") {
                            content.style.display = "none";
                        } else {
                            content.style.display = "block";
                        }
                    });
                }
            </script>
        </div>
    </main>
</body>