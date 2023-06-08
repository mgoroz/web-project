<?php
session_start();
require_once('config.php');

if (isset($_SESSION['user_id']) && isset($_POST['booking_id'])) {
    $user_id = $_SESSION['user_id'];
    $booking_id = $_POST['booking_id'];

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM bookings WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $booking_id, $user_id);
    $stmt->execute();

    $affected_rows = $stmt->affected_rows;
    $stmt->close();
    $conn->close();

    if ($affected_rows > 0) {
        echo "success";
    } else {
        echo "failure";
    }
} else {
    echo "failure";
}
?>
