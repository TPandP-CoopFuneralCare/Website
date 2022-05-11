function selectCategory(selectElement) {
  window.location.assign(
    "index.php?category=" + selectElement.value.toString()
  );
}

function updateEditStock(productID) {
  $.post(
    "getLiveAmount.php",
    {
      productID: productID,
    },
    function (amount) {
      document.getElementById("editStock").innerText = amount.toString();
    }
  );
}

function selectLiveCategory() {
  // Updates the graph if a new product is selected
  var element = document.getElementById("liveCategory");
  if (element !== null) {
    var name = element.options[element.selectedIndex].text;
    $.post(
      "liveData.php",
      {
        category: name,
      },
      function (data) {
        jsonData = JSON.parse(data);
        liveChart.data.labels = jsonData["labels"];
        liveChart.data.datasets = [];
        liveChart.data.datasets.push({
          label: "Stocks",
          data: jsonData["amounts"].map(function (amount) {
            return parseInt(amount);
          }),
          backgroundColor: "rgb(1, 177, 221)",
        });

        liveChart.update();
      }
    );
  }
}

function selectProduct() {
  var selectElement = document.getElementById("productID");
  if (document.getElementById("productLabel") !== null) {
    // If the user does not have the Stock Management rights

    document.getElementById("productLabel").innerText =
      selectElement.options[selectElement.selectedIndex].text;
    document.getElementById("addStock").onclick = function () {
      add(selectElement.value);
    };
    document.getElementById("subtrackStock").onclick = function () {
      subtract(selectElement.value);
    };
    document.getElementById("editStock").onfocusout = function () {
      updateManualInput(selectElement.value);
    };
  } else {
    // If the user does have the Stock Management rights

    // Updates the graph if a new product is selected
    var element = document.getElementById("productID");
    if (element !== null) {
      var name = element.options[element.selectedIndex].text;
      $.post(
        "historyData.php",
        {
          name: name,
        },
        function (data) {
          jsonData = JSON.parse(data);
          historyChart.data.labels = jsonData["labels"];
          historyChart.data.datasets = [];
          historyChart.data.datasets.push({
            label: "Stocks",
            data: jsonData["amounts"].map(function (amount) {
              return parseInt(amount);
            }),
            borderColor: "rgb(1, 177, 221)",
          });

          historyChart.update();
        }
      );
    }
  }
}

function add(productID) {
  var label = document.getElementById("editStock");
  var newValue = parseInt(label.innerText) + 1;
  $.post(
    "updateStocks.php",
    {
      productID: productID,
      amount: newValue,
    },
    function () {
      updateEditStock(productID);
    }
  );
  return false;
}

function subtract(productID) {
  var label = document.getElementById("editStock");
  var newValue = Math.max(parseInt(label.innerText) - 1, 0);
  $.post(
    "updateStocks.php",
    {
      productID: productID,
      amount: newValue,
    },
    function () {
      updateEditStock(productID);
    }
  );
  return false;
}

function intOnly(e) {
  if (isNaN(String.fromCharCode(e.which))) e.preventDefault();
}

function updateManualInput(productID) {
  var label = document.getElementById("editStock");
  var newValue = parseInt(label.innerText);
  $.post(
    "updateStocks.php",
    {
      productID: productID,
      amount: newValue,
    },
    function () {
      updateEditStock(productID);
    }
  );
  return false;
}

function onStart() {
  $(".onlyInt").keypress(intOnly);
  selectProduct();
}

$(document).ready(onStart);
// window.addEventListener("resize", onResize);
