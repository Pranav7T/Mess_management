<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../includes/db_connect.php';

// Get search parameters
$city = isset($_GET['city']) ? trim($_GET['city']) : '';
$veg_nonveg = isset($_GET['veg_nonveg']) ? trim($_GET['veg_nonveg']) : '';
$rating = isset($_GET['rating']) ? (float)$_GET['rating'] : 0;
$min_price = isset($_GET['min_price']) ? (float)$_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) ? (float)$_GET['max_price'] : 0;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 6; // Items per page

// Calculate offset
$offset = ($page - 1) * $per_page;

// Build the query
$query = "SELECT * FROM mess WHERE 1=1";
$count_query = "SELECT COUNT(*) as total FROM mess WHERE 1=1";
$params = array();
$types = "";

if (!empty($city)) {
    $query .= " AND city LIKE ?";
    $count_query .= " AND city LIKE ?";
    $params[] = "%$city%";
    $types .= "s";
}

if (!empty($veg_nonveg)) {
    $query .= " AND veg_nonveg = ?";
    $count_query .= " AND veg_nonveg = ?";
    $params[] = $veg_nonveg;
    $types .= "s";
}

if ($rating > 0) {
    $query .= " AND rating >= ?";
    $count_query .= " AND rating >= ?";
    $params[] = $rating;
    $types .= "d";
}

if ($min_price > 0) {
    $query .= " AND price >= ?";
    $count_query .= " AND price >= ?";
    $params[] = $min_price;
    $types .= "d";
}

if ($max_price > 0) {
    $query .= " AND price <= ?";
    $count_query .= " AND price <= ?";
    $params[] = $max_price;
    $types .= "d";
}

$query .= " ORDER BY rating DESC LIMIT ? OFFSET ?";
$types .= "ii";
$params[] = $per_page;
$params[] = $offset;

// Get total count
$count_stmt = $conn->prepare($count_query);
if (!empty($params)) {
    $count_params = array_slice($params, 0, -2); // Remove limit and offset
    $count_types = substr($types, 0, -2);
    if (!empty($count_params)) {
        $count_stmt->bind_param($count_types, ...$count_params);
    }
}
$count_stmt->execute();
$total_result = $count_stmt->get_result();
$total = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total / $per_page);

// Prepare and execute the query
$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

// Format the response
$messes = array();
while ($row = $result->fetch_assoc()) {
    // Handle image path
    $image = !empty($row['image']) ? $row['image'] : 'default_mess.jpg';
    
    $messes[] = array(
        'id' => $row['id'],
        'name' => $row['name'],
        'city' => $row['city'],
        'location' => $row['location'],
        'rating' => $row['rating'],
        'open_time' => $row['open_time'],
        'price' => $row['price'],
        'contact' => $row['contact'],
        'veg_nonveg' => $row['veg_nonveg'],
        'image' => $image,
        'verified' => true
    );
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode([
    'messes' => $messes,
    'pagination' => [
        'current_page' => $page,
        'total_pages' => $total_pages,
        'total_items' => $total
    ]
]);

// Close statements and connection
$stmt->close();
$count_stmt->close();
$conn->close();
?>
