<?php
session_start();
include('php/db_conn.php');

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Sanitize and escape input to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    
   
    // Query to check if the provided credentials match any admin record
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        
        // Login successful, start a session
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $user['id'];  // Store user_id in session
        
        // Redirect to the dashboard or any other page
        header("Location: ../src/index.php");
        exit;
    } else {
        $error_message = "Invalid email or password. Please try again.";
    }
}
?>

<?php include("header.php") ?>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="admin-login.php" class="text-nowrap logo-img text-center d-block py-3">
                                    <img src="assets/images/logos/dar-logo.png" width="auto" alt="">
                                </a>
                                <form action="#" method="POST">
                                    <?php if (!empty($error_message)): ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php echo $error_message; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100 py-3 fs-4 mb-4 rounded-2">Log In</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a class="text-success fw-bold ms-2" href="./register.php">Create an account</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
