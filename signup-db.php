<?php
$host = "localhost";
$username = "lcheong1";
$password = "lcheong1";
$database = "lcheong1";

// create connection
$conn = new mysqli($host, $username, $password);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// create our database
$sql_create_db = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql_create_db) === TRUE) {
    echo "Database created successfully or already exists<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// connect to database
$conn->close();
$conn = new mysqli($host, $username, $password, $database);

// check our connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql_create_table = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
    role ENUM('buyer', 'seller', 'admin') NOT NULL
)";

// execute
if ($conn->query($sql_create_table) === TRUE) {
    echo "Table created successfully or already exists";
} else {
    echo "Error creating table: " . $conn->error;
}

// close connection
$conn->close();
?>
