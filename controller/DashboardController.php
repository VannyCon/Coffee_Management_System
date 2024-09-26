<?php 
session_start();
// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../../../index.php");
    exit();
}

require_once('../../../services/DashboardService.php');
$dashboard = new Dashboard();
$getSummary = $dashboard->getPlantInfoSummary();
$m = $dashboard->getThisYearSummary();
?>
