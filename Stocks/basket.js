//

function showSelection() {
  element = document.getElementById("selectProduct");
  displaySelection = window
    .getComputedStyle(element)
    .getPropertyValue("display");

  switch (displaySelection) {
    case "none":
      element.style.display = "flex";
      document.getElementById("addToBasketButton").innerHTML =
        '<img src="../Icons/close_black_24dp.svg" id="addToBasketIcon">Cancel';
      break;

    case "flex":
      element.style.display = "none";
      document.getElementById("addToBasketButton").innerHTML =
        '<img src="../Icons/add_black_24dp.svg" id="addToBasketIcon">Add to basket';
      break;

    default:
      console.log(
        "Wrong display property concerning element with id: selectProduct."
      );
  }
}

function add(productID) {
  var label = document.getElementById("amount" + productID.toString());
  var newValue = parseInt(label.innerText) + 1;
  label.innerText = newValue;
  $.post("updateBasket.php", {
    update: productID,
    amount: newValue,
  });
  return false;
}

function subtract(productID) {
  var label = document.getElementById("amount" + productID.toString());
  var newValue = Math.max(parseInt(label.innerText) - 1, 0);
  label.innerText = newValue;
  $.post("updateBasket.php", {
    update: productID,
    amount: newValue,
  });
  return false;
}

function remove(productID) {
  $.post("updateBasket.php", {
    remove: productID,
  }).done(function () {
    location.assign("basket.php");
  });
  return false;
}

function addToBasket() {
  var productID = document.getElementById("productID").value;
  if (productID !== "") {
    $.post("updateBasket.php", {
      create: productID,
    }).done(function () {
      location.assign("basket.php");
    });
  }
  return false;
}

function intOnly(e) {
  if (isNaN(String.fromCharCode(e.which))) e.preventDefault();
}

function updateManualInput(productID) {
  var label = document.getElementById("amount" + productID.toString());
  var newValue = parseInt(label.innerText);
  $.post("updateBasket.php", {
    update: productID,
    amount: newValue,
  });
  return false;
}

$(document).ready(function () {
  $(".onlyInt").keypress(intOnly);
});

function selectCategory(selectElement) {
  window.location.assign(
    "basket.php?category=" + selectElement.value.toString()
  );
}
