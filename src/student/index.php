<?php 
// session_start();
// require("../php/db_conn.php");

// include('auth.php');
// include('header.php'); 

// // Fetch book data
// $sql = "SELECT * FROM book";
// $result = $conn->query($sql);
?>

<head>
<style>
  .custom-control-prev,
  .custom-control-next {
    width: 5%;
  }

  .custom-control-prev {
    left: -5%;
  }

  .custom-control-next {
    right: -5%;
  }

  @media (max-width: 768px) {
    .custom-control-prev,
    .custom-control-next {
      width: 10%;
    }

    .custom-control-prev {
      left: -10%;
    }

    .custom-control-next {
      right: -10%;
    }
  }

 
</style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper">
    <!--  Main wrapper -->
    <div class="body-wrapper">

      <!--  Header Start -->
      <?php include('includes/nav.php') ?>
      <!--  Header End -->

      <!-- Carousel Section -->
<div class="container-fluid  ">
    
    <div id="imageCarousel" class="carousel slide" data-ride="carousel">
        
        <ol class="carousel-indicators">
            <li data-target="#imageCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#imageCarousel" data-slide-to="1"></li>
            <li data-target="#imageCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../assets/images/backgrounds/1.jpg" class="d-block w-100 h-50 rounded" alt="Slide 1">
                <!-- Adjusted height and removed h-50 class -->
            </div>
            <div class="carousel-item">
                <img src="../assets/images/backgrounds/2.jpg" class="d-block w-100 h-50 rounded" alt="Slide 2">
                <!-- Adjusted height and removed h-50 class -->
            </div>
            <div class="carousel-item">
                <img src="../assets/images/backgrounds/3.jpg" class="d-block w-100 h-50 rounded" alt="Slide 3">
                <!-- Adjusted height and removed h-50 class -->
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>


      <!-- New Arrivals Section -->
      <div class="container-fluid ">
  <div class="card bg-secondary-subtle">
    <div class="card-body">
      <h2 class="fw-bold mb-4 p-3 border-bottom border-primary border-3">New Arrivals</h2>
      <div class="row">
      <?php 
        $sql = "SELECT * FROM book ORDER BY created_at DESC LIMIT 8";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $title = strlen($row['title']) > 11 ? substr($row['title'], 0, 11) . "..." : $row['title'];
            
            echo '<div class="col-sm-6 col-lg-3 mb-4">';
            echo '<div class="card h-90">';
            echo '<div class="position-relative">';
            echo '<a href="javascript:void(0)"><img src="../admin/uploads/books/'.$row['image'].'" class="card-img-top" alt="Book Image" style="max-height: 260px;"></a>';
            echo '</div>';
            echo '<div class="card-body">';
            echo '<h6 class="card-title">' . htmlspecialchars($title) . '</h6>';
            echo '<p class="card-text text-muted">'.$row['author'].'</p>';
            echo '<h6 class="card-text fw-bold">$'.$row['price'].'</h6>';
            echo '<div class="d-flex justify-content-between">';
            echo '<button class="btn btn-outline-primary view-book flex-grow-1 me-2 small mt-2" data-id="'.$row['book_id'].'">View Details</button>';
            echo '<button class="btn btn-primary view-book flex-grow-1 small mt-2" data-id="'.$row['book_id'].'"><i class="ti ti-shopping-cart-plus"></i></button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
          }
        } else {
          echo '<div class="col"><p>No books available.</p></div>';
        }
        $conn->close();
        ?>

      </div>
    </div>
  </div>
</div>



<!-- Category -->
<div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
          
          <div class="col-lg-4 d-flex align-items-strech">
            <div class="card w-100 bg-danger">
              <div class="card-body ">
              
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold text-white">Best Sellers</h5>
                  </div>
                  <div>
                    <select class="form-select text-white">
                      <option value="1">March 2023</option>
                      <option value="2">April 2023</option>
                      <option value="3">May 2023</option>
                      <option value="4">June 2023</option>
                    </select>
                  </div>
                </div>
                <div id="chart"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">
            <div class="col-lg-12">
                <!-- 1 -->
                <div class="card bg-primary">
                  <div class="card-body">
                    <div class="row alig n-items-start">
                      <div class="col-8">
                        <h5 class="card-title mb-9 fw-semibold text-white"> Textbook </h5>
                        
                        </div>
                      </div>
                    </div>
                  </div>
                
                </div>
              <div class="col-lg-12">
                <!-- 2 -->
                <div class="card bg-secondary" >
                  <div class="card-body">
                    <div class="row alig n-items-start">
                      <div class="col-8">
                        <h5 class="card-title mb-9 fw-semibold text-white"> Programming </h5>
                        
                      </div>
                      
                    </div>
                  </div>
                 
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="row">
            <div class="col-lg-12">
                <!-- 4 -->
                <div class="card bg-warning">
                  <div class="card-body">
                    <div class="row alig n-items-start">
                      <div class="col-8">
                        <h5 class="card-title mb-9 fw-semibold text-white"> Manga </h5>
                        
                        </div>
                      </div>
                    </div>
                  </div>
                
                </div>
              <div class="col-lg-12">
                <!-- 4 -->
                <div class="card bg-success">
                  <div class="card-body">
                    <div class="row alig n-items-start">
                      <div class="col-8">
                        <h5 class="card-title mb-9 fw-semibold text-white"> Wattpad </h5>
                        
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

<!-- Footer -->

<div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a></p>
        </div>





    <?php include('includes/scripts.php') ?>

    <!-- Modals  -->

    <!-- View Book Modal -->
    <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="bookModalLabel">Book Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Book details will be loaded here -->
            <div id="bookDetails"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">Borrow</button>
            <button type="button" class="btn btn-warning">Reserve</button>
            <!-- <button type="button" class="btn btn-success">Buy</button> -->
          </div>
        </div>
      </div>
    </div>

   

    <script>


      document.addEventListener('DOMContentLoaded', function () {
        const viewButtons = document.querySelectorAll('.view-book');
        
        viewButtons.forEach(button => {
          button.addEventListener('click', function () {
            const bookId = this.getAttribute('data-id');
            
            // AJAX request to fetch book details
            fetch(`fetch-book.php?id=${bookId}`)
              .then(response => response.json())
              .then(data => {
                const bookDetails = `
                  <div class="text-center">
                    <img src="../admin/uploads/books/${data.image}" class="img-fluid mb-3" style="max-height: 300px;" alt="Book Image">
                  </div>
                  <p><strong>Title:</strong> ${data.title}</p>
                  <p><strong>Author:</strong> ${data.author}</p>
                  <p><strong>ISBN:</strong> ${data.isbn}</p>
                  <p><strong>Publisher:</strong> ${data.publisher}</p>
                  <p><strong>Publication Year:</strong> ${data.publication_yr}</p>
                  <p><strong>Category:</strong> ${data.category}</p>
                  <p><strong>Genre:</strong> ${data.genre}</p>
                  <p><strong>Edition:</strong> ${data.edition}</p>
                  <p><strong>Price:</strong> $${data.price}</p>
                  <p><strong>Available Copies:</strong> ${data.available_copies}</p>
                `;
                
                document.getElementById('bookDetails').innerHTML = bookDetails;
                new bootstrap.Modal(document.getElementById('bookModal')).show();
              })
              .catch(error => console.error('Error fetching book details:', error));
          });
        });
      });
    </script>
</body>
</html>
