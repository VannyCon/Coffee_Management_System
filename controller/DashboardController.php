<?php 


require_once('../../../services/DashboardService.php');
$dashboard = new Dashboard();
$getSummary = $dashboard->getPlantInfoSummary();
$m = $dashboard->getThisYearSummary();
$sales = $dashboard->getSalesSummary();
?>
