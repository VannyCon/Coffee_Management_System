<?php
    $title = "Source";
    include_once('../../components/header.php');
    include_once('../../../controller/PlantSourceController.php');
?>

<div>
    <a class="btn btn-outline-danger m-2" href="index.php" width="200"> Back </a>
   
    <div class="card p-4">
      <h1>Create Nursery Owner</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="fullname">Fullname</label>
                <input type="text" class="form-control" name="fullname" id="fullname" placeholder="ex. Juan Dela Cruz" required>
            </div>
            <div class="form-group">
                <label for="source_variety">Variety</label>
                <input type="text" class="form-control" name="source_variety" id="source_variety" placeholder="ex. Robuska" required>
            </div>
            <div class="form-group">
                <label for="source_quantity">Quantity</label>
                <input type="number" class="form-control" name="source_quantity" id="source_quantity" placeholder="1000" required>
            </div>
            <div class="form-group">
                <label for="contact_number">Contact Number</label>
                <input type="number" class="form-control" name="contact_number" id="contact_number" placeholder="ex. 0912341232324" required>
            </div>
            <div class="form-group">
                <label for="source_email">Email</label>
                <input type="email" class="form-control" name="source_email" id="source_email" placeholder="ex. 0912341232324" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="ex. Brgy. Banquerohan" required>
            </div>
            
            <input type="hidden" name="action" value="create">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<?php include_once('../../components/footer.php'); ?>
