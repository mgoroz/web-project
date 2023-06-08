<?php
session_start();
?>

<!DOCTYPE html>
<head>
    <meta name="charset" content="utf-8">
    <title>Home</title>
    <meta name="description" content="Overview of ODGC - Login or sign-up">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/styles/style.css">
    <script src="assets/scripts/loginvalidation.js"></script>
    <script src="assets/scripts/loginform.js"></script>
    <meta name="author" content="Maksim Gorozhanko">
</head>
<body class="index">
    <?php include 'includes/nav.php'; ?>

    <div style="flex:1"></div>
    <div class="main">
        <article class="left">
            <h1>Request from home</h1>
            <p>Is the trash delivery taking too long? Or are you paying for too frequent disposals? Not to worry ODGC (On-demand garbage collection) is a new and improved way of handling garbage disposal, all the while, of course, staying environmentally friendly. It is extremely easy to set-up – sign-up as a user and request delivery on your own freely chosen date as often or seldom as you desire. We take into consideration the needs of all – homeowners and businesses alike.</p>
        </article>
        <article class="right">
            <h1>About us</h1>
            <p>Up and coming garbage delivery company, who are not afraid to find new solotions to old problems.</p>
            <p>We have an experienced team, who has been in the thick of it and know how to handle trash.</p>
        </article>
        <article>
            <h1>Latest news</h1>
            <p>Heil garbage truck company has just released a new rendition of the old side-loader truck. Have to say - it looks maginificent.</p>
        </article>
    </div>
    <div style="flex:2"></div>
    
    <?php include 'includes/footer.php'; ?>
</body>
