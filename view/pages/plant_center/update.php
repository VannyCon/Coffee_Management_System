<?php
$title = "Update Center";

include_once('../../components/header.php');
include_once('../../../controller/PlantCenterController.php');

// Check if 'id' is provided in the URL
if (isset($_GET['ID'])) {
    $id = $_GET['ID'];
    // Fetch the specific center details
    $center = $centerService->getCenterById($id);
    
    if (!$center) {
        echo "<div class='alert alert-danger'>Center not found!</div>";
        exit();
    }
} else {
    echo "<div class='alert alert-danger'>No ID provided!</div>";
    exit();
}


?>

<div>
    <a class="btn btn-outline-danger m-2" href="index.php" width="200"> Back </a>
   
    <div class="card p-4">
      <h1>Update Center</h1>
      <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
      <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="center_name">Center Name</label>
                <input type="text" class="form-control" name="center_name" id="center_name" value="<?php echo htmlspecialchars($center['center_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="center_address">Center Address</label>
                <input type="text" class="form-control" name="center_address" id="center_address" value="<?php echo htmlspecialchars($center['center_address']); ?>" required>
            </div>

            
            <!-- Source Dropdown -->
            <div class="form-group my-1">
                <label for="nursery_id">Field</label>
                <div class="dropdown w-100">
                    <input type="text" id="searchOrderPlantsInput" value="<?php echo htmlspecialchars($center['nursery_field']); ?>" class="form-control" name="searchOrderPlantsInput" placeholder="Choose Source" onkeyup="filterOrderPlantsOptions()" onclick="toggleOrderPlantsDropdown()" autocomplete="off">
                    <input type="hidden" id="nurseryId" name="nursery_id" value="<?php echo htmlspecialchars($center['center_nursery_id']); ?>">
                    <input type="hidden" id="nurseryField" />
                    <div id="orderPlantsDropdownContent" class="dropdown-content w-100">
                        <?php if (!empty($plantInfos)): ?>
                            <?php foreach ($plantInfos as $plantInfo): ?>
                                <div onclick="selectOrderPlants(this)" data-id="<?php echo $plantInfo['nursery_id']; ?>" data-field="<?php echo $plantInfo['nursery_field']; ?>">
                                    <?php echo htmlspecialchars(trim($plantInfo['nursery_field'])); ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div>No records found</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" name="quantity" id="quantity" value="<?php echo htmlspecialchars($center['center_quantity']); ?>" required>
            </div>
           
            <input type="hidden" name="action" value="update">
            <button type="submit" class="btn btn-primary mt-2">Update</button>
        </form>
    </div>
</div>

<?php include_once('../../components/footer.php'); ?>
