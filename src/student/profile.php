<?php
session_start();
require("../php/db_conn.php");

include('includes/auth.php');
include('includes/header.php'); 

// Fetch the student's profile data
$student_id = $_SESSION['id'];
$query = "SELECT * FROM student WHERE student_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $student = $result->fetch_assoc();
} else {
    echo "Error fetching student profile.";
    exit();
}
?>

<?php include('includes/nav.php'); ?>


<body>
    <div class="container mt-5">
        <h1 class="mb-4">My Profile</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Profile Information</h5>
                <p class="card-text"><strong>First Name:</strong> <?php echo htmlspecialchars($student['firstname']); ?></p>
                <p class="card-text"><strong>Last Name:</strong> <?php echo htmlspecialchars($student['lastname']); ?></p>
                <p class="card-text"><strong>Student Number:</strong> <?php echo htmlspecialchars($student['student_no']); ?></p>
                <p class="card-text"><strong>Course:</strong> <?php echo htmlspecialchars($student['course']); ?></p>
                <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($student['email']); ?></p>
            </div>
        </div>
    </div>
    
    
    <?php include('includes/scripts.php') ?>


</body>
</html>
