<?php
// Check if the user is logged in
if (!isset($_SESSION['email']) || !isset($_SESSION['id'])) {
    // If not, redirect to login.php
    header("Location: ../librarian-login.php");
    exit();
  }

?>