<?php
// Check if the user is logged in
if (!isset($_SESSION['email']) || !isset($_SESSION['user_id'])) {
    // If not, redirect to login.php
    header("Location: ../src/login.php");
    exit();
  }

?>