<?php

require('../functions.php');
// Checks if the user is logged in
initSession();
checkSession('../login.php', false);

?>

<!DOCTYPE html>
<html>

<head>
  <title>Conversations</title>
  <link rel="stylesheet" href="style.css" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script src="chat.js"></script>
</head>

<body>
  <?php

  handleChatMessage();

  echo buildNav();

  ?>
  <main>
    <h1>CONVERSATIONS</h1>
    <?php
    if (!isset($_GET['id'])) {
      $category = isset($_POST['chatCategory']) ? $_POST['chatCategory'] : null;
      $self = $_SERVER['PHP_SELF'];

      echo "<form id=\"chatCategories\" method=\"post\" action=\"$self\">
          <select name=\"chatCategory\" onchange='this.form.submit()'>
            <option value=\"All\">All</option>";
      echo getCategories($category);
      echo '
          </select>
        </form>';
    }
    ?>

    <?php
    if (isset($_GET['id'])) {
      echo '<section id="messages" class="chat">';
      echo buildOneConversation($_GET['id']);
    } else {
      echo '<section id="messages">';
      echo buildConversations();
    }
    ?>
    </section>
    <?php
    if (isset($_GET['id'])) {
      echo buildChatbox($_GET['id']);
    }
    ?>

  </main>
</body>

</html>