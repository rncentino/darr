<?php
session_start();
require("../php/db_conn.php");
require('includes/auth.php');

include('includes/header.php');
?>



<body>
  <!-- Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php include('includes/nav.php') ?>
    <!-- Sidebar End -->
    <!-- Main wrapper -->
    <div class="body-wrapper">
      <!-- Header Start -->
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
                    <a href="../logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Header End -->
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h5 class="card-title fw-semibold">Manage Students</h5>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal"> <i class="ti ti-plus"></i> Add Student</button>
            </div>
            <div class="row"  id="membersTable">
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
                              <h6 class="fw-semibold mb-0">Student No.</h6>
                            </th>
                            <th class="border-bottom-0">
                              <h6 class="fw-semibold mb-0">Course</h6>
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
                          
                            $query = "SELECT student_id, firstname, lastname, student_no, course, email FROM student";
                            $result = $conn->query($query);

                          if ($result->num_rows > 0) {
                              while ($row = $result->fetch_assoc()) {
                                  echo "<tr>";
                                  echo "<td class='border-bottom-0'><h6 class='fw-semibold mb-1'>{$row['lastname']}, {$row['firstname']}</h6></td>";
                                  echo "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['student_no']}</p></td>";
                                  echo "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['course']}</p></td>";
                                  echo "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['email']}</p></td>";
                                  echo "<td class='border-bottom-0'>
                                          <button class='btn btn-secondary' data-bs-toggle='modal' data-bs-target='#editUserModal' onclick='editUser({$row['student_id']})'>
                                            <i class='ti ti-edit'></i>
                                          </button>
                                          <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteUserModal' onclick='deleteUser({$row['student_id']})'>
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


  <!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Add Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addUserForm">
        <!-- <div class="mb-3">
            <label for="profile" class="form-label">Profile</label>
            <input type="file" class="form-control" id="profile" name="profile" required>
          </div> -->
          <div class="mb-3">
            <label for="firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" required>
          </div>
          <div class="mb-3">
            <label for="lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
          </div>
          <div class="mb-3">
            <label for="student_no" class="form-label">Student No</label>
            <input type="text" class="form-control" id="student_no" name="student_no" required>
          </div>
          <div class="mb-3">
            <label for="course" class="form-label">Course</label>
            <input type="text" class="form-control" id="course" name="course" required>
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
      
         
          <button type="submit" class="btn btn-primary">Add Student</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editUserModalLabel">Edit Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editUserForm">
            <input type="hidden" id="edit_student_id" name="student_id">
            <div class="mb-3">
              <label for="edit_firstname" class="form-label">First Name</label>
              <input type="text" class="form-control" id="edit_firstname" name="firstname" required>
            </div>
            <div class="mb-3">
              <label for="edit_lastname" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="edit_lastname" name="lastname" required>
            </div>
            <div class="mb-3">
              <label for="edit_student_no" class="form-label">Student No</label>
              <input type="text" class="form-control" id="edit_student_no" name="student_no" required>
            </div>
          
            <div class="mb-3">
              <label for="edit_course" class="form-label">Course</label>
              <input type="text" class="form-control" id="edit_course" name="course" required>
            </div>
            <div class="mb-3">
              <label for="edit_email" class="form-label">Email</label>
              <input type="email" class="form-control" id="edit_email" name="email" required>
            </div>

            <!-- <div class="mb-3">
              <label for="edit_password" class="form-label">Password</label>
              <input type="password" class="form-control" id="edit_password" name="password">
            </div>  -->
              
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

 <!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteUserModalLabel">Delete User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this user?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
      </div>
    </div>
  </div>
</div>




  <?php include('includes/scripts.php')?>
</body>

<script>

// Declare Toast outside of the event listener so it can be used globally
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

document.getElementById("addUserForm").addEventListener("submit", function(event) {
  event.preventDefault();

  const formData = new FormData(this);

  fetch("crud.php", {
    method: "POST",
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      // Close the modal
      var myModalEl = document.getElementById('addUserModal');
      var modal = bootstrap.Modal.getInstance(myModalEl);
      modal.hide();

      // Display success toast message
      Toast.fire({
        icon: "success",
        title: "User added successfully"
      });

      // Delay page reload to ensure the toast message is displayed
      setTimeout(function() {
        $('#membersTable').load(location.href + ' #membersTable');
      }); // Adjust the delay time as needed
    } else {
      alert("Error: " + data.message);
    }
  })
  .catch(error => {
    console.error("Error:", error);
  });
});


function editUser(studentID) {
    // Fetch user details and populate the form
    fetch(`crud.php?id=${studentID}`)
        .then(response => response.json())
        .then(data => {
            if (data.success !== false) {
                document.getElementById("edit_student_id").value = data.student_id;
                document.getElementById("edit_firstname").value = data.firstname;
                document.getElementById("edit_lastname").value = data.lastname;
                document.getElementById("edit_student_no").value = data.student_no;
                document.getElementById("edit_course").value = data.course;
                document.getElementById("edit_email").value = data.email;
                document.getElementById("edit_password").value = "";  // Leave the password field empty
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
}

document.getElementById("editUserForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    const formData = new FormData(this);

    fetch("crud.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Close the modal
            var editModalEl = document.getElementById('editUserModal');
            var editModal = bootstrap.Modal.getInstance(editModalEl);
            editModal.hide();

            // Display success toast message
            Toast.fire({
                icon: "success",
                title: "User updated successfully"
            });

            // Delay page reload to ensure the toast message is displayed
            setTimeout(function() {
                $('#membersTable').load(location.href + ' #membersTable');
            });

        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});



// Define deleteUserId globally
let deleteStudentId;

// JavaScript to handle deleting user
function deleteUser(studentId) {
    // Assign studentId to deleteStudentId
    deleteStudentId = studentId;
}

// Confirm deletion
document.getElementById("confirmDeleteButton").addEventListener("click", function() {
    // Check if deleteStudentId is defined
    if (typeof deleteStudentId !== 'undefined') {
        fetch(`crud.php?delete_id=${deleteStudentId}`, { 
            method: "GET"
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Close the modal
                var deleteModalEl = document.getElementById('deleteUserModal');
                var deleteModal = bootstrap.Modal.getInstance(deleteModalEl);
                deleteModal.hide();

                // Display success toast message
                Toast.fire({
                    icon: "success",
                    title: "User deleted successfully"
                });

                // Delay page reload to ensure the toast message is displayed
                setTimeout(function() {
                    $('#membersTable').load(location.href + ' #membersTable');
                }); 
            } else {
                alert("Error: " + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    } else {
        alert("Error: User ID is undefined");
    }
});



</script>

</html>

<?php
$conn->close();
?>
