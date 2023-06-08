<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once('config.php');

function loginUser() {
    global $servername, $db_username, $db_password, $dbname;

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create a connection to the database
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check for connection errors
    if ($conn->connect_error) {
        return "Connection failed: " . $conn->connect_error;
    }

    // Fetch the user with the given username
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) { 
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return "success";
        } else {
            return "Invalid username or password.";
        }
    } else {
        return "Invalid username or password.";
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo loginUser();
}
?>
