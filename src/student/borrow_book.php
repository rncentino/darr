<?php
session_start();
require("../php/db_conn.php");

$student_id = $_SESSION['student_id']; // Assuming the student ID is stored in the session
$book_copy_id = $_POST['book_copy_id']; // Book copy ID from the request

// Check if the book is available
$sql = "SELECT status FROM bookcopy WHERE book_copy_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $book_copy_id);
$stmt->execute();
$result = $stmt->get_result();
$book_copy = $result->fetch_assoc();

if ($book_copy['status'] === 'available') {
    // Insert the borrow request with status 'pending'
    $sql = "INSERT INTO borrow (book_copy_id, student_id, status, date_borrowed) VALUES (?, ?, 'pending', NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $book_copy_id, $student_id);
    if ($stmt->execute()) {
        echo "Borrow request submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Book is not available for borrowing.";
}

$stmt->close();
$conn->close();
?>
