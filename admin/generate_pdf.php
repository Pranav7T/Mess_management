<?php
require_once '../includes/db_connect.php';
require_once '../vendor/tecnickcom/tcpdf/tcpdf.php'; // Include TCPDF directly

// Create PDF Document
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Mess Management System');
$pdf->SetTitle('Website Activity Report');
$pdf->SetMargins(15, 10, 15);
$pdf->SetAutoPageBreak(TRUE, 15);
$pdf->AddPage();

// Add Title
$pdf->SetFont('Helvetica', 'B', 20);
$pdf->Cell(190, 10, '📊 Website Activity Report', 0, 1, 'C');
$pdf->SetFont('Helvetica', '', 12);
$pdf->Cell(190, 10, 'Generated on: ' . date('Y-m-d H:i:s'), 0, 1, 'C');
$pdf->Ln(10);

// Fetch Data
$totalUsers = $conn->query("SELECT COUNT(*) AS count FROM users")->fetch_assoc()['count'];
$totalMesses = $conn->query("SELECT COUNT(*) AS count FROM mess")->fetch_assoc()['count'];
$topCity = $conn->query("SELECT city, COUNT(city) AS count FROM mess GROUP BY city ORDER BY count DESC LIMIT 1")->fetch_assoc();
$mostVisitedMess = $conn->query("SELECT m.name, mv.visit_count FROM mess_visits mv JOIN mess m ON mv.mess_id = m.id ORDER BY mv.visit_count DESC LIMIT 1")->fetch_assoc();

// Add Table Header
$pdf->SetFillColor(230, 230, 230);
$pdf->SetFont('Helvetica', 'B', 14);
$pdf->Cell(95, 10, 'Metric', 1, 0, 'C', true);
$pdf->Cell(95, 10, 'Value', 1, 1, 'C', true);

// Add Table Content
$pdf->SetFont('Helvetica', '', 12);
$pdf->Cell(95, 10, '👥 Total Users', 1);
$pdf->Cell(95, 10, $totalUsers, 1, 1, 'C');

$pdf->Cell(95, 10, '🍽️ Total Mess Listings', 1);
$pdf->Cell(95, 10, $totalMesses, 1, 1, 'C');

$pdf->Cell(95, 10, '📌 Most Searched City', 1);
$pdf->Cell(95, 10, ($topCity ? $topCity['city'] : 'No data'), 1, 1, 'C');

$pdf->Cell(95, 10, '🔥 Most Visited Mess', 1);
$pdf->Cell(95, 10, ($mostVisitedMess ? $mostVisitedMess['name'] : 'No data'), 1, 1, 'C');

// Add Footer
$pdf->Ln(15);
$pdf->SetFont('Helvetica', 'I', 10);
$pdf->Cell(190, 10, 'Mess Management System © ' . date('Y'), 0, 1, 'C');

// Output PDF
$pdf->Output('website_report.pdf', 'D'); // Force download
?>
