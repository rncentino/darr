<?php
// Include the database connection
require_once("db_conn.php");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $OCT_TCT_no = $_POST["OCT_TCT_no"];
    $lot_no = $_POST["lot_no"];
    $survey_no = $_POST["survey_no"];
    $sheet_no = $_POST["sheet_no"];
    $area = $_POST["area"];
    $date_approved = $_POST["date_approved"];
    $municipality = $_POST["municipality"];
    $brgy = $_POST["brgy"];
    $land_owner = $_POST["land_owner"];
    $geodetic_engr = $_POST["geodetic_engr"];
    $survey_type = $_POST["survey_type"];

    // Save the uploaded map (PDF file)
    $map = $_FILES["map"]["name"];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($map);
    move_uploaded_file($_FILES["map"]["tmp_name"], $target_file);

    // Set the current time for uploaded_at
    $uploaded_at = date('Y-m-d H:i:s');

    // Database operation: Insert data into the 'records' table
    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO records (OCT_TCT_no, lot_no, survey_no, sheet_no, area, date_approved, municipality, brgy, land_owner, geodetic_engr, survey_type, map, uploaded_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Bind parameters and execute the statement
        $stmt->bind_param("sssssssssssss", $OCT_TCT_no, $lot_no, $survey_no, $sheet_no, $area, $date_approved, $municipality, $brgy, $land_owner, $geodetic_engr, $survey_type, $map, $uploaded_at);
        $stmt->execute();

        // Check if the row was inserted
        if ($stmt->affected_rows > 0) {
            echo "success";
        } else {
            echo "error: Failed to insert the record.";
        }

        // Close the statement
        $stmt->close();
    } catch (Exception $e) {
        // Return error response
        echo "error: " . $e->getMessage();
    }
}
?>
