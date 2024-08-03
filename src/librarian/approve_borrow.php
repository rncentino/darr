<?php
session_start();
require("../php/db_conn.php");

$librarian_id = $_SESSION['librarian_id']; // Assuming the librarian ID is stored in the session
$borrow_id = $_POST['borrow_id']; // Borrow ID from the request

// Approve the borrow request
$sql = "UPDATE borrow SET status = 'approved', librarian_id = ?, due_date = DATE_ADD(date_borrowed, INTERVAL 3 DAY) WHERE borrow_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $librarian_id, $borrow_id);
if ($stmt->execute()) {
    // Update the book copy status to 'borrowed'
    $sql = "UPDATE bookcopy SET status = 'borrowed' WHERE book_copy_id = (SELECT book_copy_id FROM borrow WHERE borrow_id = ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $borrow_id);
    if ($stmt->execute()) {
        echo "Borrow request approved successfully.";
    } else {
        echo "Error updating book copy status: " . $stmt->error;
    }
} else {
    echo "Error approving borrow request: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
