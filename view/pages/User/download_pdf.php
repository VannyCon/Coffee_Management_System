<?php
require_once('../../../vendor/autoload.php');
require_once('../../../services/PlantTimelineService.php');
require_once('../../../services/PlantNurseryService.php');

$nurseryID = $_GET['nurseryID'];

// Fetch data
$timeline = new Timeline();
$plant = new PlantInfo();
$plantData = $plant->getPlantDataByID($nurseryID);
$timelines = $timeline->getTimelineById($nurseryID);

// Calculate Plant Age
$plantedDate = $plantData['planted_date']; // Format: YYYY-MM-DD


// Example $history_date array with 'relevant_date'
$history_date = $plant->getHarvestStatus($plantData['nursery_id']);
$relevant_date = $history_date['relevant_date']; // '2024-11-01' (example)

// Create a DateTime object from the relevant date (planted date)
$start_date = new DateTime($relevant_date);

// Clone the date to create the end date range
$end_date = clone $start_date;

// Add 24 months to get 2 years later
$start_date->modify('+24 months');

// Add 30 months to get 2 years and 6 months later
$end_date->modify('+30 months');

// Format and output the date range
$HarvestDate =  $start_date->format('F j, Y') . ' - ' . $end_date->format('F j, Y');


$plantedDateObj = new DateTime($plantedDate);
$currentDate = new DateTime();
$interval = $plantedDateObj->diff($currentDate);

if ($interval->y > 0) {
    $age = $interval->y . ' years old';
} elseif ($interval->m > 0) {
    $age = $interval->m . ' months old';
} else {
    $age = $interval->d . ' days old';
}

if (!isset($nurseryID)) {
    // Redirect to plant info page if no data is found
    header("Location: index.php?nurseryID=$nurseryID");
    exit;
}

// Create new PDF document
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

// Title
$pdf->SetFillColor(30, 144, 255); // Blue background
$pdf->SetTextColor(255, 255, 255); // White text
$pdf->Cell(0, 10, "Plant Information", 0, 1, 'C', true);

// Plant Details
$pdf->Ln(5);
$pdf->SetTextColor(0, 0, 0); // Black text



$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, "Field", 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, $plantData['nursery_field'], 0, 1);


$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, "Type:", 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, $plantData['type_name'], 0, 1);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, "Type Description:", 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, $plantData['type_description'], 0, 1);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, "Variety:", 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, $plantData['variety_name'], 0, 1);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, "Variety Description:", 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, $plantData['variety_description'], 0, 1);


$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, "Source Fullname", 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, $plantData['nursery_seedling_source'], 0, 1);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, "Age:", 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, $age, 0, 1);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, "Planted Date:", 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, $plantData['planted_date'], 0, 1);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, "Harvest Date:", 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, $HarvestDate, 0, 1);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, "Harvest Count:", 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, $plantData['harvest_count'], 0, 1);

$pdf->Ln(10);

// Timeline Section Title
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, "Timeline", 0, 1, 'L', true);

foreach ($timelines as $timelineItem) {
    // Timeline title and date
    $pdf->SetFillColor(255, 250, 205); // Light yellow background
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(95, 10, $timelineItem['timeline_title'], 1, 0, 'L', true);
    $pdf->Cell(0, 10, DateTime::createFromFormat('Y-m-d', $timelineItem['history_date'])->format('F j, Y'), 1, 1, 'L', true);

    // Content Section Title
    $pdf->SetFillColor(144, 238, 144); // Light green background
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(95, 10, "Content", 1, 0, 'L', true);
    $pdf->Cell(0, 10, "Activity time", 1, 1, 'L', true);

    // Timeline Content and Time
    $contents = $timeline->getContentByTimelineId($timelineItem['content_id']);
    if (!empty($contents)) {
        foreach ($contents as $content) {
            $historyTime = htmlspecialchars($content['history_time']); // Access from $content
            $timeObject = DateTime::createFromFormat('H:i:s.u', $historyTime);
            $formattedTime = $timeObject->format('h:i A'); // 12:27 PM

            $pdf->Cell(95, 10, $content['content'], 1, 0);
            $pdf->Cell(0, 10, $formattedTime, 1, 1);
        }
    } else {
        $pdf->Cell(0, 10, "No content available", 1, 1);
    }

    // Add some space between timeline entries
    $pdf->Ln(5);
}

// Output PDF
$pdf->Output('timeline.pdf', 'D'); // 'D' forces download

?>
