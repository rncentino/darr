<?php 
session_start();
require("../php/db_conn.php");

include('includes/auth.php');
include('includes/header.php'); 

// Fetch data from the borrow table for the current user
$student_id = $_SESSION['id'];
$sql = "SELECT b.borrow_id, bc.book_copy_id, b.date_borrowed, b.due_date, b.date_returned, s.firstname AS student_firstname, s.lastname AS student_lastname, bk.image, bk.title, bk.isbn, bk.edition, l.firstname AS librarian_firstname, l.lastname AS librarian_lastname
        FROM borrow b
        JOIN student s ON b.student_id = s.student_id
        JOIN bookcopy bc ON b.book_copy_id = bc.book_copy_id
        JOIN book bk ON bc.book_id = bk.book_id
        LEFT JOIN librarian l ON b.librarian_id = l.librarian_id
        WHERE b.student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $student_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->

    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">

      <!--  Header Start -->
      <?php include('includes/nav.php') ?>

      <!--  Header End -->
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Borrowed Books</h5>
            <div class="row">
            <?php 
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<div class="col-sm-6 col-xl-3">';
        echo '<div class="card overflow-hidden rounded-2">';
        echo '<div class="position-relative">';
        echo '<a href="javascript:void(0)"><img src="../admin/uploads/books/'.$row['image'].'" class="card-img-top rounded-0" alt="..." style="max-height: 250px;"></a>';
        echo '</div>';
        echo '<div class="card-body pt-3 p-4">';
        echo '<h6 class="fw-semibold fs-4">'.$row['title'].'</h6>';
        // echo '<p class="text-muted">'.$row['student_firstname'].' '.$row['student_lastname'].'</p>';
        echo '<p class="text-muted">' ."Librarian:". ''.$row['librarian_firstname'].' '.$row['librarian_lastname'].'</p>';
        echo '<div class="d-flex align-items-center justify-content-between">';
        echo '<h6 class="fw-semibold fs-4 mb-0">Borrowed: '.$row['date_borrowed'].'</h6>';
        echo '<h6 class="fw-semibold fs-4 mb-0">Due Date: '.$row['due_date'].'</h6>';
        // 
        echo '</div>';
        
        // Check if the book has been returned
        if ($row['date_returned'] != null) {
            // If returned, display a badge indicating "Returned"
            echo '<h6 class="fw-semibold fs-4 mb-0">Return Date: '.$row['date_returned'].'</h6>';
            echo "<span class='badge bg-success fw-semibold mt-2'>Returned</span>";
        } else {
            // If not returned, display a badge indicating "To Return"
            echo "<span class='badge bg-danger fw-semibold mt-2' >To Return</span>";
        }
        
       
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "0 results";
}
$stmt->close();
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
