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
                <a class="action-button py-3 btn" href="../nurserowner/index.php">Manage Nursery Owner</a>
            </div>
            <div class="col-md-6">
                <a class="action-button py-3 btn" href="../plantinfo/index.php">Manage Plants</a>
            </div>
        </div>
        
    </div>

    <?php include_once('../../components/footer.php'); ?>