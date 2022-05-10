<?php

require('../functions.php');
// Checks if the user is logged in
initSession();
checkSession('../login.php', false);


?>

<!DOCTYPE html>
<html>

<head>
  <title>Basket</title>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <script src="basket.js"></script>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <?php

  echo buildNav();

  ?>
  <main>
    <h1>PLANIFICATION BASKET</h1>
    <section id="basket">
      <div class="">
        <?php
        echo buildBasket();
        ?>
        <aside id="selectProduct" style=<?php echo isset($_GET['category']) ? "\"display:flex;\"" : "\"display:none;\""; ?> <div>
          <p>Category:</p>
          <select onchange="selectCategory(this)">
            <option value="All">All</option>
            <?php
            echo getCategories(isset($_GET['category']) ? $_GET['category'] : null);
            ?>
          </select>
          <p>Products:</p>
          <select id="productID">
            <?php
            echo getProducts(isset($_GET['category']) ? $_GET['category'] : null);
            ?>
          </select>
          <button onclick="addToBasket()">CONFIRM</button>
      </div>
      </aside>
      </div>
      <form action="basket.php" method="post">
        <button type="button" onclick="showSelection()" id="addToBasketButton">
          <img src=<?php echo isset($_GET['category']) ? "\"../Icons/close_black_24dp.svg\"" : "\"../Icons/add_black_24dp.svg\""; ?> id="addToBasketIcon">
          <?php echo isset($_GET['category']) ? "Cancel" : "Add to basket"; ?>
        </button>
      </form>
    </section>
  </main>
</body>

</html>