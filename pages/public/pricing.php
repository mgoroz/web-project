<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Pricing</title>
    <link rel="stylesheet" href="../../assets/styles/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="../../assets/scripts/loginform.js"></script>
    <script src="../../assets/scripts/loginvalidation.js"></script>
    <meta name="author" content="Maksim Gorozhanko">
  </head>
  <body>
    <?php include '../../includes/nav.php'; ?>

    <h1>Pricing</h1>

    <div class="content-container">
      <div class="pricing-container">
        <div class="pricing-card">
          <h3>Basic </h3>
          <p class="price">5.00 euro <span>per pickup</span></p>
          <ul>
            <li>One garbage bin pickup</li>
            <li>Standard waste separation</li>
          </ul>
        </div>

        <div class="pricing-card">
          <h3>Standard</h3>
          <p class="price">10.00 euro <span>per pickup</span></p>
          <ul>
            <li>Two garbage bin pickups</li>
            <li>Recyclable and non-recyclable waste separation</li>
          </ul>
        </div>

        <div class="pricing-card">
          <h3>Pro</h3>
          <p class="price">15.00 euro <span>per pickup</span></p>
          <ul>
            <li>Three garbage bin pickups</li>
            <li>Recyclable, non-recyclable, and organic waste separation</li>
            <li>Priority customer support</li>
          </ul>
        </div>
      </div>
    </div>


    <?php include '../../includes/footer.php'; ?>
    </body>
</html>
