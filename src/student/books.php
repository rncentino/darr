<?php 
session_start();
require("../php/db_conn.php");
require('includes/auth.php');

include('includes/header.php'); 

// Fetch book data
$sql = "SELECT * FROM book";
$result = $conn->query($sql);
?>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->

    <?php include('includes/nav.php') ?>

    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">Books</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-shopping-cart fs-6"></i>
                      <p class="mb-0 fs-3">My Cart</p>
                    </a>
                    <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      
      <!--  Header End -->
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Books</h5>
            <div class="row">
              <?php 
              if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                  echo '<div class="col-sm-6 col-xl-3">';
                  echo '<div class="card overflow-hidden rounded-2">';
                  echo '<div class="position-relative">';
                  // Add max height for img
                  echo '<a href="javascript:void(0)"><img src="../admin/uploads/books/'.$row['image'].'" class="card-img-top rounded-0" alt="..." style="max-height: 300px;"></a>';
                  echo '<a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart"><i class="ti ti-basket fs-4"></i></a>';
                  echo '</div>';
                  echo '<div class="card-body pt-3 p-4">';
                  echo '<h6 class="fw-semibold fs-4">'.$row['title'].'</h6>';
                  echo '<p class="text-muted">'.$row['author'].'</p>';
                  echo '<div class="d-flex align-items-center justify-content-between">';
                  echo '<h6 class="fw-semibold fs-4 mb-0">$'.$row['price'].'</h6>';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                }
              } else {
                echo "0 results";
              }
              $conn->close();
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include('includes/scripts.php') ?>
</body>

</html>
