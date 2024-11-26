<?php
    $title = "Center";
    include_once('../../components/header.php');
    include_once('../../../controller/PlantCenterController.php');
?>

<div>
    <a class="btn btn-outline-danger m-2" href="index.php" width="200"> Back </a>
   
    <div class="card p-4">
      <h1>Create Type</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="center_name">Center Name</label>
                <input type="text" class="form-control" name="center_name" id="center_name" placeholder="ex. Center One" required>
            </div>
            <div class="form-group">
                <label for="center_address">Center Address</label>
                <input type="text" class="form-control" name="center_address" id="center_address" placeholder="ex. brgy. Banquerohan" required>
            </div>
            <!-- <div class="form-group">
                <label for="nursery_id">Nursery ID</label>
                <input type="text" class="form-control" name="nursery_id" id="nursery_id"  required>
            </div> -->

            <!-- Source Dropdown -->
            <div class="form-group my-1">
                <label for="nursery_id">Field</label>
                <div class="dropdown w-100">
                    <input type="text" id="searchOrderPlantsInput" class="form-control" name="nursery_id" placeholder="Choose Source" onkeyup="filterOrderPlantsOptions()" onclick="toggleOrderPlantsDropdown()" required autocomplete="off">
                    <input type="hidden" id="nurseryId" name="nursery_id">
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
                <input type="number" class="form-control" name="quantity" id="quantity" placeholder="ex. 20" required>
            </div>
           
            <input type="hidden" name="action" value="create">
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>
</div>

<?php include_once('../../components/footer.php'); ?>
