<?php
session_start();

require_once('../../utility/config.php');


$bookedDates = [];

$conn = new mysqli($servername, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT date FROM bookings";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bookedDates[] = $row['date'];
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Requests</title>
    <link rel="stylesheet" href="../../assets/styles/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script>
      let bookedDates = <?php echo json_encode($bookedDates); ?>;
    </script>
    <script src="../../assets/scripts/calendar.js"></script>
    <script src="../../assets/scripts/loginvalidation.js"></script>
    <script src="../../assets/scripts/loginform.js"></script>
    <meta name="author" content="Maksim Gorozhanko">
  </head>
  <body>
  <?php include '../../includes/nav.php'; ?>
  <h1>
    Book your collection.
  </h1>
    
  <div class="calendar-wrapper">
  <div class="calendar-controls">
        <button onclick="changeMonth(-1)">&lt; Previous</button>
        <button onclick="changeMonth(1)">Next &gt;</button>
    </div>
    <div class="calendar"></div>
  </div>  
  <?php include '../../includes/footer.php'; ?>
  </body>
</html>
