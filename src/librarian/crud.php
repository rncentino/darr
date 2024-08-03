<?php
require_once("../php/db_conn.php");

header('Content-Type: application/json');

// Function to send JSON response
function send_json_response($success, $message = '') {
    echo json_encode(['success' => $success, 'message' => $message]);
    exit();
}

// Check if request method is POST for adding or editing user
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Edit user
    if (isset($_POST['student_id'])) {
        $student_id = $_POST['student_id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $student_no = $_POST['student_no'];
        $course = $_POST['course'];
        $email = $_POST['email'];

        // Prepare SQL statement without password
        $sql = "UPDATE student SET 
                firstname = ?, 
                lastname = ?, 
                student_no = ?, 
                course = ?, 
                email = ?
                WHERE student_id = ?";

        // Bind parameters without password
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $firstname, $lastname, $student_no, $course, $email, $student_id);

        if ($stmt->execute()) {
            send_json_response(true, 'User updated successfully');
        } else {
            send_json_response(false, 'Error updating record');
        }

        $stmt->close();
    } else {
        // Add user
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $student_no = $_POST['student_no'];
        $course = $_POST['course'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO student (firstname, lastname, student_no, course, email, password)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $firstname, $lastname, $student_no, $course, $email, $hashed_password);

        if ($stmt->execute()) {
            send_json_response(true, 'User added successfully');
        } else {
            send_json_response(false, 'Error adding record');
        }

        $stmt->close();
    }

    $conn->close();
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    // Fetch user details for editing
    $student_id = $_GET['id'];

    $sql = "SELECT student_id, firstname, lastname, student_no, course, email FROM student WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        send_json_response(false, 'User not found');
    }

    $stmt->close();
    $conn->close();
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['delete_id'])) {
    // Delete user
    $student_id = $_GET['delete_id'];

    $sql = "DELETE FROM student WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);

    if ($stmt->execute()) {
        send_json_response(true, 'User deleted successfully');
    } else {
        send_json_response(false, 'Error deleting record');
    }

    $stmt->close();
    $conn->close();
} else {
    send_json_response(false, 'Invalid request');
}
?>
