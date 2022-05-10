<?php

require('functions.php');
// Checks if the user is logged in
initSession();
checkSession('login.php', false);


?>

<!doctype html>
<html>

<head>
  <title>Main page!</title>
</head>

<body>
  <p>This is an example paragraph. Anything in the <strong>body</strong> tag will appear on the page, just like this <strong>p</strong> tag and its contents.</p>
</body>

</html>