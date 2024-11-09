<?php 
    include_once('../../../controller/LogoutController.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nursery Owners</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/sidebar.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="px-1 px-md-5">
<style>
    
.navbar {
    margin-top: 20px
}

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
    display: flex;
    flex-direction: column;
    flex: 1;
}

.stats-card {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
</style>


<?php 
    // Redirect to login if not logged in
    if (!isset($_SESSION['username']) && $title != "User") {
?>

<nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="../../../assets/images/logo.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">CMS</span>
                    <span class="profession">Admin
                    </span>
                                    </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links p-0">
                    <li class="nav-link">
                        <a href="../dashboard/index.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="../plant_type/index.php">
                            <i class='bx bx-list-ol icon'></i>
                            <span class="text nav-text">Type</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../plant_variety/index.php">
                            <i class='bx bx-layer icon'></i>
                            <span class="text nav-text">Varienty</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../plant_source/index.php">
                            <i class='bx bx-face icon'></i>
                            <span class="text nav-text">Source</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="../plant_nursery/index.php">
                            <i class='bx bx-leaf icon'></i>
                            <span class="text nav-text">Nursery</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content" class="w-100">
                <form action='' method='post' class="w-100">
                    <input type='hidden' name='action' value='logout'>
                    <li class="w-100">
                        <button type='submit' class="d-flex w-100 btn-logout p-0 py-3" style="padding-left: -10px">
                            <i class='bx bx-log-out icon p-0 m-0' style="margin-left: -10px;"></i>
                            <span class="text nav-text text-start" style="line-height: 1;">Logout</span>
                        </button>
                    </li>
                </form>
            </div>
        </div>
    </nav>
    <?php
    }
?>

   <section class="home mb-3 p-4">

