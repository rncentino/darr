<?php 
session_start();
require("db_conn.php");
include('header.php'); 
// include('auth.php'); 
?>

<body>
  <!-- Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper">
    <!-- Main wrapper -->
    <div class="body-wrapper">

      <!-- Header Start -->
      <?php include('nav.php') ?>
      <!-- Header End -->

      <!-- Tables Section-->
      <div class="container-fluid">
        <div class="card bg-secondary-subtle">
          <div class="card-body">
            <h2 class="fw-bold mb-4 p-3 border-bottom border-success border-3">DAR SURVEY TEAM DMS</h2>
            <div class="row">
              <div class="container-fluid">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h5 class="card-title fw-semibold">Manage Records</h5>
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addRecordModal"> 
                        <i class="ti ti-plus"></i> Add Record 
                      </button>
                    </div>
                    <div class="row" id="recordTable">
                      <div class="col-lg-12 d-flex align-items-stretch">
                        <div class="card w-100">
                          <div class="card-body p-4">
                            <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle table-striped">

                                <thead class="text-dark fs-4">
                                  <tr>
                                    <th class="border-bottom-0">
                                      <h6 class="fw-semibold mb-0">OTC/TCT</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                      <h6 class="fw-semibold mb-0">Lot No.</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                      <h6 class="fw-semibold mb-0">Survey No.</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                      <h6 class="fw-semibold mb-0">Survey Type</h6>
                                    </th>
                                    <!-- <th class="border-bottom-0">
                                      <h6 class="fw-semibold mb-0">Sheet No.</h6>
                                    </th> -->
                                    <th class="border-bottom-0">
                                      <h6 class="fw-semibold mb-0">Area</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                      <h6 class="fw-semibold mb-0">Location </h6>
                                      <!-- <span class="fw-normal"><i>( Municipality, Brgy. )<i></span> -->
                                    </th>
                                    <th class="border-bottom-0">
                                      <h6 class="fw-semibold mb-0">Land Owner</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                      <h6 class="fw-semibold mb-0">Geodetic Engr.</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                      <h6 class="fw-semibold mb-0">Date Approved</h6>
                                    </th>
                                    
                                    <!-- <th class="border-bottom-0">
                                      <h6 class="fw-semibold mb-0">Upload at</h6>
                                    </th> -->
                                    <th class="border-bottom-0">
                                      <h6 class="fw-semibold mb-0">Map</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                      <h6 class="fw-semibold mb-0">Actions</h6>
                                    </th>
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $query = "SELECT id, OCT_TCT_no, lot_no, survey_no, sheet_no, area, date_approved, municipality, brgy, land_owner, geodetic_engr, survey_type, uploaded_at, map FROM records";
                                    $result = $conn->query($query);

                                    if ($result->num_rows > 0) {
                                      while ($row = $result->fetch_assoc()) {
                                          echo "<tr>";
                                          echo "<td class='border-bottom-0'><h6 class='fw-semibold mb-1'>{$row['OCT_TCT_no']}</h6></td>";
                                          echo "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['lot_no']}</p></td>";
                                          echo "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['survey_no']}</p></td>";
                                          echo "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['survey_type']}</p></td>";
                                          // echo "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['sheet_no']}</p></td>";
                                          echo "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['area']}</p></td>";
                                          echo "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['municipality']}, {$row['brgy']}</p></p></td>";
                                          echo "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['land_owner']}</p></td>";
                                          echo "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['geodetic_engr']}</p></td>";
                                          echo "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['date_approved']}</p></td>";
                                          
                                          // echo "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['user_id']}</p></td>";
                                          // echo "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['uploaded_at']}</p></td>";
                                          echo "<td class='border-bottom-0'><p class='mb-0 fw-normal'>
                                              <button href='uploads/{$row['map']}' class='btn btn-success view-pdf-btn' data-bs-toggle='modal' data-bs-target='#viewPDFModal'>
                                                        <i class='ti ti-file-text'></i>
                                              </button>
                                             <button href='uploads/{$row['map']}' class='btn btn-secondary view-pdf-btn' data-bs-toggle='modal' data-bs-target='#viewPDFModal'>
                                                        <i class='ti ti-photo'></i>
                                              </button>
                                                </td>";
                                          
                                          echo "<td class='border-bottom-0'> 
                                              
                                              <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editRecordModal' onclick='editRecord({$row['id']})'>
                                                <i class='ti ti-eye'></i>
                                              </button>                                                              
                                              <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editRecordModal' onclick='editRecord({$row['id']})'>
                                                <i class='ti ti-edit'></i>
                                              </button>
                                              <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteRecordModal' onclick='deleteRecord({$row['id']})'>
                                                <i class='ti ti-trash'></i>
                                              </button>
                                          </td>";
                                          echo "</tr>";
                                      }
                                    } else {
                                      echo "<tr><td colspan='15' class='border-bottom-0'><h6 class='fw-semibold mb-0 text-center'>No data available</h6></td></tr>";
                                    }
                                  ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

     

      <!-- Modals -->
      <!-- Add Record Modal -->
      <div class="modal fade" id="addRecordModal" tabindex="-1" aria-labelledby="addRecordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addRecordModalLabel">Add Record</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="addRecordForm" class="row g-3">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="OCT_TCT_no" class="form-label">OTC/TCT No</label>
                    <input type="text" class="form-control" id="OCT_TCT_no" name="OCT_TCT_no" required>
                  </div>
                  <div class="mb-3">
                    <label for="lot_no" class="form-label">Lot No</label>
                    <input type="text" class="form-control" id="lot_no" name="lot_no" required>
                  </div>
                  <div class="mb-3">
                    <label for="survey_no" class="form-label">Survey No</label>
                    <input type="text" class="form-control" id="survey_no" name="survey_no" required>
                  </div>
                  <div class="mb-3">
                    <label for="sheet_no" class="form-label">Sheet No</label>
                    <input type="text" class="form-control" id="sheet_no" name="sheet_no" required>
                  </div>
                  <div class="mb-3">
                    <label for="area" class="form-label">Area</label>
                    <input type="text" class="form-control" id="area" name="area" required>
                  </div>
                  <div class="mb-3">
                    <label for="date_approved" class="form-label">Date Approved</label>
                    <input type="date" class="form-control" id="date_approved" name="date_approved" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="municipality" class="form-label">Municipality</label>
                    <input type="text" class="form-control" id="municipality" name="municipality" required>
                  </div>
                  <div class="mb-3">
                    <label for="brgy" class="form-label">Brgy</label>
                    <input type="text" class="form-control" id="brgy" name="brgy" required>
                  </div>
                  <div class="mb-3">
                    <label for="land_owner" class="form-label">Land Owner</label>
                    <input type="text" class="form-control" id="land_owner" name="land_owner" required>
                  </div>
                  <div class="mb-3">
                    <label for="geodetic_engr" class="form-label">Geodetic Engr.</label>
                    <input type="text" class="form-control" id="geodetic_engr" name="geodetic_engr" required>
                  </div>
                  <div class="mb-3">
                    <label for="survey_type" class="form-label">Survey Type</label>
                    <input type="text" class="form-control" id="survey_type" name="survey_type" required>
                  </div>
                  <div class="mb-3">
                    <label for="map" class="form-label">Map</label>
                    <input type="file" class="form-control" id="map" name="map" required>
                  </div>
                </div>
                <button type="submit" class="btn btn-success">Add Record</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- End Add Record Modal -->

      <!-- View PDF Modal -->
      <div class="modal fade" id="viewPDFModal" tabindex="-1" aria-labelledby="viewPDFModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="viewPDFModalLabel">PDF Viewer</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div id="pdfViewer" class="pdf-viewer-container">
                <!-- PDF Here -->
              </div>
            </div>
            
          </div>
        </div>
      </div>
      <!-- End View PDF Modal -->

      <!-- View Record Modal -->
      


      
    </div>
  </div>

</body>

<script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <script src="assets/libs/jquery/dist/pdfobject.min.js"></script>



<script>

const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false, 
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});


$(document).ready(function() {
    $('#addRecordForm').submit(function(e) {
        e.preventDefault(); 

        $.ajax({
            url: 'add-record.php',
            type: 'POST', 
            data: new FormData(this), 
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                if (response.trim() === "success") {
                    Toast.fire({
                        icon: 'success',
                        title: 'Record added successfully!'
                    });
                    
                    $('#addRecordForm')[0].reset();
                    $('#addRecordModal').modal('hide');

                    setTimeout(function() {
                        $('#recordTable').load(location.href + ' #recordTable');
                    }, 500);

                } else {
                    Toast.fire({
                        icon: 'error',
                        title: response
                    });
                }
            },
            error: function(xhr, status, error) {
                Toast.fire({
                    icon: 'error',
                    title: 'Failed to add record. Please try again later.'
                });
            }
        });
    });
});


$(document).ready(function() {
    $('.view-pdf-btn').click(function(e) {
        e.preventDefault();
        var pdfUrl = $(this).attr('href');
        
        PDFObject.embed(pdfUrl, '#pdfViewer', {
            height: "450px",
            width: "100%",  
        });
    });
});







</script>
