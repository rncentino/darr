<?php
session_start();
require("../php/db_conn.php");
require('includes/auth.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $book_copy_id = $_POST['book_copy_id'];
    $librarian_id = $_SESSION['id']; // Assuming librarian_id is stored in session

    // Check if book_copy_id exists and is available
    $check_book_sql = "SELECT * FROM bookcopy WHERE book_copy_id = ? AND status = 'available'";
    $check_stmt = $conn->prepare($check_book_sql);
    $check_stmt->bind_param('i', $book_copy_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Book copy not available or does not exist.']);
        exit;
    }
    $check_stmt->close();

    // Set the date_borrowed to current date
    $date_borrowed = date('Y-m-d');
    // Set due_date to 3 days after date_borrowed
    $due_date = date('Y-m-d', strtotime($date_borrowed . ' + 3 days'));

    // Insert the borrow record
    $sql = "INSERT INTO borrow (book_copy_id, student_id, librarian_id, date_borrowed, due_date)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iiiss', $book_copy_id, $student_id, $librarian_id, $date_borrowed, $due_date);

    if ($stmt->execute()) {
        // Update the bookcopy status
        $update_sql = "UPDATE bookcopy SET status = 'borrowed' WHERE book_copy_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param('i', $book_copy_id);
        $update_stmt->execute();
        $update_stmt->close();

        echo json_encode(['status' => 'success', 'message' => 'Book issued successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
