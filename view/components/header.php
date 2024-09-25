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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<?php 
    // Redirect to login if not logged in
    if (!isset($_SESSION['user_id']) && $title != "User") {
        echo "<div class='d-flex justify-content-end mr-3'>
                <form action='' method='post'>
                    <input type='hidden' name='action' value='logout'>
                    <button class='btn btn-danger btn-lg' type='submit'>Logout</button>
                </form>
              </div>";
    }
?>

