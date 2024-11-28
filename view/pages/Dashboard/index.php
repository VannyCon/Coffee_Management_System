<?php 
  $title = "Dashboard";
  include_once('../../components/header.php'); 
  require_once('../../../controller/DashboardController.php');

  $sales = $dashboard->getSalesSummary(); // Fetch sales summary
?>
<style>
    
</style>
<!-- Font Awesome CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <h1 class="ps-2"> Dashboard</h1>
    <div class="container-fluid mt-2">
        <div class="row g-2">
            <div class="col-md-12 p-2 mb-0">
                <div class="dashboard-card" style="height: 100%;">
                    <div class="stat-label"><strong>Planted this Year</strong></div>
                    <div style="width: 100%; margin: auto;" class="mt-2">
                        <canvas id="nurseryPlantChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-12 p-2 ">
                <div class="dashboard-card">
                    <div class="stat-label mb-0"><strong>Sales Summary</strong></div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nursery ID</th>
                                    <th>Bought Price</th>
                                    <th>Selling Price</th>
                                    <th>Quantity</th>   
                                    <th>Total</th>
                                    <th>Profit/Unit</th>
                                    <th>Total Profit</th>
                                    <th>Cost</th>
                                    <th>Net Income</th>
                                    <th>Status</th>
                                    <th>Date/Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($sales)): ?>
                                    <?php foreach ($sales as $index => $sale): ?>
                                        <tr>
                                            <td><?php echo $index + 1; ?></td>
                                            <td><?php echo htmlspecialchars($sale['nursery_field']); ?></td>
                                            <td>₱<?php echo htmlspecialchars($sale['plant_bought_price']); ?></td>
                                            <td>₱<?php echo htmlspecialchars($sale['plant_selling_price']); ?></td>
                                            <td><?php echo htmlspecialchars($sale['order_quantity']); ?></td>
                                            <td>₱<?php echo htmlspecialchars($sale['order_total']); ?></td>
                                            <td>₱<?php echo htmlspecialchars($sale['profit_per_unit']); ?></td>
                                            <td>₱<?php echo htmlspecialchars($sale['total_profit']); ?></td>
                                            <td>₱<?php echo htmlspecialchars($sale['total_cost']); ?></td>
                                            <td>₱<?php echo htmlspecialchars($sale['net_income_or_loss']); ?></td>
                                            <td>
                                                <?php if ($sale['status'] === 'Profit'): ?>
                                                    <span class="badge bg-success"><i class="fa-solid fa-arrow-up"></i> Profit</span>
                                                <?php elseif ($sale['status'] === 'Loss'): ?>
                                                    <span class="badge bg-danger"><i class="fa-solid fa-arrow-down"></i>Loss</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo htmlspecialchars($sale['order_datetime']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="13" class="text-center">No sales data available.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12 p-2 mt-0">
                <div class="stats-container">
                    <div class="stats-row mb-3">
                        <div class="stats-col ms-2">
                            <div class="dashboard-card text-center stats-card">
                                <div class="stat-number">
                                    <a href="../plant_nursery/index.php"><?php echo $getSummary['total_plants']; ?></a>
                                </div>
                                <div class="stat-label">Total Batch Plants</div>
                            </div>
                        </div>
                        <div class="stats-col ms-2">
                            <div class="dashboard-card text-center stats-card">
                                <div class="stat-number">
                                    <a href="../plant_nursery/index.php"><?php echo $getSummary['total_types']; ?></a>
                                </div>
                                <div class="stat-label">Total Types</div>
                            </div>
                        </div>
                        <div class="stats-col ms-2">
                            <div class="dashboard-card text-center stats-card">
                                <div class="stat-number">
                                    <a href="../plant_variety/index.php"><?php echo $getSummary['total_varieties']; ?></a>
                                </div>
                                <div class="stat-label">Total Varieties</div>
                            </div>
                        </div>
                        <div class="stats-col ms-2">
                            <div class="dashboard-card text-center stats-card">
                                <div class="stat-number">
                                    <a href="../plant_source/index.php"><?php echo $getSummary['total_varieties']; ?></a>
                                </div>
                                <div class="stat-label">Total Source</div>
                            </div>
                        </div>
                    </div>
                    <div class="stats-row">
                        <div class="stats-col ms-2">
                            <div class="dashboard-card text-center stats-card">
                                <div class="stat-number">
                                    <a href="../plant_center/index.php"><?php echo $getSummary['total_centers']; ?></a>
                                </div>
                                <div class="stat-label">Total Center</div>
                            </div>
                        </div>
                        <div class="stats-col ms-2">
                            <div class="dashboard-card text-center stats-card">
                                <div class="stat-number">
                                    <a href="../plant_center/index.php"><?php echo $getSummary['total_quantity_center']; ?></a>
                                </div>
                                <div class="stat-label">Total Deploy</div>
                            </div>
                        </div>
                        <div class="stats-col ms-2">
                            <div class="dashboard-card text-center stats-card">
                                <div class="stat-number">
                                    <a href="../plant_order/index.php"><?php echo $getSummary['total_quantity_order']; ?></a>
                                </div>
                                <div class="stat-label">Total Order</div>
                            </div>
                        </div>
                        <div class="stats-col ms-2">
                            <div class="dashboard-card text-center stats-card">
                                <div class="stat-number">
                                    <a href="../plant_order/index.php"><?php echo $getSummary['total_order_price']; ?></a>
                                </div>
                                <div class="stat-label">Total Income</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
<br><br>

</div>
    <script>
        // Fetch data from your MySQL database using AJAX or manually input the data
        const Jan = <?php echo isset($m['Jan']) ? $m['Jan'] : 0; ?>;
        const Feb = <?php echo isset($m['Feb']) ? $m['Feb'] : 0; ?>;
        const Mar = <?php echo isset($m['Mar']) ? $m['Mar'] : 0; ?>;
        const Apr = <?php echo isset($m['Apr']) ? $m['Apr'] : 0; ?>;
        const May = <?php echo isset($m['May']) ? $m['May'] : 0; ?>;
        const Jun = <?php echo isset($m['Jun']) ? $m['Jun'] : 0; ?>;
        const Jul = <?php echo isset($m['Jul']) ? $m['Jul'] : 0; ?>;
        const Aug = <?php echo isset($m['Aug']) ? $m['Aug'] : 0; ?>;
        const Sep = <?php echo isset($m['Sep']) ? $m['Sep'] : 0; ?>;
        const Oct = <?php echo isset($m['Oct']) ? $m['Oct'] : 0; ?>;
        const Nov = <?php echo isset($m['Nov']) ? $m['Nov'] : 0; ?>;
        const Dec = <?php echo isset($m['Dec']) ? $m['Dec'] : 0; ?>;

        // Create the line chart
        const ctx = document.getElementById('nurseryPlantChart').getContext('2d');
        const nurseryPlantChart = new Chart(ctx, {
            type: 'line',  // Changed from 'bar' to 'line'
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Nursery Plant Summary',
                    data: [Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Oct, Nov, Dec],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',  // A single color for the fill
                    borderColor: 'rgba(75, 192, 192, 1)',  // A single color for the border
                    borderWidth: 2,
                    fill: true,  // Fill under the line
                    tension: 0.3  // Smooth the line (0 = straight, 1 = completely rounded)
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        
    </script>
    


    <?php include_once('../../components/footer.php'); ?>