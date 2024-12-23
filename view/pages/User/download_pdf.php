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

// Plant Details Table
$pdf->Ln(5);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetFillColor(220, 220, 220); // Light gray for table header
$pdf->SetTextColor(0, 0, 0); // Black text


// Table rows
$pdf->SetFont('helvetica', '', 12);
$pdf->SetFillColor(255, 255, 255); // White background for rows

// Set the font for bold text
$pdf->SetFont('helvetica', 'B', 12);
// Nursery Owner (outside table)
$pdf->Cell(45, 10, "Nursery Owner", 0, 0, 'L'); // No border, text only
$pdf->SetFont('helvetica', '', 12); // Set back to regular font
$pdf->Cell(0, 10, "Dr. Patrick G. Escalante", 0, 1, 'L'); // Regular font for the name

// Address (outside table)
$pdf->SetFont('helvetica', 'B', 12); // Bold for the label
$pdf->Cell(45, 10, "Address", 0, 0, 'L'); // No border, text only
$pdf->SetFont('helvetica', '', 12); // Regular font for the address
$pdf->Cell(0, 10, "Brgy. Daga, Cadiz City, Negros Occidental, 6121", 0, 1, 'L'); 

// Plant Information (outside table)
$pdf->SetFont('helvetica', 'B', 12); // Bold for the label
$pdf->Cell(0, 10, "Plant Information", 0, 1, 'C'); // Centered text across the page width


// Set background color for the header row only
$pdf->SetFillColor(200, 220, 255); // Light blue background
// Header row: Field and Details
$pdf->Cell(45, 10, "Field", 1, 0, 'C', true);  // True here applies the background color
$pdf->Cell(0, 10, "Details", 1, 1, 'C', true);  // True here applies the background color

// Set fill color to white for the rest of the table
$pdf->SetFillColor(255, 255, 255);  // White background for the rest of the table

// Field
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, "Field", 1, 0, 'L', true);
$pdf->SetFont('helvetica', '', 12); // Regular font for the address
$pdf->Cell(0, 10, $plantData['nursery_field'], 1, 1, 'L', true);

// Type
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, "Type", 1, 0, 'L', true);
$pdf->SetFont('helvetica', '', 12); // Regular font for the address
$pdf->Cell(0, 10, $plantData['type_name'], 1, 1, 'L', true);

// Type Description
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 15, "Type Description \n", 1, 0, 'L', true); // Label column
$typeDescription = $plantData['type_description'];
$pdf->SetFont('helvetica', '', 12); // Regular font for the address
$pdf->MultiCell(0, 15, $typeDescription, 1, 'L', false); // Content column with wrapping text

// Variety
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, "Variety", 1, 0, 'L', true); // Label column
$pdf->SetFont('helvetica', '', 12); // Regular font for the address
$pdf->Cell(0, 10, $plantData['variety_name'], 1, 1, 'L', true); // Content column

// Variety Description
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 15, "Variety Description", 1, 0, 'L', true); // Label column
$varietyDescription = $plantData['variety_description'];
$pdf->SetFont('helvetica', '', 12); // Regular font for the address
$pdf->MultiCell(0, 15, $typeDescription, 1, 'L', false); // Content column with wrapping text

// Quantity
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, "Quantity", 1, 0, 'L', true);
$pdf->SetFont('helvetica', '', 12); // Regular font for the address
$pdf->Cell(0, 10, $plantData['quantity'], 1, 1, 'L', true);

// Seedling Source
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, "Seedling Source", 1, 0, 'L', true);
$pdf->SetFont('helvetica', '', 12); // Regular font for the address
$pdf->Cell(0, 10, $plantData['source_fullname'], 1, 1, 'L', true);

// Age
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, "Age", 1, 0, 'L', true);
$pdf->SetFont('helvetica', '', 12); // Regular font for the address
$pdf->Cell(0, 10, $age, 1, 1, 'L', true);

// Planted Date
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, "Planted Date", 1, 0, 'L', true);
$pdf->SetFont('helvetica', '', 12); // Regular font for the address
$pdf->Cell(0, 10, DateTime::createFromFormat('Y-m-d', $plantData['planted_date'])->format('F j, Y'), 1, 1, 'L', true);

// Harvest Date
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, "Harvest Date", 1, 0, 'L', true);
$pdf->SetFont('helvetica', '', 12); // Regular font for the address
$pdf->Cell(0, 10, $HarvestDate, 1, 1, 'L', true);

// Harvest Count
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(45, 10, "Harvest Count", 1, 0, 'L', true);
$pdf->SetFont('helvetica', '', 12); // Regular font for the address
$pdf->Cell(0, 10, $plantData['harvest_count'], 1, 1, 'L', true);

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

    if ($timelineItem['timeline_title'] === "Harvested") {
        $totalPlanted = $plantData['quantity']; // Total planted quantity
        $harvestedQuantity = $timelineItem['quantity']; // Harvested quantity
        $totalDamage = $totalPlanted - $harvestedQuantity; // Total damage
        $harvestPercentage = ($harvestedQuantity / $totalPlanted) * 100; // Harvest percentage
        $damagePercentage = ($totalDamage / $totalPlanted) * 100; // Damage percentage
        $profitPerPlant = 2; // Example profit per plant
        $totalProfit = $harvestedQuantity * $profitPerPlant; // Total profit
        $maxProfit = $totalPlanted * $profitPerPlant; // Maximum possible profit
        $profitPercentage = ($totalProfit / $maxProfit) * 100; // Profit percentage

        // Add table headers
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetFillColor(240, 240, 240); // Light gray background
        $pdf->Cell(70, 10, "Detail", 1, 0, 'C', true);
        $pdf->Cell(60, 10, "Value", 1, 0, 'C', true);
        $pdf->Cell(60, 10, "Percentage", 1, 1, 'C', true);

        // Add rows with text coloring
        $pdf->SetFont('helvetica', '', 10);

        // Total Harvest (Darker Sky Blue text)
        $pdf->SetTextColor(70, 130, 180); // Darker sky blue
        $pdf->Cell(70, 10, "Total Harvest", 1, 0, 'L');
        $pdf->Cell(60, 10, "{$harvestedQuantity}/{$totalPlanted}", 1, 0, 'L');
        $pdf->Cell(60, 10, number_format($harvestPercentage, 2) . "%", 1, 1, 'L');
        $pdf->SetTextColor(0, 0, 0); // Reset to black text

        // Total Damage (Darker Red text)
        $pdf->SetTextColor(200, 0, 0); // Darker red
        $pdf->Cell(70, 10, "Total Damage", 1, 0, 'L');
        $pdf->Cell(60, 10, "{$totalDamage}", 1, 0, 'L');
        $pdf->Cell(60, 10, number_format($damagePercentage, 2) . "%", 1, 1, 'L');
        $pdf->SetTextColor(0, 0, 0); // Reset to black text

        // Survival Rate
        $pdf->SetTextColor(34, 139, 34); // Default green color

        // Change color based on survival rate
        if ($harvestPercentage < 50) {
            $pdf->SetTextColor(255, 0, 0); // Red if below 50%
        } elseif ($harvestPercentage >= 50 && $harvestPercentage < 90) {
            $pdf->SetTextColor(245, 173, 66); // Yellow if between 50% and 90%
        } elseif ($harvestPercentage >= 90) {
            $pdf->SetTextColor(0, 128, 0); // Green if above 90%
        }

        // Display the survival rate
        $pdf->Cell(70, 10, "Survival Rate: ", 1, 0, 'L');
        $pdf->Cell(60, 10, "{$harvestedQuantity}/{$totalPlanted}", 1, 0, 'L');
        $pdf->Cell(60, 10, number_format($harvestPercentage, 2) . "%", 1, 1, 'L');
        $pdf->SetTextColor(0, 0, 0); // Reset to black text

        // Total Profit (Darker Green text)
        $pdf->SetTextColor(34, 139, 34); // Darker green
        $pdf->Cell(70, 10, "Total Profit", 1, 0, 'L');
        $pdf->Cell(60, 10, "" . number_format($totalProfit, 2), 1, 0, 'L');
        $pdf->Cell(60, 10, number_format($profitPercentage, 2) . "%", 1, 1, 'L');
        $pdf->SetTextColor(0, 0, 0); // Reset to black text

        $pdf->Ln(5); // Add some space before the next section
    }

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
            $formattedTime = $timeObject->format('h:i A'); // 12-hour format with AM/PM

            $contentText = htmlspecialchars($content['content']); // Wrap content text

            $startY = $pdf->GetY(); // Save Y position

            // Use MultiCell to wrap the content
            $pdf->MultiCell(95, 10, $contentText, 1, 'L', false);

            $currentY = $pdf->GetY();
            $contentHeight = $currentY - $startY;

            // Draw the Activity Time cell
            $pdf->SetXY(105, $startY); // Adjust based on layout
            $pdf->MultiCell(0, $contentHeight, $formattedTime, 1, 'L', false);

            // Move to the next line
            $pdf->SetY($currentY);
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
