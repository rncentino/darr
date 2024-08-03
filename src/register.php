<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="assets/css/styles.min.css" />
    <link rel="stylesheet" href="assets/libs/sweetalert2/dist/sweetalert2.min.css">
</head>
<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-10 col-lg-8 col-xxl-6"> <!-- Increased size of the form -->
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-150">
                  <img src="assets/images/logos/dar-logo.png" alt="">
                </a>
                <form id="saveStudent">
                  <div class="row">
                    <div class="col-md-4 mb-3">
                      <label for="firstname" class="form-label">First Name</label>
                      <input type="text" class="form-control" name="firstname" id="firstname">
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="lastname" class="form-label">Last Name</label>
                      <input type="text" class="form-control" name="lastname" id="lastname">
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="middlename" class="form-label">Middle Name</label>
                      <input type="text" class="form-control" name="middlename" id="middlename">
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="birthday" class="form-label">Birthday</label>
                      <input type="date" class="form-control" name="birthday" id="birthday">
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="student_no" class="form-label">Student Number</label>
                      <input type="text" class="form-control" name="student_no" id="student_no">
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="department" class="form-label">Department</label>
                      <input type="text" class="form-control" name="department" id="department">
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="course" class="form-label">Course</label>
                      <input type="text" class="form-control" name="course" id="course">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-4"> <!-- Email Address -->
                      <label for="email" class="form-label">Email Address</label>
                      <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="col-md-6 mb-4"> <!-- Password -->
                      <label for="password" class="form-label">Password</label>
                      <input type="password" class="form-control" name="password" id="password">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-3 fs-5 mb-4 rounded-2">Sign Up</button> <!-- Increased button size -->
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-5 mb-0 fw-bold">Already have an Account?</p>
                    <a class="text-primary fw-bold ms-2" href="../src/login.php">Log In</a>
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
  <script src="assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer);
          toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });
  </script>
</body>
</html>
