<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$username = "hnguyen284";
$password = "hnguyen284";
$database = "hnguyen284";

// Response object
$response = array();

// check if form data is set
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['role'])) {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // create connection
    $conn = new mysqli($host, $username, $password, $database);

    // check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // check if username already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    // if username already exists, set error message
    if ($result->num_rows > 0) {
        $response['success'] = false;
        $response['message'] = "Username already exists. Please choose a different username.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $user, $email, $pass, $role);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "New record created successfully";
        } else {
            $response['success'] = false;
            $response['message'] = "Error: " . $stmt->error;
        }
    }
  
    $stmt->close();

    // close connection
    $conn->close();
} else {
    $response['success'] = false;
    $response['message'] = "Form data is missing.";
}

// Return JSON response
header("Location:homepage.html");
echo json_encode($response);
?>
