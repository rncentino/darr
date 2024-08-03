<?php
session_start();
require("../php/db_conn.php");

if (isset($_POST['borrow_id'])) {
  $borrow_id = $_POST['borrow_id'];
  $current_date = date('Y-m-d H:i:s');

  // Update borrow table
  $update_borrow_sql = "UPDATE borrow SET date_returned = ? WHERE borrow_id = ?";
  $stmt = $conn->prepare($update_borrow_sql);
  $stmt->bind_param('si', $current_date, $borrow_id);

  if ($stmt->execute()) {
    // Update book_copy_id status to "available"
    $update_book_copy_sql = "UPDATE bookcopy bc 
                            JOIN borrow b ON bc.book_copy_id = b.book_copy_id
                            SET bc.status = 'available' 
                            WHERE b.borrow_id = ?";
    $stmt_copy = $conn->prepare($update_book_copy_sql);
    $stmt_copy->bind_param('i', $borrow_id);
    $stmt_copy->execute();

    echo "Book returned successfully.";
  } else {
    echo "Error: " . $conn->error;
  }
  $stmt->close();
  $stmt_copy->close();
} else {
  echo "Invalid request.";
}

$conn->close();
?>
