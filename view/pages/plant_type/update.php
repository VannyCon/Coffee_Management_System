<?php
    $title = "NurseryOwner Update";
    require_once('../../../services/PlantTypeService.php');
    include_once('../../components/header.php');
    // Redirect to login if not logged in
    if (isset($_SESSION['username'])) {
        header("Location: ../../../index.php");
        exit();
    }
    require_once('../../../controller/PlantTypeController.php');
?>
<div>
    <a class="btn btn-outline-danger m-2" href="index.php" width="200"> Back </a>
   
    <div class="card p-4">
      <h1>Create Type</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="type_name">Type Name</label>
                <input type="text" class="form-control" value="<?php echo $getSpecificType['type_name']?>" name="type_name" id="type_name" placeholder="ex. Type 1" required>
            </div>
            <div class="form-group">
                <label for="contact_number">Description</label>
                <textarea class="form-control" id="description" name="description"><?php echo $getSpecificType['description']; ?></textarea>
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
