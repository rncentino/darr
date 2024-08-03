<?php
// Include the database connection file
require_once("../php/db_conn.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize an array to store response data
    $response = array();

    // Validate and sanitize input data
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert librarian details into the database
    $sql = "INSERT INTO librarian (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $firstname, $lastname, $email, $hashedPassword);

    if ($stmt->execute()) {
        $response["success"] = true;
        $response["message"] = "Librarian added successfully.";
    } else {
        $response["success"] = false;
        $response["message"] = "Error adding librarian to the database.";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();

    // Send JSON response
    echo json_encode($response);
} else {
    // If the request method is not POST, return an error response
    $response["success"] = false;
    $response["message"] = "Invalid request method.";
    echo json_encode($response);
}

?>
