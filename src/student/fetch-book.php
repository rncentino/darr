<?php
require("../php/db_conn.php");

if (isset($_GET['id'])) {
  $book_id = intval($_GET['id']);

  // Fetch book details
  $sql = "SELECT b.*, 
                 (SELECT COUNT(*) FROM bookcopy bc WHERE bc.book_id = b.book_id AND bc.status = 'available') as available_copies 
          FROM book b 
          WHERE b.book_id = ?";
  
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $book_id);
  $stmt->execute();
  $result = $stmt->get_result();
  
  if ($result->num_rows > 0) {
    $book = $result->fetch_assoc();
    echo json_encode($book);
  } else {
    echo json_encode(['error' => 'Book not found']);
  }

  $stmt->close();
} else {
  echo json_encode(['error' => 'Invalid request']);
}

$conn->close();
?>
