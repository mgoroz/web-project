<?php
session_start();

require_once('../../utility/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Create a connection to the database
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the user with the given username or email already exists
    $check_sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ss", $username, $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo "User with this username or email already exists!";
        $check_stmt->close();
    } else {
        $check_stmt->close();

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the user data into the database
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $hashed_password);
        $result = $stmt->execute();

        if ($result) {
            $_SESSION['message'] = "User registered successfully!";
            header("Location: ../public/profile.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the connection
        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Register</title>
    <script src="../../assets/scripts/loginvalidation.js"></script>
    <link rel="stylesheet" href="../../assets/styles/style.css">
    <meta name="author" content="Maksim Gorozhanko">
</head>
<body>
    <div class="content-container">
        <div class="register-container">
            <h1>Register</h1>
            <form class="register-form" method="POST" onsubmit="return validateRegisterForm(this);">
                <label for="username">Username:</label>
                <input type="text" name="username" required>
                <label for="email">Email:</label>
                <input type="email" name="email" required>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
                <input type="submit" value="Register">
                <a href="../../index.php">Back to homepage</a>
            </form>
        </div>
    </div>
</body>
</html>
