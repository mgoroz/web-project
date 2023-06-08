<?php
session_start();

// Destroy the session and redirect to the home page
session_destroy();
header("Location: https://enos.itcollege.ee/~mgoroz/ics0008_group_project/index.php");
exit;
?>
