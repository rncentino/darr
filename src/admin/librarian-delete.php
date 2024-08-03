<?php
// Include the database connection file
require_once("../php/db_conn.php");

// Initialize an array to store response data
$response = array();

// Check if the librarian_id is set
if(isset($_GET["librarian_id"])) {
    // Sanitize the input
    $librarian_id = intval($_GET["librarian_id"]);

    // Prepare and execute the SQL statement to delete the librarian record
    $sql = "DELETE FROM librarian WHERE librarian_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $librarian_id);

    if ($stmt->execute()) {
        // If deletion is successful, set success response
        $response["success"] = true;
        $response["message"] = "Librarian deleted successfully.";
    } else {
        // If deletion fails, set error response
        $response["success"] = false;
        $response["message"] = "Error deleting librarian.";
    }

    // Close the statement
    $stmt->close();
} else {
    $response["success"] = false;
    $response["message"] = "Invalid request. Librarian ID not set.";
}

// Close the database connection
$conn->close();

// Send JSON response
echo json_encode($response);
?>
