<?php

require('../functions.php');
// Checks if the user is logged in
initSession();
checkSession('../login.php', false);


?>

<!DOCTYPE html>
<html>

<head>
  <title>Dashboard</title>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  <script src="index.js"></script>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <?php

  echo buildNav();

  ?>
  <main>
    <h1>DASHBOARD</h1>
    <section class="dashboardRow">
      <!-- Recent Comments Section -->

      <div>
        <h2>Recent comments</h2>
        <ul id="comments">

          <?php
          echo getRecentComments();
          ?>

        </ul>
      </div>

      <!-- Live Stocks Section -->

      <div id="live">
        <h2>Live Stocks</h2>
        <select id="liveCategory" onchange="selectLiveCategory()">
          <option value="All">All</option>
          <?php
          echo getCategories(null);
          ?>
        </select>
        <div id="liveChartParent"><canvas id="liveChart"></canvas></div>
      </div>
    </section>

    <!-- Category Selection -->

    <section class="dashboardRow">
      <div id="selectHistory">
        <label>Category: </label>
        <select onchange="selectCategory(this)">
          <option value="All">All</option>
          <?php
          echo getLiveCategories(isset($_GET['category']) ? $_GET['category'] : null);
          ?>
        </select>
        <label>Products:</label>
        <select id="productID" onchange="selectProduct()">
          <?php
          echo getExistingProducts(isset($_GET['category']) ? $_GET['category'] : null);
          ?>
        </select>
      </div>

      <?php

      // If the user does not have the rights to manage stocks
      $stocksRights = getStocksRights();

      if (!$stocksRights) {
        echo "
        <div id=\"updateStocks\">
			<div class=\"top\">
				<label id=\"productLabel\">Select a product</label>
			</div>
			<div id=\"amount\">
				<button id=\"addStock\" onclick=\"\">
					<img src=\"../Icons/add_black_24dp.svg\">
				</button>
				<label id=\"editStock\" class=\"onlyInt\" onfocusout=\"\" contenteditable>0</label>
				<button id=\"subtrackStock\" onclick=\"\">
					<img src=\"../Icons/remove_black_24dp.svg\">
				</button>
			</div>
		</div>";
      } else {
        echo "
          <!-- History chart -->

          <div id=\"historyChartParent\"><canvas id=\"historyChart\"></canvas></div>";
      }

      ?>


    </section>
  </main>
</body>
<script>
  // Handles the display of the charts
  var liveChartElement = document.getElementById('liveChart').getContext('2d');
  var historyChartElement = document.getElementById('historyChart').getContext('2d');

  // Needs to retrieve the data from livestocks
  var liveChart;
  var liveData = {
    'labels': [],
    'amounts': []
  };

  function onReceiveLive(data) {
    jsonData = JSON.parse(data);
    liveChart.data.labels = jsonData["labels"];
    liveChart.data.datasets.push({
      label: 'Stocks',
      data: jsonData["amounts"].map(function(amount) {
        return parseInt(amount);
      })
    });

    liveChart.update()
  }

  var liveCategory = document.getElementById('liveCategory').value;
  $.post('liveData.php', {
    category: liveCategory
  }, onReceiveLive);


  // puts the data into the live chart
  liveChart = new Chart(liveChartElement, {
    type: 'bar',
  });

  // Needs to retrieve the data from the history
  var historyChart;
  var historyData = {
    'labels': [],
    'amounts': []
  };

  function onReceiveHistory(data) {
    console.log(data);
    jsonData = JSON.parse(data);
    historyChart.data.labels = jsonData["labels"];
    historyChart.data.datasets.push({
      label: 'Stocks',
      data: jsonData["amounts"].map(function(amount) {
        return parseInt(amount);
      })
    });

    historyChart.update()
  }

  var element = document.getElementById('productID');
  var name = element.options[element.selectedIndex].text;
  if (productID !== undefined && productID !== null && productID !== '') {
    $.post('historyData.php', {
      name: name
    }, onReceiveHistory);
  }

  // puts the data into the history chart
  historyChart = new Chart(historyChartElement, {
    type: 'line',
  });
</script>

</html>