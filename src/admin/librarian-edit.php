<?php
// Include the database connection file
require_once("../php/db_conn.php");

// Initialize an array to store response data
$response = array();

// Check if the form data is received via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (isset($_POST["user_id"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"])) {
        // Sanitize the input
        $user_id = intval($_POST["user_id"]);
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];

        // Prepare and execute the SQL statement to update the librarian data
        $sql = "UPDATE librarian SET firstname = ?, lastname = ?, email = ? WHERE librarian_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $firstname, $lastname, $email, $user_id);

        if ($stmt->execute()) {
            // If the update is successful, set success response
            $response["success"] = true;
            $response["message"] = "Librarian data updated successfully.";
        } else {
            // If the update fails, set error response
            $response["success"] = false;
            $response["message"] = "Error updating librarian data.";
        }

        // Close the statement
        $stmt->close();
    } else {
        // If required fields are missing, set error response
        $response["success"] = false;
        $response["message"] = "Missing required fields.";
    }
} elseif(isset($_GET["librarian_id"])) {
    // Sanitize the input
    $librarian_id = intval($_GET["librarian_id"]);

    // Prepare and execute the SQL statement
    $sql = "SELECT firstname, lastname, email FROM librarian WHERE librarian_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $librarian_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query was successful and if data was found
    if($result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();

        // Populate the response array
        $response["success"] = true;
        $response["librarian"] = $row;
    } else {
        $response["success"] = false;
        $response["message"] = "Librarian not found.";
    }

    // Close the statement
    $stmt->close();
} else {
    $response["success"] = false;
    $response["message"] = "Invalid request.";
}

// Close the database connection
$conn->close();

// Send JSON response
echo json_encode($response);
?>
