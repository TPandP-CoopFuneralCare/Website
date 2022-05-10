<?php

function getConnection()
{
	$connection = new PDO(
		"mysql:host=sql104.epizy.com;
				   dbname=epiz_31524034_Coop",
		"epiz_31524034",
		"qqO5X7csn2rwy"
	);


	return $connection;
}

// Login Functions

function initSession()
{
	ini_set("session.save_path", "/home/vol1000_5/epizy.com/epiz_31524034/htdocs/sessionData");
	ob_start();
	session_start();
}

// Checks whether the user is logged-in and redirects the page
// depending on the given boolean.

function checkSession($address, $bool)
{
	$loggedIn = isset($_SESSION['logged-in']) ? $_SESSION['logged-in'] : false;

	if ($loggedIn === $bool) {
		header("Location: $address");
	}
}

function setSession($key, $value)
{
	$_SESSION[$key] = $value;
	return true;
}

function validateLogon()
{

	$errors = [];
	$input = [];

	$username = filter_has_var(INPUT_POST, 'uname') ? trim($_POST['uname']) : null;
	$password = filter_has_var(INPUT_POST, 'psw') ? trim($_POST['psw']) : null;

	array_push($input, $username, $password);

	try {
		$dbConn = getConnection();

		$query = 'SELECT user_id, passwordHash, firstname, lastname, canCreateAccounts, canManageStocks FROM members WHERE username = :username';
		$stmt = $dbConn->prepare($query);
		$stmt->execute(array(':username' => $username));
		$user = $stmt->fetchObject();
		if ($username != null && $password != null) {
			if ($user) {
				$user->passwordHash = filter_var($user->passwordHash, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
				$user->passwordHash = filter_var($user->passwordHash, FILTER_SANITIZE_SPECIAL_CHARS);

				$user->firstname = filter_var($user->firstname, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
				$user->firstname = filter_var($user->firstname, FILTER_SANITIZE_SPECIAL_CHARS);

				$user->surname = filter_var($user->surname, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
				$user->surname = filter_var($user->surname, FILTER_SANITIZE_SPECIAL_CHARS);

				$passwordHash = $user->passwordHash;
				$isVerified = password_verify($password, $passwordHash);
				if ($isVerified) {
					setSession('firstname', $user->firstname);
					setSession('lastname', $user->lastname);
					setSession('id', $user->user_id);
					setSession('logged-in', true);
				} else {
					array_push($errors, 'Wrong password.');
				}
			} else {
				array_push($errors, 'This username doesn\'t exist.');
			}
		}
	} catch (Exception $e) {
		array_push($errors, $e->getMessage());
	}

	return array($input, $errors);
}

function showErrors($errors)
{
	$result = '';
	foreach ($errors as $element) {
		$result .= "<p>$element</p>\n";
	}
	return $result;
}

// Returns the canManageStocks variable of the current user

function getStocksRights()
{
	try {
		$dbConn = getConnection();
		$query = 'SELECT canManageStocks FROM members WHERE user_id=:userid';
		$stmt = $dbConn->prepare($query);
		$stmt->execute(array(':userid' => $_SESSION['id']));
		if ($right = $stmt->fetchObject()) {
			return $right->canManageStocks;
		} else {
			return false;
		}
	} catch (Exception $e) {
		echo $e->getMessage();
		return false;
	}
}

// Returns the canCreateAccounts variable of the current user

function getAccountsRights()
{
	try {
		$dbConn = getConnection();
		$query = 'SELECT canCreateAccounts FROM members WHERE user_id=:userid';
		$stmt = $dbConn->prepare($query);
		$stmt->execute(array(':userid' => $_SESSION['id']));
		if ($right = $stmt->fetchObject()) {
			return $right->canCreateAccounts;
		} else {
			return false;
		}
	} catch (Exception $e) {
		echo $e->getMessage();
		return false;
	}
}

// General display functions

function buildNav()
{
	if (getStocksRights() || getAccountsRights()) {
		return '<nav>
    <img src="../coop-logo.png" alt="Coop logo" id="logo" />
    <ul>
      <li id="">
        <img src="" alt="Funeral icon" />
        <label>Funeral Arrangements</label>
      </li>
      <li id="">
        <img src="" alt="Care and prep icon" />
        <label>Care and Preparation</label>
      </li>
      <li id="">
        <img src="" alt="Timetable image" />
        <label>Timetable</label>
      </li>
      <li id="">
        <img src="" alt="Fleet image" />
        <label>Fleet</label>
      </li>
      
        <li id="">
					<a href="./index.php">
						<img src="../Icons/box.png" alt="Stocks icon" />
						<label>Stocks</label>
					</a>

					<ul id="stocks">
						<a href="./conversation.php"><li>Conversations</li></a>
						<a href="./alerts.php"><li>Admin</li></a>
						<a href="./basket.php"><li>Basket</li></a>
					</ul>
        </li>
    </ul>
    <a href="../account.php" id="account">
						<img src="../Icons/account_circle_FILL0_wght400_GRAD0_opsz48.svg" alt="Account icon" />
						<label>Account</label>
					</a>
  </nav>';
	} else {
		return '<nav>
    <img src="../coop-logo.png" alt="Coop logo" id="logo" />
    <ul>
      <li id="">
        <img src="" alt="Funeral icon" />
        <label>Funeral Arrangements</label>
      </li>
      <li id="">
        <img src="" alt="Care and prep icon" />
        <label>Care and Preparation</label>
      </li>
      <li id="">
        <img src="" alt="Timetable image" />
        <label>Timetable</label>
      </li>
      <li id="">
        <img src="" alt="Fleet image" />
        <label>Fleet</label>
      </li>
      
        <li id="">
					<a href="./index.php">
						<img src="../Icons/box.png" alt="Stocks icon" />
						<label>Stocks</label>
					</a>

					<ul id="stocks">
						<a href="./conversation.php"><li>Conversations</li></a>
					</ul>
        </li>
    </ul>
    <a href="../account.php" id="account">
						<img src="../Icons/account_circle_FILL0_wght400_GRAD0_opsz48.svg" alt="Account icon" />
						<label>Account</label>
					</a>
  </nav>';
	}
}

// Dashboard functions

function getCommentDescription($dbConn, $comment)
{
	switch ($comment->actionType) {

			// Product creation
		case 1:
			try {
				$query = 'SELECT name FROM productsDescription where ProductID = :product';
				$stmt = $dbConn->prepare($query);
				$stmt->execute(array(':product' => $comment->performedOn));
				if ($product = $stmt->fetchObject()) {
					return "$product->name has been created.";
				} else {
					return "A product has been created.";
				}
			} catch (Exception $e) {
				return $e->getMessage();
			}
			break;

			// Product update
		case 2:
			try {
				$query = 'SELECT name FROM productsDescription where ProductID = :product';
				$stmt = $dbConn->prepare($query);
				$stmt->execute(array(':product' => $comment->performedOn));
				if ($product = $stmt->fetchObject()) {
					return "$product->name has been updated.";
				} else {
					return "A product has been updated.";
				}
			} catch (Exception $e) {
				return $e->getMessage();
			}
			break;

			// Product deletion
		case 3:
			try {
				$query = 'SELECT name FROM productsDescription where ProductID = :product';
				$stmt = $dbConn->prepare($query);
				$stmt->execute(array(':product' => $comment->performedOn));
				if ($product = $stmt->fetchObject()) {
					return "$product->name has been deleted.";
				} else {
					return "A product has been deleted.";
				}
			} catch (Exception $e) {
				return $e->getMessage();
			}
			break;

			// Addition to Basket
		case 4:
			try {
				$query = 'SELECT name, id, isActive FROM productsDescription JOIN basket on basket.ProductID = productsDescription.ProductID where isActive = 1 and id = :basketid';
				$stmt = $dbConn->prepare($query);
				$stmt->execute(array(':basketid' => $comment->performedOn));
				if ($row = $stmt->fetchObject()) {
					$product = $row->name;
					return "$product has been added to the basket.";
				} else {
					return "A product has been added to the basket.";
				}
			} catch (Exception $e) {
				return $e->getMessage();
			}
			break;

			// Basket Update
		case 5:
			try {
				$query = 'SELECT name, amount, actionID, isActive FROM productsDescription JOIN basket on basket.ProductID = productsDescription.ProductID where isActive = 1 and actionID = :actionid';
				$stmt = $dbConn->prepare($query);
				$stmt->execute(array(':actionid' => $comment->id));
				if ($row = $stmt->fetchObject()) {
					$product = $row->name;
					$amount = $row->amount;
					return "The new amount of $product in the basket is $amount.";
				} else {
					try {
						$query = 'SELECT name, id, isActive FROM productsDescription JOIN basket on basket.ProductID = productsDescription.ProductID where isActive = 1 and id = :basketid';
						$stmt = $dbConn->prepare($query);
						$stmt->execute(array(':basketid' => $comment->performedOn));
						if ($row = $stmt->fetchObject()) {
							$product = $row->name;
							return "The amount of $product in the basket has been updated.";
						} else {
							return "A product has been updated in the basket.";
						}
					} catch (Exception $e) {
						return $e->getMessage();
					}
				}
			} catch (Exception $e) {
				return $e->getMessage();
			}
			break;

			// Element deletion from basket
		case 6:
			return "A product has been deleted from the basket.";
			break;

			// Empty basket
		case 7:
			return "The basket has been emptied.";
			break;

			// Sent Comment
		case 8:
			try {
				$query1 = 'SELECT name FROM productsDescription WHERE ProductID = :productid';
				$stmt1 = $dbConn->prepare($query1);
				$stmt1->execute(array(':productid' => $comment->performedOn));
				if ($row1 = $stmt1->fetchObject()) {
					$tableName = $row1->name . 'Chatroom';
					$query2 = "SELECT message FROM $tableName WHERE actionID = :actionid";
					$stmt = $dbConn->prepare($query2);
					$stmt->execute(array(':actionid' => $comment->id));
					if ($row2 = $stmt->fetchObject()) {
						return $row2->message;
					} else {
						return "Sent a message.";
					}
				} else {
					return 'Sent a message';
				}
			} catch (Exception $e) {
				return $e->getMessage();
			}
			break;
	}
}

function getTimeLabel($messageDate)
{
	$timeLabel = '';
	// age of the action in days
	$timeDifference = strtotime((date("Y-m-d h:i:sa"))) - $messageDate;
	$daysDifference = floor($timeDifference / (60 * 60 * 24));
	if ($daysDifference < 0) {
		$timeLabel = date("Y.m.d h:i:sa", $messageDate);
	} else if ($daysDifference == 0) {
		$hoursDifference = floor($timeDifference / (60 * 60));
		if ($hoursDifference == 0) {
			$minutesDifference = floor($timeDifference / 60);
			$timeLabel = "$minutesDifference minutes ago";
		} else {
			$timeLabel = "$hoursDifference hours ago";
		}
	} else if ($daysDifference == 1) {
		$timeLabel = 'Yesterday';
	} else if ($daysDifference < 7) {
		$timeLabel = date("l", $messageDate);
	} else {
		$timeLabel = "$daysDifference days ago";
	}
	return $timeLabel;
}

function getRecentComments()
{
	$result = '';
	try {
		$dbConn = getConnection();
		$query = 'SELECT id, firstname, lastname, jobTitle, performedAt, performedOn, actionType FROM actions JOIN members ON members.user_id = actions.userId WHERE actionType NOT IN (9,10,11) ORDER BY performedAt DESC LIMIT 3';
		$stmt = $dbConn->prepare($query);
		$stmt->execute();
		while ($comment = $stmt->fetchObject()) {
			$messageDate = strtotime($comment->performedAt);
			$timeLabel = getTimeLabel($messageDate);

			$commentDescription = getCommentDescription($dbConn, $comment);

			$result .= "<li class=\"description\">
              <div class=\"top\">
                <h4>$comment->firstname $comment->lastname - $comment->jobTitle</h4>
                <label>$timeLabel</label>
              </div>
              <p>$commentDescription</p>
          </li>";
		}
	} catch (Exception $e) {
		$result .= "<li>$e->getMessage()</li>/n";
	}

	return $result;
}

function getCategories($selected)
{

	try {
		$dbConn = getConnection();
		$query = 'SELECT DISTINCT category FROM productsDescription WHERE category IS NOT NULL';
		$stmt = $dbConn->prepare($query);
		$stmt->execute();
		$result = '';
		while ($row = $stmt->fetchObject()) {
			$selectedAttribute = isset($selected) && $row->category === $selected ? 'selected' : '';
			$result .= "<option value=\"$row->category\" $selectedAttribute>$row->category</option>";
		}

		return $result;
	} catch (Exception $e) {
		return $e->getMessage();
	}
}

function getLiveCategories($selected)
{

	try {
		$dbConn = getConnection();
		$query = 'SELECT DISTINCT category FROM productsDescription JOIN livestocks ON livestocks.productID = productsDescription.ProductID WHERE category IS NOT NULL';
		$stmt = $dbConn->prepare($query);
		$stmt->execute();
		$result = '';
		while ($row = $stmt->fetchObject()) {
			$selectedAttribute = isset($selected) && $row->category === $selected ? 'selected' : '';
			$result .= "<option value=\"$row->category\" $selectedAttribute>$row->category</option>";
		}
		return $result;
	} catch (Exception $e) {
		return $e->getMessage();
	}
}

// Chat related functions

function buildConversations()
{
	$result = '<section id="chatrooms">';
	try {
		$dbConn = getConnection();
		$query = 'SELECT ProductID, name FROM productsDescription WHERE isActive = true';
		$stmt = $dbConn->prepare($query);
		$stmt->execute();
		while ($comment = $stmt->fetchObject()) {

			$result .= "<a href=\"conversation.php?id=$comment->ProductID\" class=\"chatroom\"><h4>Chatroom for $comment->name</h4></a>";
		}
	} catch (Exception $e) {
		$result .= "<p>$e->getMessage()</p>/n";
	}

	$result .= '</section>';
	return $result;
}

function buildChatbox($productID)
{
	$text = isset($_COOKIE['message' . $productID]) ? $_COOKIE['message' . $productID] : '';
	return "<section id=\"chatbox\">
	<form action=\"conversation.php?id=$productID\" method=\"post\">
		<textarea rows=\"5\" placeholder=\"Type in your comment\" onkeyup='toMemory($productID)' id=\"textarea\" name=\"chatText\">$text</textarea>
		<button type=\"submit\">Send</button>
	</form>
</section>";
}

function handleChatMessage()
{
	if (isset($_GET['id']) && isset($_POST['chatText'])) {
		try {
			$dbConn = getConnection();
			$query = 'SELECT ProductID, name, isActive FROM productsDescription WHERE ProductID=:productid and isActive=true';
			$stmt = $dbConn->prepare($query);
			$stmt->execute(array(':productid' => $_GET['id']));
			if ($queryResult = $stmt->fetchObject()) {

				// adds a record of the new message to the actions table
				// then sends the message to the chatroom table

				$tableName = $queryResult->name . 'Chatroom';
				$query = "INSERT INTO actions VALUES (null, 8, :sender, NOW(), :productID); INSERT INTO $tableName SELECT null, :productID, :sender, performedAt, :chatMessage, id FROM actions WHERE performedOn = :productID AND userId = :sender ORDER BY performedAt DESC LIMIT 1;";
				$stmt = $dbConn->prepare($query);
				$stmt->execute(array(':productID' => $_GET['id'], ':sender' => $_SESSION['id'], ':chatMessage' => $_POST['chatText']));

				unset($_POST['chatText']);
				if (isset($_COOKIE["message" . $_GET['id']])) {
					setcookie("message" . $_GET['id'], '');
				}

				header('Location: ' . $_SERVER['PHP_SELF'] . '?id=' . $_GET['id']);
				die;
			} else {
				echo "This conversation does not exist anymore.";
			}
		} catch (Exception $e) {
			echo "<li>$e->getMessage()</li>/n";
		}
	}
}

function buildOneConversation($productID)
{
	$result = '';
	try {
		$dbConn = getConnection();
		$query = 'SELECT ProductID, name, isActive FROM productsDescription WHERE ProductID=:productid and isActive=true';
		$stmt = $dbConn->prepare($query);
		$stmt->execute(array(':productid' => $productID));
		if ($queryResult = $stmt->fetchObject()) {
			$tableName = $queryResult->name . 'Chatroom';
			$query = "SELECT message, sentAt, sender, firstname, lastname, jobTitle FROM $tableName JOIN members ON user_id=sender ORDER BY sentAt DESC LIMIT 50";
			$stmt = $dbConn->prepare($query);
			$stmt->execute();
			while ($comment = $stmt->fetchObject()) {
				$messageDate = strtotime($comment->sentAt);
				$timeLabel = getTimeLabel($messageDate);
				$float = $_SESSION['id'] === $comment->sender ? 'float: right; background-color: #D8DFE1; margin-left:auto' : '';

				$result .= "
				<div class=\"message\" style=\"$float\">
						<div class=\"top\">
							<h4>$comment->firstname $comment->lastname - $comment->jobTitle</h4>
							<label>$timeLabel</label>
						</div>
						<p>$comment->message</p>
				</div>";
			}
		} else {
			$result .= "<p>This conversation does not exist anymore.</p>";
		}
	} catch (Exception $e) {
		$result .= "<li>$e->getMessage()</li>/n";
	}
	return $result;
}

// Basket related functions

function buildBasket()
{
	$result = '';
	$dbConn = getConnection();
	$query = 'SELECT basket.ProductID AS productId, name, amount FROM basket JOIN productsDescription ON productsDescription.ProductID = basket.ProductID WHERE isActive=true';
	$stmt = $dbConn->prepare($query);
	$stmt->execute();
	while ($item = $stmt->fetchObject()) {
		$result .= "
		<div id=\"BasketItem$item->productId\">
			<div class=\"top\">
				<label>$item->name</label>
			</div>
			<div id=\"amount\">
				<button onclick=\"add($item->productId)\">
					<img src=\"../Icons/add_black_24dp.svg\">
				</button>
				<label id=\"amount$item->productId\" class=\"onlyInt\" onfocusout=\"updateManualInput($item->productId)\" contenteditable>$item->amount</label>
				<button onclick=\"subtract($item->productId)\">
					<img src=\"../Icons/remove_black_24dp.svg\">
				</button>
			</div>
			<button id=\"cancel\" onclick=\"remove($item->productId)\">
				<img src=\"../Icons/close_white_24dp.svg\">
			</button>
		</div>";
	}
	return $result;
}

// Returns the elements that have no instance yet in the basket

function getProducts($category)
{
	$result = '';
	$dbConn = getConnection();
	if (isset($category)  && $category !== 'All') {
		$query = 'SELECT productsDescription.ProductID, name FROM productsDescription LEFT JOIN basket ON basket.ProductID = productsDescription.ProductID WHERE isActive=true AND amount IS NULL AND category=:category';
		$stmt = $dbConn->prepare($query);
		$stmt->execute(array(':category' => $category));
	} else {
		$query = 'SELECT productsDescription.ProductID, name FROM productsDescription LEFT JOIN basket ON basket.ProductID = productsDescription.ProductID WHERE isActive=true AND amount IS NULL';
		$stmt = $dbConn->prepare($query);
		$stmt->execute();
	}

	while ($item = $stmt->fetchObject()) {
		$result .= "
		<option value=\"$item->ProductID\" class=\"$item->ProductID\">$item->name</option>";
	}
	return $result;
}

// Returns all the existing stocks from a given category
// 		=> <option>
function getExistingProducts($category)
{
	$result = '';
	$dbConn = getConnection();
	if (isset($category) && $category !== 'All') {
		$query = 'SELECT productsDescription.ProductID, name FROM productsDescription JOIN livestocks ON livestocks.productID = productsDescription.ProductID WHERE isActive=true AND category=:category';
		$stmt = $dbConn->prepare($query);
		$stmt->execute(array(':category' => $category));
	} else {
		$query = 'SELECT productsDescription.ProductID, name FROM productsDescription JOIN livestocks ON livestocks.productID = productsDescription.ProductID WHERE isActive=true';
		$stmt = $dbConn->prepare($query);
		$stmt->execute();
	}

	while ($item = $stmt->fetchObject()) {
		$result .= "
		<option value=\"$item->ProductID\" class=\"$item->ProductID\">$item->name</option>";
	}
	return $result;
}

// returns a grid of all the current products

function buildGridAllProducts($category)
{
	$result = '';
	$dbConn = getConnection();
	if (isset($category) && $category !== 'All') {
		$query = 'SELECT productsDescription.ProductID AS ProductID, name, category, isActive, amount FROM productsDescription JOIN livestocks ON livestocks.productID = productsDescription.ProductID WHERE category=:category';
		$stmt = $dbConn->prepare($query);
		$stmt->execute(array(':category' => $category));
	} else {
		$query = 'SELECT productsDescription.ProductID AS ProductID, name, category, isActive, amount FROM productsDescription JOIN livestocks ON livestocks.productID = productsDescription.ProductID';
		$stmt = $dbConn->prepare($query);
		$stmt->execute();
	}

	$result .= "
	<div class=\"grid\">
		<p class=\"\">Product</p>
		<p>Category</p>
		<p>Active?</p>
		<p>Amount</p>
		<p></p>
		<p></p>
		";

	while ($item = $stmt->fetchObject()) {
		$checkedIsActive = $item->isActive == 1 ? 'checked' : '';
		$productID = $item->ProductID;
		$result .= "
		<p id=\"Name$productID\" class=\"productName\">$item->name</p>
		<input type=\"text\" name=\"category\" id=\"Category$productID\" value=\"$item->category\">
		<input type=\"checkbox\" name=\"isActive\" id=\"IsActive$productID\" $checkedIsActive>
		<input id=\"Amount$productID\" type=\"number\" value=\"$item->amount\">
		<button onclick=\"Update($productID)\">Update</button>
		<button onmousedown=\"Delete($productID)\">Delete</button>
		";
	}
	return $result . "</div>";
}


// returns a grid of all the current products

function buildGridMembers()
{
	$result = '';
	$dbConn = getConnection();
	$query = 'SELECT user_id,username, firstname, lastname, canCreateAccounts, canManageStocks, jobTitle FROM members';
	$stmt = $dbConn->prepare($query);
	$stmt->execute();


	$result .= "
	<div class=\"grid gridMembers\">
		<p class=\"\">Username</p>
		<p>Firstname</p>
		<p>Lastname</p>
		<p>Job Title</p>
		<p>Account rights</p>
		<p>Stocks rights</p>
		<p></p>
		<p></p>
		";

	while ($item = $stmt->fetchObject()) {
		$checkedAccounts = $item->canCreateAccounts == 1 ? 'checked' : '';
		$checkedStocks = $item->canManageStocks == 1 ? 'checked' : '';

		$userID = $item->user_id;

		$result .= "
		<p id=\"Username$userID\" class=\"\">$item->username</p>
		<input type=\"text\" name=\"firstname\" id=\"Firstname$userID\" value=\"$item->firstname\">
		<input type=\"text\" name=\"lastname\" id=\"Lastname$userID\" value=\"$item->lastname\">
		<input type=\"text\" name=\"jobtitle\" id=\"JobTitle$userID\" value=\"$item->jobTitle\">
		<input  type=\"checkbox\" name=\"accounts\" id=\"Accounts$userID\" $checkedAccounts>
		<input type=\"checkbox\" name=\"stocks\" id=\"Stocks$userID\" $checkedStocks>
		<button onclick=\"UpdateMembers($userID)\">Update</button>
		<button onclick=\"DeleteMembers($userID)\">Delete</button>
		";
	}
	return $result . "</div>";
}
