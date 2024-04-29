<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: homepage.html");
        exit;
    }

    if (isset($_POST["signOut"])) {
        unset($_COOKIE["user"]);
        setcookie("user", "", -1, "/");
        unset($_SESSION["username"]);
        session_destroy();
        session_write_close();
        header("Location: homepage.html");
        exit;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Testing for Sign In and Sign Out Functionality.</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <form action="./test.php" method="post">
            <input type="submit" name="signOut" value="Sign Out">
        </form>
    </body>
</html>