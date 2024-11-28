<?php
require_once('../../../vendor/autoload.php');
require_once('../../../services/DashboardService.php');

// Initialize services
$dashboard = new Dashboard();

// Fetch data
$getSummary = $dashboard->getPlantInfoSummary();
$m = $dashboard->getThisYearSummary();
$sales = $dashboard->getSalesSummary();

// Create PDF instance
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nursery Dashboard');
$pdf->SetTitle('Summary Report');
$pdf->SetSubject('Planting and Sales Summary');
$pdf->SetKeywords('TCPDF, PDF, summary, sales, plants');

// Set default header data
$pdf->SetHeaderData('', 0, 'Nursery Summary Report', 'Generated on ' . date('Y-m-d'));

// Set margins
$pdf->SetMargins(15, 27, 15);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(10);

// Add a page
$pdf->AddPage();

// Set font for the document
$pdf->SetFont('helvetica', '', 12);

// Add Plant Info Summary
$pdf->Write(0, 'Plant Info Summary', '', 0, 'L', true, 0, false, false, 0);
$pdf->Ln(5);
if ($getSummary) {
    $pdf->SetFillColor(173, 255, 173); // Light green background
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Cell(70, 8, 'Metric', 1, 0, 'C', true);
    $pdf->Cell(70, 8, 'Value', 1, 1, 'C', true);
    foreach ($getSummary as $key => $value) {
        $pdf->Cell(70, 8, ucfirst(str_replace('_', ' ', $key)), 1, 0, 'L');
        $pdf->Cell(70, 8, $value, 1, 1, 'L');
    }
} else {
    $pdf->Write(0, 'No data available.', '', 0, 'L', true, 0, false, false, 0);
}

// Add Sales Summary Table
$pdf->Ln(10);
$pdf->Write(0, 'Sales Summary', '', 0, 'L', true, 0, false, false, 0);
$pdf->Ln(5);
if ($sales) {
    $pdf->SetFillColor(173, 255, 173); // Light green background
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Cell(30, 8, 'Order ID', 1, 0, 'C', true);
    $pdf->Cell(30, 8, 'Quantity', 1, 0, 'C', true);
    $pdf->Cell(30, 8, 'Total', 1, 0, 'C', true);
    $pdf->Cell(30, 8, 'Status', 1, 0, 'C', true);
    $pdf->Cell(50, 8, 'Order Date', 1, 1, 'C', true);
    foreach ($sales as $sale) {
        $pdf->Cell(30, 8, $sale['order_id'], 1, 0, 'L');
        $pdf->Cell(30, 8, $sale['order_quantity'], 1, 0, 'L');
        $pdf->Cell(30, 8, $sale['order_total'], 1, 0, 'L');
        $pdf->Cell(30, 8, $sale['status'], 1, 0, 'L');
        $pdf->Cell(50, 8, $sale['order_datetime'], 1, 1, 'L');
    }
} else {
    $pdf->Write(0, 'No sales data available.', '', 0, 'L', true, 0, false, false, 0);
}

// Add Yearly Summary Table
$pdf->Ln(10);
$pdf->Write(0, 'This Year\'s Planting Summary', '', 0, 'L', true, 0, false, false, 0);
$pdf->Ln(5);
if ($m) {
    $pdf->SetFillColor(173, 255, 173); // Light green background
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Cell(50, 8, 'Month', 1, 0, 'C', true);
    $pdf->Cell(70, 8, 'Value', 1, 1, 'C', true);

    foreach ($m as $month => $value) {
        $pdf->Cell(50, 8, ucfirst($month), 1, 0, 'L');
        $pdf->Cell(70, 8, $value, 1, 1, 'L');
    }
} else {
    $pdf->Write(0, 'No data available.', '', 0, 'L', true, 0, false, false, 0);
}

// Output PDF
$pdf->Output('summary_report.pdf', 'D'); // 'D' forces download
