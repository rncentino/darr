<?php
require_once("../php/db_conn.php");

$limit = 10;
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$start_from = ($page-1) * $limit;

$search = isset($_GET['search']) ? $_GET['search'] : '';

$where_clause = '';
if ($search) {
    $search = $conn->real_escape_string($search);
    $where_clause = "WHERE b.title LIKE '%$search%' OR b.author LIKE '%$search%' OR b.publisher LIKE '%$search%' OR b.isbn LIKE '%$search%'";
}

// Query to fetch total number of records
$total_query = "SELECT COUNT(b.book_id) FROM book b $where_clause";
$result_total = $conn->query($total_query);
$row_total = $result_total->fetch_row();
$total_records = $row_total[0];
$total_pages = ceil($total_records / $limit);

// Query to fetch the required records for the current page
$query = "
SELECT b.book_id, b.title, b.image, b.author, b.publisher, b.publication_yr, b.category, b.isbn, b.edition, b.genre, b.price, 
      (SELECT COUNT(*) FROM bookcopy bc WHERE bc.book_id = b.book_id AND bc.status = 'available') AS available_copies
FROM book b
$where_clause
LIMIT $start_from, $limit";

$result = $conn->query($query);

$books = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

echo json_encode([
    'books' => $books,
    'total_pages' => $total_pages,
    'current_page' => $page
]);

$conn->close();
?>
