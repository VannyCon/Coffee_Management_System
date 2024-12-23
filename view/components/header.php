<?php 
    include_once('../../../controller/LogoutController.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Mangement System</title>
    <!-- Bootstrap CSS CDN -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../../css/bootsrap.css">
    <link rel="stylesheet" href="../../css/style.css">
    <!-- <script src="../../js/chart.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Font Awesome CDN -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="../../css/fontawesome.css">
    <link rel="stylesheet" href="../../css/sidebar.css">
    <!-- <link rel="stylesheet" href="../../css/boxicons.css"> -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
         <!-- add icon link -->
    <link rel="icon" href=
"../../../assets/images/logo.png" 
        type="image/x-icon" />
</head>
<body class="px-1 px-md-5">
<style>
    
.navbar-brand {
    font-weight: bold;
}

/* .btn-logout {
    background-color: #dc3545;
    color: white;
} */



.dashboard-card {
    background-color: white;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.stat-number a {
    text-decoration: none;
    color: inherit;
}

.stat-number {
    font-size: 3rem;
    font-weight: bold;
    color: #8B4513;
}

.stat-label {
    color: #6c757d;
}

.action-button {
    background-color: #8B4513;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    width: 100%;
    margin-top: 10px;
}

.recent-activities {
    background-color: white;
    border-radius: 8px;
    padding: 20px;
    margin-top: 20px;
}

.stats-container {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.stats-row {
    display: flex;
    flex: 1;
}


.stats-col {
    flex: 1 1 calc(25% - 15px); /* Adjust card size for responsiveness */
    max-width: calc(25% - 15px);
}

@media (max-width: 768px) {
    .stats-col {
        flex: 1 1 calc(50% - 15px); /* Adjust card size for smaller screens */
        max-width: calc(50% - 15px);
    }
}

@media (max-width: 576px) {
    .stats-col {
        flex: 1 1 100%; /* Full width for very small screens */
        max-width: 100%;
    }
}

.stats-card {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.modal.fade .modal-dialog.modal-dialog-slideright {
    transform: translate(100%, 0);
    transition: transform 0.3s ease-out;
}

.modal.show .modal-dialog.modal-dialog-slideright {
    transform: translate(0, 0);
}

.confirmation-details {
    padding: 15px;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.detail-item {
    padding: 12px;
    border-bottom: 1px solid #dee2e6;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-label {
    font-weight: 600;
    color: #495057;
}

.detail-value {
    color: #212529;
}

.table-responsive {
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.table th {
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
}
</style>


<?php 
    // Redirect to login if not logged in
    if (!isset($_SESSION['username']) && $title != "User") {
?>
    <!-- Sidebar Menu for Desktop -->
    <nav class="sidebar close d-none d-md-block">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="../../../assets/images/logo.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">CMS</span>
                    <span class="profession">Admin</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links p-0">
                    <li class="nav-link <?php echo $title == 'Dashboard' ? 'active' : ''; ?>">
                        <a href="../dashboard/index.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link <?php echo $title == 'Nursery' ? 'active' : ''; ?>">
                        <a href="../plant_nursery/index.php">
                            <i class='bx bx-leaf icon'></i>
                            <span class="text nav-text">Nursery</span>
                        </a>
                    </li>
                    <li class="nav-link <?php echo $title == 'Order' ? 'active' : ''; ?>">
                        <a href="../plant_order/index.php">
                            <i class='bx bx-store-alt icon'></i>
                            <span class="text nav-text">Order</span>
                        </a>
                    </li>
                    <li class="nav-link <?php echo $title == 'Reminder' ? 'active' : ''; ?>">
                        <a href="../plant_reminder/index.php">
                            <i class='bx bx-calendar-check icon'></i>
                            <span class="text nav-text">Reminder</span>
                        </a>
                    </li>
                    <li class="nav-link <?php echo $title == 'Source' ? 'active' : ''; ?>">
                        <a href="../plant_source/index.php">
                            <i class='bx bx-face icon'></i>
                            <span class="text nav-text">Sources</span>
                        </a>
                    </li>
                    <li class="nav-link <?php echo $title == 'Type' ? 'active' : ''; ?>">
                        <a href="../plant_type/index.php">
                            <i class='bx bx-list-ol icon'></i>
                            <span class="text nav-text">Type</span>
                        </a>
                    </li>
                    <li class="nav-link <?php echo $title == 'Variety' ? 'active' : ''; ?>">
                        <a href="../plant_variety/index.php">
                            <i class='bx bx-layer icon'></i>
                            <span class="text nav-text">Variety</span>
                        </a>
                    </li>
                    <li class="nav-link <?php echo $title == 'Center' ? 'active' : ''; ?>">
                        <a href="../plant_center/index.php">
                            <i class='bx bx-building-house icon'></i>
                            <span class="text nav-text">Center</span>
                        </a>
                    </li>
                    <li class="nav-link <?php echo $title == 'Report' ? 'active' : ''; ?>">
                        <a href="../plant_report/index.php">
                            <i class='bx bx-book-content icon'></i>
                            <span class="text nav-text">Report</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <form action='' method='post'>
                    <input type='hidden' name='action' value='logout'>
                    <li class="">
                        <button type='submit' class="d-flex w-100 btn-logout p-0 py-3" style="padding-left: -10px">
                            <i class='bx bx-log-out icon p-0 m-0' style="margin-left: -10px;"></i>
                            <span class="text nav-text text-start" style="line-height: 1;">Logout</span>
                        </button>
                    </li>
                </form>
            </div>
        </div>
    </nav>

    <!-- Mobile Navigation -->
    <nav class="navbar navbar-expand-md d-md-none fixed-top mobile-nav-bg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../../../assets/images/logo.png" alt="" width="50" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNav" 
                    aria-controls="mobileNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse bg-light p-2 rounded" id="mobileNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $title == 'Dashboard' ? 'active' : ''; ?>" href="../dashboard/index.php">
                            <i class='bx bx-home-alt'></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $title == 'Nursery' ? 'active' : ''; ?>" href="../plant_nursery/index.php">
                            <i class='bx bx-leaf'></i> Nursery
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $title == 'Order' ? 'active' : ''; ?>" href="../plant_order/index.php">
                            <i class='bx bx-store-alt'></i> Order
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $title == 'Reminder' ? 'active' : ''; ?>" href="../plant_reminder/index.php">
                            <i class='bx bx-calendar-check'></i> Reminder
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $title == 'Source' ? 'active' : ''; ?>" href="../plant_source/index.php">
                            <i class='bx bx-face'></i> Sources
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $title == 'Type' ? 'active' : ''; ?>" href="../plant_type/index.php">
                            <i class='bx bx-list-ol'></i> Type
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $title == 'Variety' ? 'active' : ''; ?>" href="../plant_variety/index.php">
                            <i class='bx bx-layer'></i> Variety
                        </a>
                    </li>

                   
                    <li class="nav-item">
                        <a class="nav-link <?php echo $title == 'Center' ? 'active' : ''; ?>" href="../plant_center/index.php">
                            <i class='bx bx-building-house'></i> Center
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $title == 'Report' ? 'active' : ''; ?>" href="../plant_report/index.php">
                            <i class='bx bx-book-content'></i> Report
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action='' method='post'>
                            <input type='hidden' name='action' value='logout'>
                            <button type='submit' class="nav-link text-danger border-0 bg-transparent">
                                <i class='bx bx-log-out'></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
    }
?>

   <section class="home mb-3 p-1 p-lg-4 pt-5 pt-md-0 mt-5 mt-lg-0">

