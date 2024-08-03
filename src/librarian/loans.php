<?php
session_start();
require("../php/db_conn.php");
require('includes/auth.php');

include('includes/header.php'); 


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
                    <a href="../librarian/logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->



<!-- Issue Book Modal -->
<div class="modal fade" id="issueBookModal" tabindex="-1" aria-labelledby="issueBookModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="issueBookModalLabel">Issue Book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="issueBookForm">
          <div class="mb-3">
            <label for="studentNo" class="form-label">Student Number</label>
            <select id="studentNo" name="student_id" class="form-select" required>
              <option value="">Select Student</option>
              <?php
              $students = $conn->query("SELECT student_id, student_no, firstname, lastname FROM student");
              while($student = $students->fetch_assoc()) {
                  // Concatenate first name, last name, and student number
                  $student_info = $student['firstname'] . " " . $student['lastname'] . " (" . $student['student_no'] . ")";
                  echo "<option value='".$student['student_id']."'>".$student_info."</option>";
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="isbn" class="form-label">Book ISBN</label>
            <select id="isbn" name="book_copy_id" class="form-select" required>
                <option value="">Select Book</option>
                <?php
$books = $conn->query("SELECT bc.book_copy_id, bk.isbn, bk.title FROM bookcopy bc JOIN book bk ON bc.book_id = bk.book_id WHERE bc.status = 'available'");

$unique_isbns = array(); // Initialize an array to track unique ISBNs

while ($book = $books->fetch_assoc()) {
    if (!in_array($book['isbn'], $unique_isbns)) { // Check if the ISBN is already added
        // Concatenate ISBN and book title
        $book_info = $book['isbn'] . " - " . $book['title'];
        echo "<option value='" . $book['book_copy_id'] . "'>" . $book_info . "</option>";
        $unique_isbns[] = $book['isbn']; // Add the ISBN to the array
    }
}
?>


            </select>
          </div>
          <button type="submit" class="btn btn-primary">Issue Book</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Return Book Modal -->
<div class="modal fade" id="returnBookModal" tabindex="-1" aria-labelledby="returnBookModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="returnBookModalLabel">Return Book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Is the book returned?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="confirmReturn">Yes</button>
      </div>
    </div>
  </div>
</div>


      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h5 class="card-title fw-semibold">Manage Loans and Returns</h5>
              <!-- create a modal for this would issue a book to a student -->
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#issueBookModal"> <i class="ti ti-book"></i> Issue Book</button>
            </div>
            <div class="row" id="LoansTable">
              <div class="col-lg-100 d-flex align-items-stretch">
                <div class="card w-100">
                  <div class="card-body p-4">
                    <div class="table-responsive" >
                      <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                          <tr>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Image</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Title</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">ISBN</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Edition</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Name</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Librarian</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Date Borrowed</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Due Date</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Date Returned</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Action</h6></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                              $sql = "SELECT b.borrow_id, bc.book_copy_id, b.date_borrowed, b.due_date, b.date_returned, s.firstname, s.lastname, bk.image, bk.title, bk.isbn, bk.edition, l.firstname AS librarian_firstname, l.lastname AS librarian_lastname
                                      FROM borrow b
                                      JOIN student s ON b.student_id = s.student_id
                                      JOIN bookcopy bc ON b.book_copy_id = bc.book_copy_id
                                      JOIN book bk ON bc.book_id = bk.book_id
                                      LEFT JOIN librarian l ON b.librarian_id = l.librarian_id";
                              

                              $result = $conn->query($sql);
                              if ($result->num_rows > 0) {
                                  while($row = $result->fetch_assoc()) {
                                      echo "<tr>";
                                      echo "<td><img src='../admin/uploads/books/".$row['image']."' class='img-fluid' style='max-height: 50px;'></td>";
                                      echo "<td>".$row['title']."</td>";
                                      echo "<td>".$row['isbn']."</td>";
                                      echo "<td>".$row['edition']."</td>";
                                      echo "<td>".$row['firstname']." ".$row['lastname']."</td>";
                                      echo "<td>".$row['librarian_firstname']." ".$row['librarian_lastname']."</td>";
                                      echo "<td>".$row['date_borrowed']."</td>";
                                      echo "<td>".$row['due_date']."</td>";
                                      echo "<td>".($row['date_returned'] ? $row['date_returned'] : "<span class='badge bg-danger rounded-3 fw-semibold'>Not Returned</span>")."</td>";
                                      
                                      // Check if date_returned is empty
                                      if(empty($row['date_returned'])) {
                                          echo "<td><button class='btn btn-secondary return-book' data-id='".$row['borrow_id']."' data-bs-toggle='modal' data-bs-target='#returnBookModal'>
                                          <i class='ti ti-arrow-back'></i></button></td>";
                                      } else {
                                          echo "<td><button class='badge bg-success rounded-3 fw-semibold' data-id='".$row['borrow_id']."' data-bs-toggle='modal' data-bs-target='#returnBookModal' disabled>Returned</button></td>";
                                      }
                                      
                                      echo "</tr>";
                                  }
                              } else {
                                  echo "<tr><td colspan='9'>No borrow records found.</td></tr>";
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

  <?php include('includes/scripts.php')?>
  
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

  $(document).ready(function(){
    let returnBorrowId;

    // Capture borrow ID when return button is clicked
    $(document).on('click', '.return-book', function() {
      returnBorrowId = $(this).data('id');
    });

    // Handle return book confirmation
    $('#confirmReturn').on('click', function() {
      $.ajax({
        url: 'return_book.php',
        type: 'POST',
        data: { borrow_id: returnBorrowId },
        success: function(response) {
          Toast.fire({
            icon: 'success',
            title: 'Book returned successfully!'
          });
          $('#returnBookModal').modal('hide');

          // Reload the table
          setTimeout(function() {
            $('#LoansTable').load(location.href + ' #LoansTable');
          }, 500);
        },
        error: function(xhr, status, error) {
          Toast.fire({
            icon: 'error',
            title: 'Error',
            text: xhr.responseText
          });
        }
      });
    });

    // Issue book form submission
    $('#issueBookForm').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        url: 'issue_book.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
          Toast.fire({
            icon: 'success',
            title: 'Book added successfully!'
          });
          $('#issueBookModal').modal('hide');

          // Reload the table
          setTimeout(function() {
            $('#LoansTable').load(location.href + ' #LoansTable');
          }, 500);
        },
        error: function(xhr, status, error) {
          Toast.fire({
            icon: 'error',
            title: 'Error',
            text: xhr.responseText
          });
        }
      });
    });
  });
</script>

</body>

</html>
