<?php 
  $title = "Dashboard";
      include_once('../../components/header.php'); 
      require_once('../../../controller/DashboardController.php');

?>
    <div class="container-fluid mt-2">
        <div class="row g-3">
            <div class="col-md-8 p-2">
                <div class="dashboard-card" style="height: 100%;">
                <div class="stat-label"><strong>Planted this Year</strong></div>
                    <div style="width: 100%; margin: auto;" class="mt-2">
                        <canvas id="nurseryPlantChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4 p-2">
                <div class="stats-container">
                 <div class="stats-row mb-3">
                        <div class="stats-col me-2">
                            <div class="dashboard-card text-center stats-card">
                                <div class="stat-number"><?php echo $getSummary['total_plants']; ?></div>
                                <div class="stat-label">Total Batch Plants</div>
                            </div>
                        </div>
                        <div class="stats-col ms-2">
                            <div class="dashboard-card text-center stats-card">
                                <div class="stat-number"><?php echo $getSummary['total_types']; ?></div>
                                <div class="stat-label">Total Types</div>
                            </div>
                        </div>
                    </div>
                    <div class="stats-row">
                        <div class="stats-col me-2">
                            <div class="dashboard-card text-center stats-card">
                                <div class="stat-number"><?php echo $getSummary['total_varieties']; ?></div>
                                <div class="stat-label">Total Varieties</div>
                            </div>
                        </div>
                        <div class="stats-col ms-2">
                            <div class="dashboard-card text-center stats-card">
                                <div class="stat-number"><?php echo $getSummary['total_varieties']; ?></div>
                                <div class="stat-label">Total Nurser Owner</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-1">
            <div class="col-md-6">
                <a class="action-button py-3 btn" href="../plant_source/index.php">Manage Source</a>
            </div>
            <div class="col-md-6">
                <a class="action-button py-3 btn" href="../plant_nursery/index.php">Manage Nursery</a>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-6">
                <a class="action-button py-3 btn" href="../plant_type/index.php">Manage Type</a>
            </div>
            <div class="col-md-6">
                <a class="action-button py-3 btn" href="../plant_variety/index.php">Manage Variety</a>
            </div>
        </div>
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