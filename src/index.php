<?php 
session_start();
require("components/db_conn.php");
include('components/header.php'); 
// include('auth.php');

?>

<body>
  <!-- Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper">
    <!-- Main wrapper -->
    <div class="body-wrapper">



    
      <!-- Header Start -->
      <?php include('components/nav.php') ?>
      <!-- Header End -->

      <!-- Tables Section-->
      <div class="container-fluid">
        <div class="card bg-secondary-subtle">
          <div class="card-body">
            <h2 class="fw-bold mb-4 p-3 border-bottom border-success border-3">DAR Survey Team Dashboard</h2>

            <!-- stats record -->
            <?php include('backend/counts.php') ?>
            <div class="row" id="countTable">
              <div class="col-md-4">
                  <div class="card card-stats card-round">
                      <div class="card-body">
                          <div class="row align-items-center">
                              <div class="col-auto">
                                  <div class="bg-primary rounded-2 p-4 d-flex align-items-center justify-content-center">
                                      <i class="ti ti-files text-white" style="font-size: 1rem;"></i>
                                  </div>
                              </div>
                              <div class="col ms-3">
                                  <div class="numbers">
                                      <p class="card-category">Files</p>
                                      <h4 class="card-title">
                                          <?php echo $file_count; ?>
                                      </h4>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="card card-stats card-round">
                      <div class="card-body">
                          <div class="row align-items-center">
                              <div class="col-auto">
                                  <div class="bg-success rounded-2 p-4 d-flex align-items-center justify-content-center">
                                      <i class="ti ti-folders text-white" style="font-size: 1rem;"></i>
                                  </div>
                              </div>
                              <div class="col ms-3">
                                  <div class="numbers">
                                      <p class="card-category">Record</p>
                                      <h4 class="card-title">
                                          <?php echo $record_count; ?>
                                      </h4>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="card card-stats card-round">
                      <div class="card-body">
                          <div class="row align-items-center">
                              <div class="col-auto">
                                  <div class="bg-warning rounded-2 p-4 d-flex align-items-center justify-content-center">
                                      <i class="ti ti-users text-white" style="font-size: 1rem;"></i>
                                  </div>
                              </div>
                              <div class="col ms-3">
                                  <div class="numbers">
                                      <p class="card-category">Users</p>
                                      <h4 class="card-title">
                                          <?php echo $user_count; ?>
                                      </h4>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <!-- stats end -->

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <!-- Insert Leftlet File Layer Plug-In -->
                    </div>  
                </div>
            </div>

           

           

          </div>
        </div>
      </div>

      </div>
  </div>

</body>

<?php include('components/scripts.php') ?>

