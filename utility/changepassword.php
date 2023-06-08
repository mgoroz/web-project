<?php
session_start();
require_once('https://enos.itcollege.ee/~mgoroz/ics0008_group_project/utility/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (password_verify($current_password, $user['password'])) {
        if ($new_password === $confirm_password) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_sql = "UPDATE users SET password = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("si", $hashed_password, $user_id);
            $update_stmt->execute();

            $_SESSION['message'] = "Password updated successfully!";
            header("Location: https://enos.itcollege.ee/~mgoroz/ics0008_group_project/pages/public/profile.php");
            exit();
        } else {
            $_SESSION['message'] = "New passwords do not match!";
            header("Location: https://enos.itcollege.ee/~mgoroz/ics0008_group_project/pages/public/profile.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Incorrect current password!";
        header("Location: https://enos.itcollege.ee/~mgoroz/ics0008_group_project/pages/public/profile.php");
        exit();
    }

    $stmt->close();
    $update_stmt->close();
    $conn->close();
} else {
    header("Location: https://enos.itcollege.ee/~mgoroz/ics0008_group_project/index.php");
    exit();
}
?>
