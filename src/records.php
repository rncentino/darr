<?php 
session_start();
require("components/db_conn.php");
include('components/header.php'); 
// include('components/auth.php');

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

            <!-- record list -->
            <div class="row">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title fw-semibold">Manage Records</h5>
                                <div class="d-flex align-items-center">
                                    <!-- Search Bar -->
                                    <div class="mx-3">
                                        <form class="d-flex" action="record-search.php" method="get">
                                            <div class="input-group">
                                                <input type="text" id="search" name="q" class="form-control" placeholder="Search...">
                                                <button type="submit" class="btn btn-success" aria-label="Search" disabled>
                                                    <i class="ti ti-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Add Record Button -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRecordModal">
                                        <i class="ti ti-plus"></i> Add Record
                                    </button>
                                </div>
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
                                                                <h6 class="fw-semibold mb-0">Location</h6>
                                                            </th>
                                                            <th class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0">Geodetic Engr.</h6>
                                                            </th>
                                                            <th class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0">Map</h6>
                                                            </th>
                                                            <th class="border-bottom-0">
                                                                <h6 class="fw-semibold mb-0">Actions</h6>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="search-results">
                                                        <!-- Records will be loaded here via AJAX -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pagination -->
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end" id="pagination">
                                    <!-- Pagination links will be loaded here via AJAX -->
                                </ul>
                            </nav>

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

      <!-- View Img Modal (to be implemented)-->
      <div class="modal fade" id="viewImgModal" tabindex="-1" aria-labelledby="viewImgModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="viewImgModalLabel">Image Viewer</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- ?? -->
              
            </div>
            
          </div>
        </div>
      </div>
      <!-- End View Img Modal -->

      <!-- View Record Modal -->
      <div class="modal fade" id="viewRecordModal" tabindex="-1" aria-labelledby="viewRecordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="viewRecordModal">Record Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div id="recordDetails">

              </div>
            </div>
            
          </div>
        </div>
      </div>
      <!-- End View Record Modal -->


      <!-- Edit Record Modal -->
      <div class="modal fade" id="editRecordModal" tabindex="-1" aria-labelledby="editRecordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editRecordModal">Edit Record Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div id="recordDetails">

              </div>
            </div>
            
          </div>
        </div>
      </div>
      <!-- End Edit Record Modal -->

      <!-- Delete Record Modal -->
      <!-- End Record Modal  -->
      
    </div>
  </div>

</body>


<!-- scripts -->
<?php include('components/scripts.php') ?>
<script>

//sweet alert toast
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

// fetch record
$(document).ready(function() {
    function loadRecords(page) {
        $.ajax({
            url: "backend/record-fetch.php",
            type: "GET",
            data: { page: page },
            success: function(response) {
                $("#search-results").html(response.records);
                $("#pagination").html(response.pagination);
            }
        });
    }

    // Initial load
    loadRecords(1);

    // Handle pagination click
    $(document).on("click", ".page-link", function(e) {
        e.preventDefault();
        var page = $(this).data("page");
        loadRecords(page);
    });
});

// add record
$(document).ready(function() {
    $('#addRecordForm').submit(function(e) {
        e.preventDefault(); 

        $.ajax({
            url: 'backend/record-add.php',
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

                    setTimeout(function() {
                        $('#countTableS').load(location.href + ' #recordTable');
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

// pdf viewer
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

// edit record


// search function
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    const searchResults = document.getElementById('search-results');

    searchInput.addEventListener('input', function() {
        const query = searchInput.value;

        if (query.length > 5) { 
            fetch('record-search.php?q=' + encodeURIComponent(query))
                .then(response => response.text())
                .then(data => {
                    searchResults.innerHTML = data;
                })
                .catch(error => console.error('Error:', error));
        } else {
            searchResults.innerHTML = '';
        }
    });
});

</script>
