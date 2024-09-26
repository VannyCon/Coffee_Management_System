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
                                <div class="stat-label">Total Plants</div>
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
                <a class="action-button py-3 btn" href="../Nursery_Owner/index.php">Manage Nursery Owner</a>
            </div>
            <div class="col-md-6">
                <a class="action-button py-3 btn" href="../Plant_Info/index.php">Manage Plants</a>
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

    // Create the bar chart
    const ctx = document.getElementById('nurseryPlantChart').getContext('2d');
    const nurseryPlantChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Nursery Plant Summary',
                data: [Jan, Feb, Mar, Apr, May, Jun, Jul, Aug, Sep, Oct, Nov, Dec],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',  // Jan
                    'rgba(54, 162, 235, 0.2)',  // Feb
                    'rgba(255, 206, 86, 0.2)',   // Mar
                    'rgba(153, 102, 255, 0.2)',  // Apr
                    'rgba(255, 99, 132, 0.2)',   // May
                    'rgba(255, 159, 64, 0.2)',   // Jun
                    'rgba(75, 192, 192, 0.2)',    // Jul
                    'rgba(54, 162, 235, 0.2)',    // Aug
                    'rgba(255, 206, 86, 0.2)',     // Sep
                    'rgba(153, 102, 255, 0.2)',    // Oct
                    'rgba(255, 99, 132, 0.2)',     // Nov
                    'rgba(255, 159, 64, 0.2)'      // Dec
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',  // Jan
                    'rgba(54, 162, 235, 1)',  // Feb
                    'rgba(255, 206, 86, 1)',   // Mar
                    'rgba(153, 102, 255, 1)',  // Apr
                    'rgba(255, 99, 132, 1)',   // May
                    'rgba(255, 159, 64, 1)',   // Jun
                    'rgba(75, 192, 192, 1)',    // Jul
                    'rgba(54, 162, 235, 1)',    // Aug
                    'rgba(255, 206, 86, 1)',     // Sep
                    'rgba(153, 102, 255, 1)',    // Oct
                    'rgba(255, 99, 132, 1)',     // Nov
                    'rgba(255, 159, 64, 1)'      // Dec
                ],
                borderWidth: 1
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