function selectCategory(selectElement) {
  window.location.assign(
    "alerts.php?category=" + selectElement.value.toString()
  );
}

function Update(productID) {
  if (productID !== "") {
    var category = document.getElementById(
      "Category" + productID.toString()
    ).value;
    var amount = document.getElementById("Amount" + productID.toString()).value;
    var isActive = document
      .getElementById("IsActive" + productID.toString())
      .checked.toString();
    $.post("updateProducts.php", {
      productID: productID,
      amount: amount,
      category: category,
      isActive: isActive,
    }).done(function () {
      location.assign("alerts.php");
    });
  }
}

function Delete(productID) {
  if (productID !== "") {
    var name = document.getElementById("Name" + productID.toString()).innerText;
    $.post("deleteProducts.php", {
      productID: productID,
      name: name,
    }).done(function () {
      location.assign("alerts.php");
    });
  }
}

function UpdateMembers(userID) {
  if (userID !== "") {
    var firstname = document.getElementById(
      "Firstname" + userID.toString()
    ).value;
    var lastname = document.getElementById(
      "Lastname" + userID.toString()
    ).value;
    var jobtitle = document.getElementById(
      "JobTitle" + userID.toString()
    ).value;
    var stocks = document
      .getElementById("Stocks" + userID.toString())
      .checked.toString();
    var accounts = document
      .getElementById("Accounts" + userID.toString())
      .checked.toString();

    console.log({
      userid: userID,
      firstname: firstname,
      lastname: lastname,
      jobtitle: jobtitle,
      accounts: accounts,
      stocks: stocks,
    });

    $.post("updateMembers.php", {
      userid: userID,
      firstname: firstname,
      lastname: lastname,
      jobtitle: jobtitle,
      accounts: accounts,
      stocks: stocks,
    }).done(function () {
      // location.assign("alerts.php");
    });
  }
}

function DeleteMembers(userID) {
  if (userID !== "") {
    $.post("deleteMembers.php", {
      userid: userID,
    }).done(function () {
      location.assign("alerts.php");
    });
  }
}
