<?php
// Include the database connection
require_once("../php/db_conn.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $book_id = intval($_POST['book_id']);
  $copies = intval($_POST['copies']);

  if ($book_id && $copies) {
    // Get the current highest copy_number for this book
    $sql = "SELECT MAX(copy_number) as max_copy_number FROM bookcopy WHERE book_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $current_copy_number = $row['max_copy_number'] ? $row['max_copy_number'] : 0;

    // Insert the new copies
    $sql = "INSERT INTO bookcopy (book_id, copy_number, status) VALUES (?, ?, 'available')";
    $stmt = $conn->prepare($sql);
    $success = true;

    for ($i = 1; $i <= $copies; $i++) {
      $copy_number = $current_copy_number + $i;
      $stmt->bind_param("ii", $book_id, $copy_number);
      if (!$stmt->execute()) {
        $success = false;
        break;
      }
    }

    if ($success) {
      echo json_encode(['success' => true]);
    } else {
      echo json_encode(['success' => false]);
    }
  } else {
    echo json_encode(['success' => false]);
  }
} else {
  echo json_encode(['success' => false]);
}

$conn->close();
?>

