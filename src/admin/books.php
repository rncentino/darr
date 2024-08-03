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
    <div class="body-wrapper">
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



<!-- Modals -->
<!-- Add Book Modal -->
<div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Add Book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addBookForm" class="row g-3">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="image" class="form-label">Image</label>
              <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <div class="mb-3">
              <label for="author" class="form-label">Author</label>
              <input type="text" class="form-control" id="author" name="author" required>
            </div>
            <div class="mb-3">
              <label for="publisher" class="form-label">Publisher</label>
              <input type="text" class="form-control" id="publisher" name="publisher" required>
            </div>
            <div class="mb-3">
              <label for="category" class="form-label">Category</label>
              <input type="text" class="form-control" id="category" name="category" required>
            </div>
            <div class="mb-3">
              <label for="edition" class="form-label">Edition Number</label>
              <input type="text" class="form-control" id="edition" name="edition" required>
            </div>
            
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
              <label for="isbn" class="form-label">ISBN</label>
              <input type="text" class="form-control" id="isbn" name="isbn" required>
            </div>
            <div class="mb-3">
              <label for="publication_yr" class="form-label">Publication Year</label>
              <input type="text" class="form-control" id="publication_yr" name="publication_yr" required>
            </div>
            <div class="mb-3">
              <label for="genre" class="form-label">Genre</label>
              <input type="text" class="form-control" id="genre" name="genre" required>
            </div>
            <div class="mb-3">
              <label for="price" class="form-label">Price</label>
              <input type="text" class="form-control" id="price" name="price" required>
            </div>
           
          </div>
          <button type="submit" class="btn btn-primary">Add Book</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Add Book Modal -->


<!-- Add Book Copy Modal -->
<div class="modal fade" id="addBookCopyModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Add Book Copy</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addBookCopyForm">
          <div class="mb-3">
            <label for="copies" class="form-label">Copies</label>
            <input type="number" class="form-control" id="copies" name="copies" required>
          </div>
          <button type="submit" class="btn btn-primary">Add Book Copy</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Add Book Copy Modal -->
<!-- End Modals -->


<!-- tables -->
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title fw-semibold mb-4">Manage Book</h5>

                <!-- Search  -->
                <div class="d-flex align-items-center ms-auto">
                    <div class="mx-3">
                        <form class="d-flex" method="GET" action="" id="searchForm">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" id="search" placeholder="Search...">
                                <button type="submit" class="btn btn-secondary" aria-label="Search">
                                    <i class="ti ti-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBookModal">
                    <i class="ti ti-plus"></i> Add Book
                </button>
                
            </div>
            <div class="row">
                <div class="col-lg-100 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle" id="booksTable">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Image</h6></th>
                                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Title</h6></th>
                                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Author</h6></th>
                                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Publisher(Yr)</h6></th>
                                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">ISBN</h6></th>
                                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Edition</h6></th>
                                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Price</h6></th>
                                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Copies</h6></th>
                                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Action</h6></th>
                                        </tr>
                                    </thead>
                                    <tbody id="booksTableBody">
                                        <!-- Data will be appended here -->
                                         
                                         
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pagination -->
            <nav aria-label="..." class="float-end">
                <ul class="pagination" id="pagination">
                    <!-- Pagination links will be appended here -->
                </ul>
            </nav>
        </div>
    </div>
</div>




      </div>
    </div>
  </div>

  <?php include('includes/scripts.php')?>

</body>
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

//add book
$(document).ready(function() {
    // Handle form submission
    $('#addBookForm').submit(function(e) {
        e.preventDefault(); // Prevent default form submission

        // AJAX request
        $.ajax({
            url: 'book-add.php', // URL to PHP file handling form submission
            type: 'POST', // Method
            data: new FormData(this), // Form data
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                // Handle success response
                if (response.trim() === "success") {
                    // Show success message using SweetAlert Toast
                    Toast.fire({
                        icon: 'success',
                        title: 'Book added successfully!'
                    });
                    
                    // Reset form
                    $('#addBookForm')[0].reset();
                    
                    // Close modal
                    $('#addBookModal').modal('hide');

                    // Reload the table
                    setTimeout(function() {
                        $('#booksTableBody').load(location.href + ' #booksTableBody');
                    }, 500);

                    

                } else {
                    // Show error message using SweetAlert Toast
                    Toast.fire({
                        icon: 'error',
                        title: response
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                // Show error message using SweetAlert Toast
                Toast.fire({
                    icon: 'error',
                    title: 'Failed to add book. Please try again later.'
                });
            }
        });
    });
});


//add boocopy
let bookId = null;

function setBookId(id) {
  bookId = id;
}

document.getElementById('addBookCopyForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const copies = document.getElementById('copies').value;

  if (bookId && copies) {
    const formData = new FormData();
    formData.append('book_id', bookId);
    formData.append('copies', copies);

    fetch('copies-add.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        Toast.fire({
          icon: 'success',
          title: 'Book copies added successfully!'
        });

        // Reload the table
        setTimeout(function() {
          $('#booksTableBody').load(location.href + ' #booksTableBody');
        },500);

      } else {
        Toast.fire({
          icon: 'error',
          title: 'Failed to add book copies.'
        });
      }
      // Close the modal
      const modal = bootstrap.Modal.getInstance(document.getElementById('addBookCopyModal'));
      modal.hide();
    })
    .catch(error => {
      console.error('Error:', error);
      Toast.fire({
        icon: 'error',
        title: 'An error occurred while adding book copies.'
      });
    });
  }
});

// search books
$(document).ready(function() {
    function fetchBooks(search = '', page = 1) {
        $.ajax({
            url: 'search_books.php',
            type: 'GET',
            data: { search: search, page: page },
            success: function(data) {
                const response = JSON.parse(data);
                const books = response.books;
                const totalPages = response.total_pages;
                const currentPage = response.current_page;

                let booksTableBody = '';
                if (books.length > 0) {
                    books.forEach(book => {
                        booksTableBody += `<tr>
                            <td class='border-bottom-0'><img src='../admin/uploads/books/${book.image}' alt='${book.title}' width='50' height='50'></td>
                            <td class='border-bottom-0'><p class='mb-0 fw-normal'>${book.title}</p></td>
                            <td class='border-bottom-0'><p class='mb-0 fw-normal'>${book.author}</p></td>
                            <td class='border-bottom-0'><p class='mb-0 fw-normal'>${book.publisher}, ${book.publication_yr}</p></td>
                            <td class='border-bottom-0'><p class='mb-0 fw-normal'>${book.isbn}</p></td>
                            <td class='border-bottom-0'><p class='mb-0 fw-normal'>${book.edition}</p></td>
                            <td class='border-bottom-0'><p class='mb-0 fw-normal'>${book.price}</p></td>
                            <td class='border-bottom-0'><p class='mb-0 fw-normal'>${book.available_copies}</p></td>
                            <td class='border-bottom-0'>
                                <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#addBookCopyModal' onclick='setBookId(${book.book_id})'>
                                    <i class='ti ti-copy'></i>
                                </button>
                                <button class='btn btn-secondary' data-bs-toggle='modal' data-bs-target='#editUserModal' onclick='editUser(${book.book_id})'>
                                    <i class='ti ti-edit'></i>
                                </button>
                                <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteUserModal' onclick='deleteUser(${book.book_id})'>
                                    <i class='ti ti-trash'></i>
                                </button>
                            </td>
                        </tr>`;
                    });
                } else {
                    booksTableBody = `<tr><td colspan='10' class='border-bottom-0'><h6 class='fw-semibold mb-0 text-center'>No data available</h6></td></tr>`;
                }

                $('#booksTableBody').html(booksTableBody);

                let paginationLinks = '';
                if (currentPage > 1) {
                    paginationLinks += `<li class="page-item"><a class="page-link" href="#" data-page="${currentPage - 1}">Previous</a></li>`;
                } else {
                    paginationLinks += `<li class="page-item disabled"><span class="page-link">Previous</span></li>`;
                }

                for (let i = 1; i <= totalPages; i++) {
                    if (i == currentPage) {
                        paginationLinks += `<li class="page-item active" aria-current="page"><span class="page-link">${i}</span></li>`;
                    } else {
                        paginationLinks += `<li class="page-item"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
                    }
                }

                if (currentPage < totalPages) {
                    paginationLinks += `<li class="page-item"><a class="page-link" href="#" data-page="${currentPage + 1}">Next</a></li>`;
                } else {
                    paginationLinks += `<li class="page-item disabled"><span class="page-link">Next</span></li>`;
                }

                $('#pagination').html(paginationLinks);
            }
        });
    }

    $('#search').on('keyup', function() {
        const search = $(this).val();
        fetchBooks(search);
    });

    $(document).on('click', '#pagination a', function(e) {
        e.preventDefault();
        const page = $(this).data('page');
        const search = $('#search').val();
        fetchBooks(search, page);
    });

    // Initial fetch
    fetchBooks();
});

  </script>

