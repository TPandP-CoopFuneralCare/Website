<?php
require_once "functions.php";
ini_set("session.save_path", "/home/unn_w18011022/sessionData");
session_start();

$_SESSION = array();

session_destroy();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <link href="style.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>North Events</title>
</head>
<body>
<?php
echo makeHeader("Logout");
?>

<section>

    <article>
        <h2>You have logged out!</h2>
        <p><a href = login.php>Click to login</a></p>
    </article>

    </nav>




</section>
<?php
echo makeFooter("North Events Ⓒ2019");
?>


</body>

</html>