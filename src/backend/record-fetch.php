<?php
require('../components/db_conn.php');

// Get the current page and search query from the request
$records_per_page = 5;
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($current_page - 1) * $records_per_page;
$searchQuery = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';

// Base query
$query = "SELECT id, oct_tct_no, lot_no, survey_no, sheet_no, area, date_approved, municipality, brgy, land_owner, geodetic_engr, survey_type, uploaded_at, map FROM records";

// If there's a search query, modify the query to filter results
if (!empty($searchQuery)) {
    $query .= " WHERE oct_tct_no LIKE '%$searchQuery%' 
                OR lot_no LIKE '%$searchQuery%' 
                OR survey_no LIKE '%$searchQuery%' 
                OR municipality LIKE '%$searchQuery%' 
                OR brgy LIKE '%$searchQuery%' 
                OR land_owner LIKE '%$searchQuery%' 
                OR geodetic_engr LIKE '%$searchQuery%'";
}

// Fetch the total number of records
$total_query = "SELECT COUNT(*) FROM ($query) AS total";
$total_result = $conn->query($total_query);
$total_records = $total_result->fetch_row()[0];
$total_pages = ceil($total_records / $records_per_page);

// Add LIMIT to the query for pagination
$query .= " LIMIT $offset, $records_per_page";

$result = $conn->query($query);

$records = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $records .= "<tr>";
        $records .= "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['oct_tct_no']}</p></td>";
        $records .= "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['lot_no']}</p></td>";
        $records .= "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['survey_no']}</p></td>";
        $records .= "<td class='border-bottom-0'><p class='mb-0 fw-normal'>{$row['municipality']}, {$row['brgy']}</p></td>";
        $records .= "<td class='border-bottom-0'><p class='mb-0 fw-normal'>Engr. {$row['geodetic_engr']}</p></td>";
        $records .= "<td class='border-bottom-0'>
            <button href='../uploads/{$row['map']}' class='btn btn-primary view-pdf-btn' data-bs-toggle='modal' data-bs-target='#viewPDFModal'>
                <i class='ti ti-file-text'></i>
            </button>
            <button href='../uploads/{$row['map']}' class='btn btn-success view-pdf-btn' data-bs-toggle='modal' data-bs-target='#viewImgModal'>
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
    $records .= "<tr><td colspan='7' class='border-bottom-0'><h6 class='fw-semibold mb-0 text-center'>No data available</h6></td></tr>";
}

// Generate pagination HTML
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

// Return the response as JSON
$response = ['records' => $records, 'pagination' => $pagination];
header('Content-Type: application/json');
echo json_encode($response);

