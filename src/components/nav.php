<header class="app-header mt-3">
  <nav class="navbar navbar-expand-lg navbar-light position-sticky">
    <div class="container-fluid">
      <!-- Logo Section -->
      <div class="brand-logo d-flex align-items-center justify-content-between">
        <!-- Logo Image -->
        <a href="./index.php" class="text-nowrap logo-img">
          <img src="assets/images/logos/logo.png" width="80" alt="Logo" />
        </a>
      </div>

      <!-- Center Part -->
      <div class="d-flex justify-content-center flex-grow-1">
        <ul class="navbar-nav flex-row">
          <!-- Home Button -->
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <!-- Records Button -->
          <li class="nav-item">
            <a class="nav-link" href="records.php">Records</a>
          </li>
          <!-- About Button -->
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
        </ul>
      </div>

      <!-- Right Side of Navbar -->
      <div class="d-flex align-items-center ms-auto">
        <!-- Centered Search Bar -->
        <!-- Add your search bar here if needed -->

        <!-- User Profile Dropdown -->
        <ul class="navbar-nav flex-row align-items-center">
          <li class="nav-item dropdown">
            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
              <!-- User Profile Image -->
              <img src="assets/images/profile/user-1.jpg" alt="User" width="35" height="35" class="rounded-circle">
            </a>

            <!-- Dropdown Menu -->
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
              <!-- Profile Link -->
              <!-- <a href="../student/profile.php" class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-user fs-6"></i>
                <p class="mb-0 fs-3">My Profile</p>
              </a> -->
              <!-- Borrowed Books Link -->
              <!-- <a href="../student/borrowed-books.php" class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-book fs-6"></i>
                <p class="mb-0 fs-3">My Books</p>
              </a> -->
              <!-- Cart Link -->
              <!-- <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-shopping-cart fs-6"></i>
                <p class="mb-0 fs-3">My Cart</p>
              </a> -->

              <!-- Logout Button -->
              <a href="logout.php" class="btn btn-outline-success mx-3 mt-2 d-block">Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
