<?php
    $title = "Variety";
    include_once('../../components/header.php');
    include_once('../../../controller/PlantVarietyController.php');
?>

<div>
    <a class="btn btn-outline-danger m-2" href="index.php" width="200"> Back </a>
   
    <div class="card p-4">
      <h1>Create Variety</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="variety_name">Type Name</label>
                <input type="text" class="form-control" name="variety_name" id="variety_name" placeholder="ex. Variety 1" required>
            </div>
            <div class="form-group">
                <label for="contact_number">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <input type="hidden" name="action" value="create">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<?php include_once('../../components/footer.php'); ?>
