<?php 
$title = "Report";
include_once('../../components/header.php');
require_once('../../../services/DashboardService.php');

// Initialize services
$dashboard = new Dashboard();

// Fetch data
$getSummary = $dashboard->getPlantInfoSummary();
$m = $dashboard->getThisYearSummary();
$sales = $dashboard->getSalesSummary();
?>
<style>
/* Styles for print button */
.print-btn {
    background-color: #198754;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.print-btn:hover {
    background-color: #157347;
}

@media print {
    /* Set page margins */
    @page {
        margin: 1in;
    }

    /* Hide elements */
    .print-btn,
    .pdfdownload,
    nav,
    footer {
        display: none !important;
    }
    body {
        background-color: white !important;
    }

    /* More specific selectors for elements that might be overriding */
    .container {
        background-color: white !important;
    }
    .mobile-nav-bg {
        background-color: white !important;
    }


    /* Card styles */
    .card {
        break-inside: avoid !important;
        margin-bottom: 20px !important;
        border: 1px solid #dee2e6 !important;
        box-shadow: none !important;
        page-break-inside: avoid !important;
        background-color: white !important;
    } 
    
    /* Header styles */
    .card-header.bg-success {
        background-color: rgb(25, 135, 84) !important;
        color: white !important;
        padding: 12px !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    
    /* Table styles */
    .table {
        width: 100% !important;
        margin-bottom: 1rem !important;
        border-collapse: collapse !important;
        background-color: white !important;
    }
    
    .table th,
    .table td {
        padding: 8px !important;
        border: 1px solid #dee2e6 !important;
        background-color: white !important;
    }
    
    .table-success {
        background-color: #f8f9fa !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
}
</style>
<div class="container my-4">
    <!-- Download Button -->
    <div class="text-end mb-4 d-flex justify-content-end">
        <a href="reportpdf.php" class="btn btn-info pdfdownload"> 
            <i class='bx bx-note icon'></i> Download PDF
        </a>
        <!-- Download Button -->
        <button onclick="window.print()" class="print-btn mx-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
            </svg>
            Print Report
        </button>
    </div>
    <!-- Plant Info Summary Section -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Plant Info Summary</h5>
        </div>
        <div class="card-body">
            <?php if ($getSummary): ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th>Metric</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getSummary as $key => $value): ?>
                                <tr>
                                    <td><?= ucfirst(str_replace('_', ' ', $key)) ?></td>
                                    <td><?= $value ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-muted">No data available.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Sales Summary Section -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Sales Summary</h5>
        </div>
        <div class="card-body">
            <?php if ($sales): ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th>Order ID</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sales as $sale): ?>
                                <tr>
                                    <td><?= $sale['order_id'] ?></td>
                                    <td><?= $sale['order_quantity'] ?></td>
                                    <td><?= $sale['order_total'] ?></td>
                                    <td><?= $sale['status'] ?></td>
                                    <td><?= DateTime::createFromFormat('Y-m-d H:i:s', $sale['order_datetime'])->format('F j, Y h:i A') ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-muted">No sales data available.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Yearly Summary Section -->
    <div class="card mb-5">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">This Year's Planting Summary</h5>
        </div>
        <div class="card-body">
            <?php if ($m): ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th>Month</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($m as $month => $value): ?>
                                <tr>
                                <?php
                                    $months = [
                                        'Jan' => 'January',
                                        'Feb' => 'February',
                                        'Mar' => 'March',
                                        'Apr' => 'April',
                                        'May' => 'May',
                                        'Jun' => 'June',
                                        'Jul' => 'July',
                                        'Aug' => 'August',
                                        'Sep' => 'September',
                                        'Oct' => 'October',
                                        'Nov' => 'November',
                                        'Decs' => 'December'
                                    ];

                                
                                    ?>

                                    <td><?= isset($months[$month]) ? $months[$month] : ucfirst($month) ?></td>

                                    <td><?= $value ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-muted">No data available.</p>
            <?php endif; ?>
        </div>
    </div>

    
</div>

<?php include_once('../../components/footer.php'); ?>