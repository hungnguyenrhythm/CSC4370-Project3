<?php
    if (isset($_POST["signUp"])) {
        $first = $_POST["fName"];
        $last = $_POST["lName"];
        $email = $_POST["email"];
        $password = $_POST["Password"];
        $hasedPassword = password_hash($password, PASSWORD_DEFAULT);
    }
    $host = "localhost";
    $user = "hnguyen284";
    $pass = "hnguyen284";
    $dbname = "hnguyen284";

    // create connection
    $conn = new mysqli($host, $user, $pass, $dbname);

    // Check connection
    if ($conn->connect_error) {
        echo "Could not connect to this server..\n";
        die("Connection failed: " . $conn->connect_error);
    }

    // Create SQL Table
    $sql = "INSERT INTO USERS (firstName, lastName, email, users, passWord)
    VALUES ($first, $last, $email, Seller, $hasedPassword)";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully into the table";
    } else {
        echo "Error insert into table: " . $conn->error;
    }

    $conn->close();