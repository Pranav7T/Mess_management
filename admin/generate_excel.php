<?php
require_once '../includes/db_connect.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Check database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Create a new spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Fetch data safely with error handling
$totalUsersQuery = $conn->query("SELECT COUNT(*) AS count FROM users");
$totalUsers = $totalUsersQuery ? $totalUsersQuery->fetch_assoc()['count'] : 'Error';

$totalMessesQuery = $conn->query("SELECT COUNT(*) AS count FROM mess");
$totalMesses = $totalMessesQuery ? $totalMessesQuery->fetch_assoc()['count'] : 'Error';

$topCityQuery = $conn->query("SELECT city, COUNT(city) AS count FROM mess GROUP BY city ORDER BY count DESC LIMIT 1");
$topCity = $topCityQuery ? $topCityQuery->fetch_assoc() : null;

$mostVisitedMessQuery = $conn->query("SELECT m.name, mv.visit_count FROM mess_visits mv JOIN mess m ON mv.mess_id = m.id ORDER BY mv.visit_count DESC LIMIT 1");
$mostVisitedMess = $mostVisitedMessQuery ? $mostVisitedMessQuery->fetch_assoc() : null;

// Format sheet: Bold headers, set column width
$sheet->setCellValue('A1', 'Website Activity Report');
$sheet->getStyle('A1')->getFont()->setBold(true);
$sheet->setCellValue('A3', 'Total Users')->getStyle('A3')->getFont()->setBold(true);
$sheet->setCellValue('B3', $totalUsers);
$sheet->setCellValue('A4', 'Total Mess Listings')->getStyle('A4')->getFont()->setBold(true);
$sheet->setCellValue('B4', $totalMesses);
$sheet->setCellValue('A5', 'Most Searched City')->getStyle('A5')->getFont()->setBold(true);
$sheet->setCellValue('B5', ($topCity ? $topCity['city'] : 'No data'));
$sheet->setCellValue('A6', 'Most Visited Mess')->getStyle('A6')->getFont()->setBold(true);
$sheet->setCellValue('B6', ($mostVisitedMess ? $mostVisitedMess['name'] : 'No data'));

// Auto-size columns
foreach (range('A', 'B') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Create Excel file
$writer = new Xlsx($spreadsheet);
$fileName = 'website_report.xlsx';

// Prevent output buffering issues
ob_end_clean();

// Send headers for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit;
?>
