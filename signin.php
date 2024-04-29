<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    $host = "localhost";
    $username = "hnguyen284";
    $password = "hnguyen284";
    $database = "hnguyen284";

    // Check if information has really been entered in the Sign In Form
    if (isset($_POST["user"]) and isset($_POST["Email"]) and isset($_POST["Password"])) {
        $user = $_POST["user"];
        $email = $_POST["Email"];
        $pass = $_POST["Password"];
    }
    
    // Create Connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check Connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Run SQL Command to get user's info
    $sql = "SELECT * from users WHERE username= \"$user\"";
    $res = $conn->query($sql);

    // Find the matching user
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            if ($user == $row["username"] and $email == $row["email"] and password_verify($pass, $row["password"])) {
                $_SESSION["id"] = $row["id"];
                $_SESSION["username"] = $user;
                setcookie("user", $_SESSION["username"], time() + (86400 * 30), "/");
                header("Location: test.php");
            } else {
                header("Location:homepage.html");
            }
        }
    } else {
        echo "<p>Users don't exist. <a href=\"homepage.html\">Go back.</a></p>";
    }