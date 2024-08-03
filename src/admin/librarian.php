<?php
session_start();
require_once("../php/db_conn.php");

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("Location: ../admin-login.php");
  exit;
}

?>

<?php include('includes/header.php') ?>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
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
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="../admin/logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
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
          <div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="card-title fw-semibold">Manage Librarian</h5>

    
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addlibrarian"> <i class="ti ti-plus"></i> Add Librarian </button>
</div>
            <div class="row" id="librarianTable">
          
          <div class="col-lg-100 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                  
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Name</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Email</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Action</h6>
                        </th>
                        

                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $query = "SELECT librarian_id, firstname, lastname, email FROM librarian";
                      $result = $conn->query($query);

                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='border-bottom-0'><h6 class='fw-semibold mb-1'>{$row['lastname']}, {$row['firstname']}</h6></td>";
                            echo "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['email']}</p></td>";
                            echo "<td class='border-bottom-0'>
                                <button class='btn btn-secondary' data-bs-toggle='modal' data-bs-target='#editUserModal' onclick='editUser({$row['librarian_id']})'>
                                  <i class='ti ti-edit'></i>
                                </button>
                                <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteLibrarianModal' onclick='deleteUser({$row['librarian_id']})'>
                                  <i class='ti ti-trash'></i>
                                </button>

                            </td>";
                            echo "</tr>";
                        }
                      } else {
                        echo "<tr><td colspan='5' class='border-bottom-0'><h6 class='fw-semibold mb-0 text-center'>No data available</h6></td></tr>";
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


<!-- Add Librarian Modal -->
<div class="modal fade" id="addlibrarian" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Add Librarian</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addLibrarianForm" method="POST" enctype="multipart/form-data">
      
          <div class="mb-3">
            <label for="firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" required>
          </div>
          <div class="mb-3">
            <label for="lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" required>
                <button type="button" class="btn btn-outline-secondary" id="show-password-button" onclick="togglePasswordVisibility()">
                    <i class="ti ti-eye" id="eye-icon"></i>
                </button>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Add Librarian</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Edit Librarian Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editUserModalLabel">Edit Librarian</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editLibrarianForm">
          <input type="hidden" id="edit_user_id" name="user_id">
            <div class="mb-3">
              <label for="edit_firstname" class="form-label">First Name</label>
              <input type="text" class="form-control" id="edit_firstname" name="firstname" required>
            </div>
            <div class="mb-3">
              <label for="edit_lastname" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="edit_lastname" name="lastname" required>
            </div>
            <div class="mb-3">
              <label for="edit_email" class="form-label">Email</label>
              <input type="email" class="form-control" id="edit_email" name="email" required>
            </div>
           
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
</div>

<!-- Delete Librarian Modal -->
<div class="modal fade" id="deleteLibrarianModal" tabindex="-1" aria-labelledby="deleteLibrarianModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteLibrarianModalLabel">Delete Librarian</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this librarian?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteLibrarianButton">Delete</button>
      </div>
    </div>
  </div>
</div>



  <?php include('includes/scripts.php')?>

  <script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var eyeIcon = document.getElementById("eye-icon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("ti-eye");
            eyeIcon.classList.add("ti-eye-off");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("ti-eye-off");
            eyeIcon.classList.add("ti-eye");
        }
    }

    


// Initialize SweetAlert Toast
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

document.getElementById("addLibrarianForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch("librarian-add.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            var myModalEl = document.getElementById('addlibrarian');
            var modal = bootstrap.Modal.getInstance(myModalEl);
            modal.hide();
            

            // Display success message using Toast
            Toast.fire({
                icon: 'success',
                title: 'Librarian added successfully'
            });

            // Reload the table after a short delay to ensure the toast is visible
            setTimeout(function() {
                $('#librarianTable').load(location.href + ' #librarianTable');
            });
        } else {
            // Display error message using Toast
            Toast.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error adding librarian: ' + data.message
            });
        }
    })
    .catch(error => {
        // Handle any network errors
        console.error('Error:', error);
        Toast.fire({
            icon: 'error',
            title: 'Network Error',
            text: 'There was a problem with the network connection.'
        });
    });
});


//fetvh
function editUser(librarianId){
    fetch(`librarian-edit.php?librarian_id=${librarianId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Populate the edit form fields with fetched data
                document.getElementById("edit_user_id").value = librarianId;
                document.getElementById("edit_firstname").value = data.librarian.firstname;
                document.getElementById("edit_lastname").value = data.librarian.lastname;
                document.getElementById("edit_email").value = data.librarian.email;
                
            } else {
                // Handle error
                Toast.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error fetching librarian data: ' + data.message
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Toast.fire({
                icon: 'error',
                title: 'Network Error',
                text: 'There was a problem with the network connection.'
            });
        });
}

//update
document.getElementById("editLibrarianForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch("librarian-edit.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // If update is successful, close the modal
            var myModalEl = document.getElementById('editUserModal');
            var modal = bootstrap.Modal.getInstance(myModalEl);
            modal.hide();

            // Display success message using Toast
            Toast.fire({
                icon: 'success',
                title: 'Librarian data updated successfully'
            });

            // Reload the table after a short delay to ensure the toast is visible
            setTimeout(function() {
                $('#librarianTable').load(location.href + ' #librarianTable');
            });
        } else {
            // If update fails, display error message using Toast
            Toast.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error updating librarian data: ' + data.message
            });
        }
    })
    .catch(error => {
        // Handle any network errors
        console.error('Error:', error);
        Toast.fire({
            icon: 'error',
            title: 'Network Error',
            text: 'There was a problem with the network connection.'
        });
    });
});



 // Delete function
let deleteLibrarianId;

// JavaScript to handle deleting user
function deleteUser(librarianId) {
    // Assign librarianId to deleteLibrarianId
    deleteLibrarianId = librarianId;
}

document.getElementById("confirmDeleteLibrarianButton").addEventListener("click", function() {
    // Check if deleteLibrarianId is defined
    if (typeof deleteLibrarianId !== 'undefined') {
        fetch(`librarian-delete.php?librarian_id=${deleteLibrarianId}`, { 
            method: "GET"
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Close the modal
                var deleteModalEl = document.getElementById('deleteLibrarianModal');
                var deleteModal = bootstrap.Modal.getInstance(deleteModalEl);
                deleteModal.hide();

                // Display success toast message
                Toast.fire({
                    icon: "success",
                    title: "User Deleted successfully"
                });

                // Delay page reload to ensure the toast message is displayed
                setTimeout(function() {
                    $('#librarianTable').load(location.href + ' #librarianTable');
                }); // Adjust the delay time as needed
            } else {
                alert("Error: " + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    } else {
        alert("Error: Librarian ID is undefined");
    }
});

  </script>
  
</body>

</html>