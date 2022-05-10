<?php
require('functions.php');
initSession();
checkSession('index.php', true);
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Sentinel Login</title>
</head>

<body>

    <div>

        <img src="coop-logo.png" alt="Avatar" class="avatar">


        <div class="fixed">
        </div>

        <form class="container" action="login.php" method="post">
            <?php

            if (isset($_POST['uname'])) {
                list($input, $errors) = validateLogon();

                if ($errors) {
                    echo showErrors($errors);
                } else {
                    setSession('logged-in', true);
                    header('Location: index.php');
                }
            }


            ?>
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <button type="submit" name="login">Login</button>
        </form>

        <div class="forgot">
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>

    </div>
    </form>
</body>

</html>