<?php
// Database connection
require('../components/db_conn.php');

// Set the number of records per page
$records_per_page = 10;

// Get the current page number from the URL, default is 1
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $records_per_page;

// Get the total number of records
$total_query = "SELECT COUNT(*) FROM records";
$total_result = $conn->query($total_query);
$total_records = $total_result->fetch_row()[0];

// Calculate the total number of pages
$total_pages = ceil($total_records / $records_per_page);

// Fetch records for the current page
$query = "SELECT id, OCT_TCT_no, lot_no, survey_no, municipality, brgy, geodetic_engr, map FROM records LIMIT $offset, $records_per_page";
$result = $conn->query($query);

$records = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $records .= "<tr>";
        $records .= "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['OCT_TCT_no']}</h6></td>";
        $records .= "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['lot_no']}</p></td>";
        $records .= "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['survey_no']}</p></td>";
        $records .= "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['municipality']}, {$row['brgy']}</p></td>";
        $records .= "<td class='border-bottom-0'><p class='mb-0 fw-normal'>Engr. {$row['geodetic_engr']}</p></td>";
        $records .= "<td class='border-bottom-0'><p class='mb-0 fw-normal'>
            <button href='uploads/{$row['map']}' class='btn btn-primary view-pdf-btn' data-bs-toggle='modal' data-bs-target='#viewPDFModal'>
                <i class='ti ti-file-text'></i>
            </button>
            <button href='uploads/{$row['map']}' class='btn btn-success view-pdf-btn' data-bs-toggle='modal' data-bs-target='#viewImgModal'>
                <i class='ti ti-photo'></i>
            </button>
        </td>";
        $records .= "<td class='border-bottom-0'> 
            <button class='btn btn-secondary' data-bs-toggle='modal' data-bs-target='#editRecordModal' onclick='editRecord({$row['id']})'>
                <i class='ti ti-eye'></i>
            </button>
            <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editRecordModal' onclick='editRecord({$row['id']})'>
                <i class='ti ti-edit'></i>
            </button>
            <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteRecordModal' onclick='deleteRecord({$row['id']})'>
                <i class='ti ti-trash'></i>
            </button>
        </td>";
        $records .= "</tr>";
    }
} else {
    $records .= "<tr><td colspan='15' class='border-bottom-0'><h6 class='fw-semibold mb-0 text-center'>No data available</h6></td></tr>";
}

// Generate pagination links
$pagination = '';
if ($total_pages > 1) {
    if ($current_page > 1) {
        $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . ($current_page - 1) . '">Previous</a></li>';
    } else {
        $pagination .= '<li class="page-item disabled"><a class="page-link">Previous</a></li>';
    }

    for ($i = 1; $i <= $total_pages; $i++) {
        $pagination .= '<li class="page-item ' . ($i == $current_page ? 'active' : '') . '"><a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
    }

    if ($current_page < $total_pages) {
        $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . ($current_page + 1) . '">Next</a></li>';
    } else {
        $pagination .= '<li class="page-item disabled"><a class="page-link">Next</a></li>';
    }
}

$response = ['records' => $records, 'pagination' => $pagination];
echo json_encode($response);
?>
