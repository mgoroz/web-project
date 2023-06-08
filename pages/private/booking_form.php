<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once('../../utility/config.php');

if (!isset($_SESSION['user_id'])) {
  header("Location: ../public/profile.php");
  exit;
}

// Variables for form input and error messages
$error = '';
$date = isset($_GET['date']) ? trim($_GET['date']) : '';
$formSubmitted = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($error)) {
    $name_error = '';  
    $email_error = '';  
    $phone_error = '';  
    $address_error = '';
    if(empty($_POST["name"])){  
        $name_error = "Please Enter Name";  
    } else {  
        if(!preg_match("/^[a-zA-Z-' ]*$/", $_POST["name"])){  
            $name_error = "Name error";
        }  
    }
    
    if(empty($_POST["email"])){  
        $email_error = "Please Enter Email";
    } else {  
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){  
            $email_error = "Invalid Email format";  
        }  
    }
    if(empty($_POST["phone"])){
        $phone_error = "Please Enter Phone";
    } else {
        if (!preg_match ("/^[0-9\-\(\)\/\+\s]*$/", ($_POST["phone"]))){
            $phone_error = "Wrong phone format";
        }
    }  
    if(empty($_POST["address"])){
        $address_error = "Please Enter Address";
    } else{
        if(!preg_match("/^[a-zA-Z0-9,;.\/\-\—\s]+$/", $_POST["address"])){  
            $address_error = "Address can contain letters, numbers, comas, dots, slashes and minuses";
        } 
    }

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    

    // Store the booking data in the database
    if ($name_error == '' && $email_error == '' && $phone_error == '' && $address_error == '') {
      $conn = new mysqli($servername, $db_username, $db_password, $dbname);
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
  
      $sql = "INSERT INTO bookings (user_id, date, name_from_form, email, phone, address) VALUES (?, ?, ?, ?, ?, ?)";
      if ($stmt = $conn->prepare($sql)) {
          $stmt->bind_param("isssss", $_SESSION['user_id'], $date, $name, $email, $phone, $address);
      } else {
          die("Error preparing statement: " . $conn->error);
      }
        
      if ($stmt->execute()) {
          $formSubmitted = true;
          $stmt->close();
          $conn->close();
          header('Location: ../public/requests.php');
          exit;
      } else {
          $error = "Error: " . $stmt->error;
          error_log("Error inserting booking data: " . $stmt->error);
      }
  
      $stmt->close();
      $conn->close();
  } else {
      echo $name_error, $email_error, $phone_error, $address_error;
  }  
}

if (empty($date) || !checkdate(date('m', strtotime($date)), date('d', strtotime($date)), date('Y', strtotime($date)))) {
  $error = 'Invalid date.';
} else {
  $today = new DateTime();
  $selectedDate = new DateTime($date);

  if ($selectedDate < $today) {
    $error = 'You cannot book a date in the past.';
  } else {
    // Check if the chosen date is already booked
    
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT date FROM bookings WHERE date = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $date);
    } else {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error = 'This date is already booked. Please choose another date.';
    }

    $stmt->free_result();
    $stmt->close();
    $conn->close();
  }
}



?>
<!DOCTYPE html>
<html>
<head>
    <title>Booking Form</title>
    <meta name="charset" content="utf-8">
    <meta name="description" content="Overview of ODGC - Login or sign-up">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../assets/styles/style.css">
    <meta name="author" content="Maksim Gorozhanko">
    <script src="../../assets/scripts/validation.js"></script>
</head>
<body>
  <h1 class = "book-collection">Book your collection for <?php echo $date; ?></h1>

  <?php if (!empty($error)): ?>
    <p class="error"><?php echo $error; ?></p>
    <p><a href="../public/requests.php" class = "back">Back to the request page</a></p>
  <?php elseif ($formSubmitted): ?>
    <p class="success">Your booking has been submitted successfully!</p>
    <p><a href="../public/requests.php">Back to the request page</a></p>
  <?php else: ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?date=' . urlencode($date); ?>" onsubmit="return validateForm()" name="bookingForm">
      <label for="name">Name:</label>
      <input type="text" name="name" class="booking-input" required>
      <br>
      <label for="email">Email:</label>
      <input type="email" name="email" class="booking-input" required>
      <br>
      <label for="phone">Phone:</label>
      <input type="tel" name="phone" class="booking-input" required>
      <br>
      <label for="address">Address:</label>
      <textarea name="address" class="booking-input" required></textarea>
      <br>
      <button type="submit">Book</button>
    </form>
    <p><a href="../public/requests.php" class = "back">Back to the request page</a></p>
  <?php endif; ?>
</body>
</html>
