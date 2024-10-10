<?php
require '../../../vendor/autoload.php'; // Include Composer's autoloader

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

// Get the plant ID from the query parameter
$plantData = $_GET['plantID'];

// Generate the QR code
$qrCode = QrCode::create($plantData)
    ->setSize(256)
    ->setMargin(10);

// Create the PNG writer
$writer = new PngWriter();
$qrCodeData = $writer->write($qrCode);

// Set headers to force download
header('Content-Type: image/png');
header('Content-Disposition: attachment; filename="qrcode.png"');

// Output the QR code as an image
echo $qrCodeData->getString();
