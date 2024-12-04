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

<div class="container my-4">
    <!-- Download Button -->
    <div class="text-end mb-4">
        <a href="reportpdf.php" class="btn btn-info">
            <i class='bx bx-note icon'></i> Download PDF
        </a>
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
    <div class="card mb-4">
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