<?php
    $title = "NurseryOwner Update";
    require_once('../../../services/NurseryOwnerService.php');
    include_once('../../components/header.php');
    // Redirect to login if not logged in
    if (isset($_SESSION['user_id'])) {
        header("Location: ../../../index.php");
        exit();
    }
    require_once('../../../controller/NurseryController.php');
?>
<div>
  <a class="btn btn-outline-danger m-2" href="index.php" width="200"> Back </a>
   
    <div class="card p-4">
    <h1>Update Nursery Owner</h1>
        <form method="POST" action="">
            
            <div class="form-group">
                <label for="fullname">Fullname</label>
                <input type="text" value="<?php echo htmlspecialchars($getSpecificOwner['fullname']); ?>" class="form-control" name="fullname" id="fullname" placeholder="ex. Juan Dela Cruz" required>
            </div>
            <div class="form-group">
                <label for="contact_number">Contact Number</label>
                <input type="number" value="<?php echo htmlspecialchars($getSpecificOwner['contact_number']); ?>" class="form-control" name="contact_number" id="contact_number" placeholder="ex. 0912341232324" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" value="<?php echo htmlspecialchars($getSpecificOwner['address']); ?>" class="form-control" name="address" id="address" placeholder="ex. Brgy. Banquerohan" required>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <input type="hidden" name="action" value="update">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<?php include_once('../../components/footer.php'); ?>
