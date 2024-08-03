<?php
session_start();
require("../php/db_conn.php");

include('includes/auth.php');
include('includes/header.php'); 

// Fetch the librarian's profile data
$librarian_id = $_SESSION['id'];
$query = "SELECT * FROM librarian WHERE librarian_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $librarian_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $librarian = $result->fetch_assoc();
} else {
    echo "Error fetching librarian profile.";
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
                <p class="card-text"><strong>First Name:</strong> <?php echo htmlspecialchars($librarian['firstname']); ?></p>
                <p class="card-text"><strong>Last Name:</strong> <?php echo htmlspecialchars($librarian['lastname']); ?></p>
                
    
                <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($librarian['email']); ?></p>
            </div>
        </div>
    </div>
    
    
    <?php include('includes/scripts.php') ?>


</body>
</html>
