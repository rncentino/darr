<?php
// Include the database connection
require_once("../php/db_conn.php");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST["title"];
    $author = $_POST["author"];
    $publisher = $_POST["publisher"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $isbn = $_POST["isbn"];
    $publication_yr = $_POST["publication_yr"];
    $genre = $_POST["genre"];
    $edition = $_POST["edition"];

    // Save the uploaded image
    $image = $_FILES["image"]["name"];
    $target_dir = "../admin/uploads/books/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Get current datetime
    $created_at = date('Y-m-d H:i:s');

    // Database operation: Insert data into the 'books' table
    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO book (title, author, publisher, category, price, isbn, publication_yr, genre, edition, image, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind parameters and execute the statement
        $stmt->bind_param("sssssssssss", $title, $author, $publisher, $category, $price, $isbn, $publication_yr, $genre, $edition, $image, $created_at);
        $stmt->execute();

        // Check if the row was inserted
        if ($stmt->affected_rows > 0) {
            echo "success";
        } else {
            echo "error: Failed to insert the book.";
        }

        // Close the statement
        $stmt->close();
    } catch (Exception $e) {
        // Return error response
        echo "error: " . $e->getMessage();
    }
}



?>
