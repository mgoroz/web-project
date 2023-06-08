<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}

session_start();
require_once('../../utility/config.php');

// If user is logged in, fetch user information
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
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

    // Fetch bookings for the current user
    $sql_bookings = "SELECT * FROM bookings WHERE user_id = ? ORDER BY date ASC";
    $stmt_bookings = $conn->prepare($sql_bookings);
    $stmt_bookings->bind_param("i", $user_id);
    $stmt_bookings->execute();
    $result_bookings = $stmt_bookings->get_result();
    $bookings = $result_bookings->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    $stmt_bookings->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../../assets/styles/style.css">
    <script src="../../assets/scripts/loginvalidation.js"></script>
    <script src="../../assets/scripts/loginform.js"></script>
    <script src="../../assets/scripts/changepassword.js"></script>
    <script src="../../assets/scripts/deletebooking.js"></script>
    <meta name="author" content="Maksim Gorozhanko">
</head>
<body>
    <?php include '../../includes/nav.php'; ?>

    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="profile-container">
            <h1>User Profile</h1>
            <p>Username: <?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p>Email: <?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?></p>

            <button id="change-password-button">Change Password</button>
            <div id="change-password-form-container" style="display: none;">
                <form id="change-password-form" method="POST" action="../../utility/changepassword.php" onsubmit="return validateChangePasswordForm(this);">
                    <label for="current-password">Current Password:</label>
                    <input type="password" name="current_password" required>
                    <label for="new-password">New Password:</label>
                    <input type="password" name="new_password" required>
                    <label for="confirm-password">Confirm New Password:</label>
                    <input type="password" name="confirm_password" required>
                    <input type="submit" value="Change Password">
                </form>
            </div>


            <h2>Your Requests</h2>
            <?php if (!empty($bookings)): ?>
                <table class="booking-table">
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Delete</th>
                    </tr>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($booking['date'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($booking['name_from_form'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($booking['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($booking['phone'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($booking['address'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><button class="delete-booking" data-booking-id="<?php echo $booking['id']; ?>">X</button></td>
                        </tr>
                    <?php endforeach; ?>

                </table>
            <?php else: ?>
                <p>No bookings found.</p>
            <?php endif; ?>

            <div class="logout-button">
                <form method="POST" action="../../utility/logout.php">
                    <input type="submit" value="Logout">
                </form>
            </div>
        </div>
    <?php else: ?>
        <h1>Please log in</h1>
        <form method="POST" onsubmit="return submitLoginForm(this, 'profile-login-error-message');" class="profile-login">
            <div id="profile-login-error-message" style="display:none;color:red;"></div>
            <label for="username"><input type="text" name="username" placeholder="Username" class="input-field"></label>
            <label for="password"><input type="password" name="password" placeholder="Password" class="input-field"></label>
            <a href="">Forgot Password?</a>
            <span>
                <input type="submit" value="Login">
                <input type="button" value="Sign Up" onclick="window.location.href='../private/register.php'">
            </span>
        </form>
    <?php endif; ?>
    <?php include '../../includes/footer.php'; ?>
</body>
</html>
